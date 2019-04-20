import $firebase from "../adapters/firebase";

const STORAGE = $firebase.storage();

const uuid = require("uuid");

const $storage = {
    async upload(file: File): Promise<string> {
        const id = uuid.v4();

        const ref = STORAGE.ref(id);

        await ref.put(file);

        return ref.getDownloadURL();
    },

    async delete(url: string): Promise<void> {
        const ref = STORAGE.refFromURL(url);

        await ref.delete();
    }
};

export default $storage;
