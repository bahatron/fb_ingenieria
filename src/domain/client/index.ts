import $clientManager from "./services/ClientManager";

export interface ClientData {
    name: string;
    website?: string;
    image?: string;
    description?: string;
    visible: boolean;
}

export interface Client {
    id: string;
    data(): Promise<ClientData>;
    update(data: any): Promise<ClientData>;
    on(condition: string, callback: (data: ClientData) => void): void;
}

const $client = {
    manager: $clientManager,
};

export default $client;
