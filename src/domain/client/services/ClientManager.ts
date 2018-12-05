import $firebase from "../../../modules/firebase";
import $error from "../../../services/Error";

const $db = $firebase.firestore().collection("clients");

/**
 * @todo: figure how a better name for 'name'
 */
/* eslint-disable no-restricted-globals */
export interface Client {
    name: string;
    website?: string;
    description?: string;
    visible: boolean;
}

function mapClient(data: any): Client {
    const {
        name, website, description, visible,
    } = data;

    if (!name || typeof visible !== "boolean") {
        throw $error.ValidationException("name and visible are required for Client");
    }

    return {
        name,
        website,
        description,
        visible,
    };
}

/** @todo: change return type  */
async function persist(args: any): Promise<$firebase.firestore.DocumentReference> {
    const client: Client = mapClient(args);

    const result: $firebase.firestore.DocumentReference = await $db.add(client);

    const gotten: $firebase.firestore.DocumentSnapshot = await result.get();
    const clientDocument: $firebase.firestore.DocumentData | undefined = await gotten.data();
    console.log("created client", clientDocument);

    /** @todo: convrt type to FirestoreDocument<Client>  */
    return result;
}

// async function find(query: any): Promise<Client[]> {
//     // todo
// }

const $clientManager = Object.freeze({
    persist,
});

export default $clientManager;
