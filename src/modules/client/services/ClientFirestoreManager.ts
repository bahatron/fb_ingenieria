import $firebase from "../../../services/Firebase";
import $error from "../../../services/Error";

const $db = $firebase.firestore().collection("clients");

export interface Client {
    name: string;
    website?: string;
    imageUrl?: string;
    description?: string;
    visible: boolean;
}

function mapClient(data: any): Client {
    const {
        name, website, description, visible, imageUrl,
    } = data;

    if (!name || typeof visible !== "boolean") {
        throw $error.ValidationException("name and visible are required for Client");
    }

    return {
        name,
        website: website || null,
        description: description || null,
        imageUrl: imageUrl || null,
        visible,
    };
}

const $clientFirestoreManager = Object.freeze({
    async persist(data: any): Promise<$firebase.firestore.DocumentSnapshot> {
        const doc = await $db.add(mapClient(data));

        const client = await doc.get();

        return client;
    },

    /**
     * @param {any} id client ID
     * @returns {$firebase.firestore.DocumentSnapshot} the client data if exists
     */
    async get(id: any): Promise<$firebase.firestore.DocumentSnapshot | null> {
        const result = await $db.doc(id).get();

        return result.exists ? result : null;
    },

    /**
     * Retrieves a list of clients
     *
     * @param args firestore where interface arguments
     * @returns firestore query
     */
    where: $db.where,
});

export default $clientFirestoreManager;
