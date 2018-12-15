import $clientFirebaseRTManager from "./services/ClientManager";
import $clientFactory from './services/ClientFactory';

const $client = {
    manager: $clientFirebaseRTManager,
    factory: $clientFactory
};

export default $client;
