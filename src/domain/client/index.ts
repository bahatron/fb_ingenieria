import $clientManager from "./services/ClientManager";
import { Model } from "../../services/DatabaseManager";

export interface ClientData {
    name: string;
    image?: string;
    website?: string;
    description?: string;
    visible: boolean;
}

export type Client = Model<ClientData>;

const $client = {
    manager: $clientManager,
};

export default $client;
