import $firebase from "../../../adapters/firebase";
import $projectValidator from "./ProjectValidator";
import { ProjectData, Project } from "..";

const uuid = require("uuid");

const $db = $firebase.database;
const BASE_PATH = "/projects";

function factory({ reference }: { reference: firebase.database.Reference }): Project {
    return {
        get id() {
            return <string>reference.key;
        },

        async data(): Promise<ProjectData> {
            const data = await reference.once("value");

            return data.val();
        },
    };
}

const $projectManager = {
    async persist({ data, id }: { data: any; id?: string }) {
        const key: string = id || uuid.v4();

        const reference = $db.ref(`${BASE_PATH}/${key}`);

        await reference.set($projectValidator.validate(data));

        return factory({ reference });
    },
};

export default $projectManager;
