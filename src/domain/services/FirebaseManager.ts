import $firebase from "../../adapters/firebase";

const uuid = require("uuid");

const $db = $firebase.database();

export interface Model<T> {
    id: string;
    data(): Promise<T>;
    on(condition: firebase.database.EventType, callback: (data: T) => void): void;
}

function factory<T>(reference: firebase.database.Reference): Model<T> {
    return {
        get id(): string {
            return <string>reference.key;
        },

        async data(): Promise<T> {
            const data: any = await reference.once("value");

            return <T>data;
        },

        on(condition: firebase.database.EventType, callback: (data: T) => void): void {
            reference.on(condition, snapshot => {
                if (snapshot) {
                    callback(snapshot.val());
                }
            });
        },
    };
}

const $firebaseManager = {
    async persist<T>(data: T, path: string, id?: string): Promise<Model<T>> {
        const key = id || uuid.v4();

        const reference = $db.ref(`${path}/${key}`);

        await reference.set(data);

        return factory(reference);
    },

    async fetch<T>({ path }: { path: string }): Promise<Model<T>[]> {
        const data = await $db
            .ref(path)
            .orderByKey()
            .once("value");

        const collection: Model<T>[] = [];

        data.forEach(record => {
            collection.push(factory(record.ref));
        });

        return collection;
    },
};

export default $firebaseManager;
