import { ClientData, Client } from "..";
import $database from "../../../services/Database";
import $error from "../../../services/error";

const PATH = "/clients";

/** @todo: refactor this to use an external validator service */
function validator(data: any): ClientData {
    const {
        name, website, description, visible, image,
    } = data;

    if (!name) {
        throw $error.ValidationFailed("'name' and 'visible' are required");
    }

    const client = {
        name,
        image: image || null,
        website: website || null,
        description: description || null,
        visible,
    };

    return client;
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
        return $database.fetch<ClientData>({
            path: PATH,
            validator,
        });
    },
});

export default $clientManager;

interface runtimeProp {
    type: string;
    value: any;
}

interface someObject {
    prop1: string;
    prop2: number;
    [prop: string]: runtimeProp|any;
}

interface addedAtRuntime {
    [prop: string]: runtimeProp|any;
}

type Combi = someObject

const yclass: someObject = {
    prop1: "string",
    prop2: 5,
    prop3: {
        type: "any",
        value: 5,
    },
};