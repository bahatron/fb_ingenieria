import $firebase from "../../../services/firebase";
import { Client } from "../ClientFacade";
import $clientFactory from "./ClientFactory";

const $db = $firebase.database();
const uuid = require("uuid");

const BASE_PATH = process.env.VUE_APP_DB_CLIENT_PATH;

interface PersistInteface {
    data: any;
    id?: string;
}

interface UpdateInterface {
    id: string;
    data?: any;
}

interface DeleteInterface {
    id: string;
}

const $clientManager = Object.freeze({
    async persist({ data, id }: PersistInteface): Promise<Client> {
        const clientId = id || uuid.v4();
        const reference = $db.ref(`${BASE_PATH}/${clientId}`);

        await reference.set(data);

        return $clientFactory.create({
            ref: reference,
            id: <string>reference.key,
        });
    },

    async all(): Promise<Client[]> {
        const collection: Client[] = [];

        const data = await $db
            .ref(`${BASE_PATH}`)
            .orderByKey()
            .once("value");

        data.forEach(record => {
            collection.push(
                $clientFactory.create({
                    ref: record.ref,
                    id: <string>record.ref.key,
                }),
            );
        });

        return collection;
    },
});

export default $clientManager;
