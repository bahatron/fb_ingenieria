import $firebase from "@/services/Firebase";
import { Client } from "./ClientFirestoreManager";

const uuid = require("uuid");

const $db = $firebase.database();

const BASE_PATH = "/clients";

const $clientFirebaseRTManager = Object.freeze({
    async persist(data: any) {
        const client = $db.ref(`${BASE_PATH}/${uuid.v4()}`);

        await client.set(data);

        console.log(`client key: ${client.key}`);

        return client;
    },
});

export default $clientFirebaseRTManager;
