import $firebase from "../adapters/firebase";

const uuid = require("uuid");

const $db = $firebase.database();

export interface Model<T> {
    id: string;
    data(): Promise<T>;
    update(data: T): Promise<T>;
    on(condition: string, callback: (data: T) => void): void;
    delete(): Promise<void>;
}

interface Validator<T> {
    (data: any): T;
}
interface FactoryInterface<T> {
    reference: firebase.database.Reference;
    validator: Validator<T>;
}
function factory<T>({ reference, validator }: FactoryInterface<T>): Model<T> {
    return {
        get id(): string {
            return <string>reference.key;
        },

        async data(): Promise<T> {
            const snapshot = await reference.once("value");

            return <T>snapshot.val();
        },

        async update(data: T): Promise<T> {
            return reference.update(validator(data));
        },

        async delete(): Promise<void> {
            await reference.remove();
        },

        on(condition: firebase.database.EventType, callback: (data: T) => void): void {
            reference.on(condition, snapshot => {
                if (snapshot) {
                    /** @todo: create unit test for revealing the behaviour difference of this */
                    // callback(snapshot.val());
                    callback.call(this, snapshot.val());
                }
            });
        },
    };
}

interface PersistInterface<T> {
    data: T;
    path: string;
    id?: string;
    validator: Validator<T>;
}
async function persist<T>({ data, path, id, validator }: PersistInterface<T>): Promise<Model<T>> {
    const key = id || uuid.v4();

    const reference = $db.ref(`${path}/${key}`);

    await reference.set(data);

    return factory({
        reference,
        validator,
    });
}

interface FetchInterface<T> {
    path: string;
    validator: Validator<T>;
}
async function fetch<T>({ path, validator }: FetchInterface<T>): Promise<Model<T>[]> {
    const data = await $db
        .ref(path)
        .orderByKey()
        .once("value");

    const collection: Model<T>[] = [];

    // this forEach is not the Array.prototype.forEach
    data.forEach(record => {
        collection.push(
            factory({
                reference: record.ref,
                validator,
            }),
        );
    });

    return collection;
}

const $firebaseManager = {
    persist,
    fetch,
};

export default $firebaseManager;
