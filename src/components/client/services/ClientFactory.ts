import $clientValidator from "./ClientValidator";
import $clientManager from "./ClientManager";
import { Client, ClientData, ClientProto, ClientBehaviour, ClientFactory } from "../ClientFacade";
// import * as uuid from 'uuid';
const uuid = require("uuid");

interface CreateInterface {
    ref: firebase.database.Reference;
    id: string;
}

const $clientClass: ClientBehaviour = Object.freeze({
    async update(this: ClientProto, data: any): Promise<ClientData> {
        const clientData = $clientValidator.validate(data);
        await this.ref.update(clientData);
        return clientData;
    },

    async data(this: ClientProto): Promise<ClientData> {
        const data = await this.ref.once("value");

        return data.val();
    },
});

const $clientFactory: ClientFactory = {
    create({ ref, id }: CreateInterface): Client {
        const proto: ClientProto = {
            id,
            ref,
        };

        /**
         * @todo: is there a way for typescript to validate this?
         */
        const client = <Client>Object.setPrototypeOf(proto, $clientClass);

        return client;
    },

    isInstanceOf(obj: any): boolean {
        return obj.isPrototypeOf($clientClass);
    },
};

export default $clientFactory;
