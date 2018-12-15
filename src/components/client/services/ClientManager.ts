import $firebase from "../../../services/firebase";
import $clientMapper, { Client } from "./ClientFactory";

const uuid = require("uuid");

const $db = $firebase.database();

const BASE_PATH = "/clients";

const $clientFirebaseRTManager = Object.freeze({
    async persist(data: any): Promise<$firebase.database.Reference> {
        const client = $db.ref(`${BASE_PATH}/${uuid.v4()}`);

        await client.set($clientMapper.map(data));

        console.log(`client key: ${client.key}`);

        return client;
    },
});

export default $clientFirebaseRTManager;
