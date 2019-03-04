import $clientManager from "./services/ClientManager";
import { Model } from "../../services/Database";

export interface ClientData {
    id: string;
    name: string;
    image?: string;
    website?: string;
    description?: string;
    visible: boolean;
}

export type Client = Model<ClientData>;

const $client = {
    create: $clientManager.create,
    all: $clientManager.all,
};

export default $client;
