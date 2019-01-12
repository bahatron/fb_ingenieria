import $clientManager from "./services/ClientManager";
import { Model } from "../services/FirebaseManager";

export interface ClientData {
    name: string;
    website?: string;
    image?: string;
    description?: string;
    visible: boolean;
}

export type Client = Model<ClientData>;

const $client = {
    manager: $clientManager,
};

export default $client;
