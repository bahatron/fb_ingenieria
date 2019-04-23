import $database, { Model } from "../../../services/Database";
import {
    ProjectData, PROJECT_TYPES, PROJECT_COUNTRIES, PROJECT_AREAS,
} from "..";
import $error from "../../../services/error";
import $storage from "../../../services/Storage";

const UUID: any = require("uuid");

const PATH = "/projects";

interface Project {

}

interface projectFactory {
    record: Model<ProjectData>;
    isNew: boolean;
}

interface ProjectManager {
    create(params: create): Promise<Project>;
    all(): Promise<Project[]>;
}

interface create {
    data?: any;
    id?: string;
}

/** @todo improve validation */
function validator(data: any): ProjectData {
    const {
        clientId,
        name,
        country,
        area,
        type,
        visible,
        shortDescription,
        longDescription,
        images,
    } = data;

    if (!clientId) {
        throw $error.ValidationFailed("client id is required");
    }

    if (!name) {
        throw $error.ValidationFailed("name is required");
    }

    if (!PROJECT_COUNTRIES.includes(country)) {
        throw $error.ValidationFailed(`${country} is not valid`);
    }

    if (!PROJECT_TYPES.includes(type)) {
        throw $error.ValidationFailed(`${type} is not a valid project type`);
    }

    if (!PROJECT_AREAS.includes(area)) {
        throw $error.ValidationFailed(`${area} is not a valid project area`);
    }

    return {
        clientId,
        name,
        country,
        area,
        type,
        shortDescription,
        longDescription,
        images,
        visible: Boolean(visible),
    };
}

function projectFactory({ record, isNew }: projectFactory): Project {
    let $data: Partial<ProjectData> = {};

    const project = {
        async delete() {
            const data = await record.data();

            await Promise.all([record.delete(), data.images.map($storage.delete)]);
        },

        async update(data: Partial<ProjectData>): Promise<Project> {
            /** @todo: deepMerge */
            $data = validator({ ...$data, ...data });

            if (!isNew) {
                await record.update($data);
            }

            return this;
        },

        async save(): Promise<void> {
            if(isNew) {
                record.set(validator($data));
            }
        },
    };

    return Object.setPrototypeOf(project, record);
}

const $projectManager: ProjectManager = {
    async create({ data }): Promise<Project> {
        const uid = UUID.v4();

        const record = await $database.new({ path: PATH, id: uid, validator });

        return projectFactory({ record, isNew: true });
    },

    async all(): Promise<Project[]> {
        const dataRefs = await $database.fetch<ProjectData>({ path: PATH, validator });

        return dataRefs.map(record => projectFactory({ record, isNew: false }));
    },
};

export default $projectManager;
