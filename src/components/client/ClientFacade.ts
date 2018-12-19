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

export interface ClientFactory {
    create({ ref, id }: { ref: firebase.database.Reference; id: string }): Client;
}

export interface Client extends ClientBehaviour {
    id: string;
}
