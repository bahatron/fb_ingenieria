import $firebase from "../adapters/firebase";

console.log(process.env);
console.log($firebase);

const STORAGE = $firebase.storage();

const uuid = require("uuid");

const $storage = {
    async upload(file: any): Promise<string> {
        return uuid.v4();
    },
};

export default $storage;
