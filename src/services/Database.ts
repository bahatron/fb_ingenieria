import $firebase from "../adapters/firebase";

const uuid = require("uuid");

const $db = $firebase.database();

export interface Model<T> {
    id: string;
    data(): Promise<T>;
    update(data: Partial<T>): Promise<T>;
    on(condition: ModelEvents, callback: (data: T) => void): void;
    delete(): Promise<void>;
    set(data: T): Promise<T>;
}

interface Validator<T> {
    (data: any): T;
}

interface FactoryInterface<T> {
    reference: firebase.database.Reference;
    validator: Validator<T>;
}

type ModelEvents = "value";

function modelFactory<T>({ reference, validator }: FactoryInterface<T>): Model<T> {
    return {
        get id(): string {
            return <string>reference.key;
        },

        async data(): Promise<T> {
            const snapshot = await reference.once("value");

            return <T>snapshot.val();
        },

        async update(data: Partial<T>): Promise<T> {
            const currentData = await this.data();

            return reference.update(validator({ ...currentData, ...data }));
        },

        async set(data: T): Promise<T> {
            return reference.set(data);
        },

        async delete(): Promise<void> {
            await reference.remove();
        },

        on(condition: ModelEvents, callback: (data: T) => void): void {
            reference.on(condition, snapshot => {
                if (snapshot) {
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

    await reference.set(validator(data));

    return modelFactory({
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

    // this forEach is NOT Array.prototype.forEach
    data.forEach(record => {
        collection.push(
            modelFactory({
                reference: record.ref,
                validator,
            }),
        );
    });

    return collection;
}

interface NewInterface<T> {
    path: string;
    id: string;
    validator: Validator<T>;
}
async function newModel<T>({ path, id, validator }: NewInterface<T>): Promise<Model<T>> {
    const reference = $db.ref(`${path}/${id}`);

    return modelFactory({
        reference,
        validator,
    });
}

const $database = {
    persist,
    fetch,
    new: newModel,
};

export default $database;
