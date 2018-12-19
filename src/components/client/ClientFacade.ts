import $clientFactory from "./services/ClientFactory";
import $clientManager from "./services/ClientManager";

/**
 * @todo: DRY this
 */
interface Factory {
    isInstanceOf(obj: any): boolean;
}
/**
 * @todo: ins it worth getting interfaces this far?
 */
export interface ClientFactory extends Factory {
    create({ ref, id }: { ref: firebase.database.Reference; id: string }): Client;
}
export interface ClientData {
    name: string;
    website?: string;
    image?: string;
    description?: string;
    visible: boolean;
}
export interface ClientBehaviour {
    data(): Promise<ClientData>;
    update(data: any): Promise<ClientData>;
}

export interface ClientProto {
    id: string;
    ref: firebase.database.Reference;
}

export interface Client extends ClientBehaviour {
    id: string;
}

const $clientFacade = {
    manager: $clientManager,
    factory: $clientFactory,
};

export default $clientFacade;
