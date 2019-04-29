import $firebase from "../adapters/firebase";
import $error from "./error";

const STORAGE = $firebase.storage();

const uuid = require("uuid");

export interface FileRecord {
    id: string;
    delete(): Promise<void>;
    url: string;
}

async function recordFactory(ref: $firebase.storage.Reference): Promise<FileRecord> {
    const url = await ref.getDownloadURL();

    if (!url || typeof url !== "string") {
        throw $error.NotFound(`File ${ref.name} does not exists`);
    }

    return {
        get id(): string {
            return ref.name;
        },

        async delete(): Promise<void> {
            return ref.delete();
        },

        get url(): string {
            return url;
        },
    };
}

const $storage = {
    async upload(file: File): Promise<FileRecord> {
        const id = uuid.v4();

        const ref = STORAGE.ref(id);

        await ref.put(file);

        return recordFactory(ref);
    },

    async get(id: string): Promise<FileRecord> {
        return recordFactory(STORAGE.ref(id));
    },
};

export default $storage;
