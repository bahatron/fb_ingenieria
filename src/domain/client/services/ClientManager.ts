import { ClientData, Client } from "..";
import $error from "../../error";
import $database from "../../../services/Database";

const PATH = "/clients";

/** @todo: improve validations */
function validator(data: any): ClientData {
    const {
        name, website, description, visible, image, id,
    } = data;

    if (!name || typeof visible !== "boolean" || !id) {
        throw $error.ValidationFailed("'name' and 'visible' are required");
    }

    return {
        id,
        name,
        image: image || null,
        website: website || null,
        description: description || null,
        visible,
    };
}

const $clientManager = Object.freeze({
    async create({ data, id }: { data: any; id?: string }): Promise<Client> {
        return $database.persist<ClientData>({
            data,
            path: PATH,
            id,
            validator,
        });
    },

    async all(): Promise<Client[]> {
        return await $database.fetch<ClientData>({
            path: PATH,
            validator,
        });
    },
});

export default $clientManager;
