import $firebase from "../../../services/firebase";
import { Client, ClientData } from "../ClientFacade";
import $clientValidator from "./ClientValidator";
const $db = $firebase.database();
const uuid = require("uuid");

const BASE_PATH = process.env.VUE_APP_DB_CLIENT_PATH;

interface ClientInstance {
    id: string;
    ref: firebase.database.Reference;
}

/**
 * @todo: measure impact of this function vs protoFactory
 */
function closureFactory(reference: firebase.database.Reference): Client {
    return {
        id: <string>reference.key,
        
        async update(data: any): Promise<ClientData> {
            const clientData = $clientValidator.validate(data);
            await reference.update(clientData);

            return clientData;
        },

        async data(): Promise<ClientData> {
            const data = await reference.once("value");

            return data.val();
        },

        on(condition: string, callback: (data: ClientData) => void): void {
            reference.on(<firebase.database.EventType>condition, snapshot => {
                if (snapshot) {
                    callback(snapshot.val());
                }
            });
        },
    };
}

// Client object prototype
const $proto = Object.freeze({
    async update(this: ClientInstance, data: any): Promise<ClientData> {
        const clientData = $clientValidator.validate(data);
        await this.ref.update(clientData);

        return clientData;
    },

    async data(this: ClientInstance): Promise<ClientData> {
        const data = await this.ref.once("value");

        return data.val();
    },

    on(this: ClientInstance, condition: string, callback: (data: ClientData) => void): void {
        this.ref.on(<firebase.database.EventType>condition, snapshot => {
            if (snapshot) {
                callback(snapshot.val());
            }
        });
    },
});

function protoFactory(reference: firebase.database.Reference): Client {
    const instance: ClientInstance = {
        id: <string>reference.key,
        ref: reference,
    };

    return Object.setPrototypeOf(instance, $proto);
}

const $clientManager = Object.freeze({
    async create({ data, id }: { data: any; id?: string }): Promise<Client> {
        const clientId = id || uuid.v4();
        const reference = $db.ref(`${BASE_PATH}/${clientId}`);

        await reference.set($clientValidator.validate(data));

        return protoFactory(reference);
    },

    async all(): Promise<Client[]> {
        const data = await $db
            .ref(`${BASE_PATH}`)
            .orderByKey()
            .once("value");

        const collection: Client[] = [];

        data.forEach(record => {
            collection.push(protoFactory(record.ref));
        });

        return collection;
    },
});

export default $clientManager;
