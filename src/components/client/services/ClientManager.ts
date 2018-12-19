import $firebase from "../../../services/firebase";
import { Client } from "../ClientFacade";
import $clientFactory from "./ClientFactory";

const $db = $firebase.database();
const uuid = require("uuid");

/**
 * @todo: move this to an env file?
 */
const BASE_PATH = "/clients";

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
            /**
             * @todo: investigate where key is not ID
             */
            id: reference.key || clientId,
        });
    },
});

export default $clientManager;
