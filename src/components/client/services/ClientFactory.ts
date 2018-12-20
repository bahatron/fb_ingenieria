import $clientValidator from "./ClientValidator";
import { Client, ClientData, ClientProto, ClientBehaviour, ClientFactory } from "../ClientFacade";
import $firebase from "../../../services/firebase";

interface CreateInterface {
    ref: $firebase.database.Reference;
    id: string;
}

/**
 * @todo:
 * maybe, if the manager defines the implementation of data and update
 * we could make the factory function to be absolutedly detached of whichever
 * technology we're using in the background
 */
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
};

export default $clientFactory;
