import $firebase from "../adapters/firebase";

const uuid = require("uuid");

const $db = $firebase.database();

/** @todo: create an external interface for this */
export interface Model<T> {
    id: string;
    data(): Promise<T>;
    update(data: T): Promise<T>;
    on(condition: firebase.database.EventType, callback: (data: T) => void): void;
    delete(): Promise<void>;
}

interface Validator<T> {
    (data: any): T;
}

/** @todo: would it be good to freeze the instance? */
function factory<T>(reference: firebase.database.Reference, validator: (ddata: any) => T): Model<T> {
    return {
        get id(): string {
            return <string>reference.key;
        },

        async data(): Promise<T> {
            const data: any = await reference.once("value");

            return <T>data.val();
        },

        async update(data: T): Promise<T> {
            /** @todo: convert this into a pipe, maybe use lodash */
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

const $firebaseManager = {
    async persist<T>({
        data,
        path,
        id,
        validator,
    }: {
        data: T;
        path: string;
        id?: string;
        validator: Validator<T>;
    }): Promise<Model<T>> {
        const key = id || uuid.v4();

        const reference = $db.ref(`${path}/${key}`);

        await reference.set(data);

        return factory(reference, validator);
    },

    async fetch<T>({ path, validator }: { path: string; validator: Validator<T> }): Promise<Model<T>[]> {
        const data = await $db
            .ref(path)
            .orderByKey()
            .once("value");

        const collection: Model<T>[] = [];

        data.forEach(record => {
            collection.push(factory(record.ref, validator));
        });

        return collection;
    },
};

export default $firebaseManager;
