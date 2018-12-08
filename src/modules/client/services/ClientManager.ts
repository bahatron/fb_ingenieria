import $firebase from "../../../services/Firebase";
import $error from "../../../services/Error";

const $db = $firebase.firestore().collection("clients");

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
        website: website || null,
        description: description || null,
        visible,
    };
}

async function persist(data: any): Promise<$firebase.firestore.DocumentSnapshot> {
    // const doc = await $db.doc();
    // await doc.set(mapClient(data));

    const doc = await $db.add(mapClient(data));

    const client = await doc.get();

    return client;
}

async function get(id: any): Promise<$firebase.firestore.DocumentSnapshot | null> {
    const result = await $db.doc(id).get();

    return result.exists ? result : null;
}

const $clientManager = Object.freeze({
    persist,
    get,
    where: $db.where,
});

export default $clientManager;
