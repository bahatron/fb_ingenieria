import { Client, ClientData } from "..";
import $error from "../../error";
import $firebaseManager from "../../../services/FirebaseManager";

const PATH = "/clients";

/** @todo: refactor this to use an external validator service */
function validator(data: any): ClientData {
    const {
        name, website, description, visible, image,
    } = data;

    if (!name || typeof visible !== "boolean") {
        throw $error.ValidationException("'name' and 'visible' are required");
    }

    return {
        name,
        image: image || null,
        website: website || null,
        description: description || null,
        visible,
    };
}

const $clientManager = Object.freeze({
    async create({ data, id }: { data: any; id?: string }): Promise<Client> {
        return $firebaseManager.persist({
            data,
            path: PATH,
            id,
            validator,
        });
    },

    async all(): Promise<Client[]> {
        return await $firebaseManager.fetch<ClientData>({
            path: PATH,
            validator,
        });
    },
});

export default $clientManager;
