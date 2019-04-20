import $database, { Model } from "../../../services/Database";
import {
    ProjectData,
    Project,
    PROJECT_TYPES,
    PROJECT_COUNTRIES,
    PROJECT_AREAS,
} from "../ProjectFacade";
import $error from "../../../services/error";
import $storage from "../../../services/Storage";

const PATH = "/projects";

interface projectFactory {
    dataRef: Model<ProjectData>;
}

interface ProjectManager {
    create(params: create): Promise<Project>;
    all(): Promise<Project[]>;
}

interface create {
    data: any;
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
        images
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

function projectFactory({ dataRef }: projectFactory): Project {
    const project = {
        async delete() {
            const data = await dataRef.data();

            await Promise.all([dataRef.delete(), data.images.map($storage.delete)]);
        },
    };

    return Object.setPrototypeOf(project, dataRef);
}

const $projectManager: ProjectManager = {
    async create({ data, id }: create): Promise<Project> {

        console.log(data);

        let files: File[] = [];

        if (Array.isArray(data.files)) {
            files = files.concat(data.files.filter((item: any) => item instanceof File));
        }

        if (Array.isArray(data.images)) {
            files = files.concat(data.images.files((item: any) => item instanceof File));
        }

        data.images = await Promise.all(files.map(async file => $storage.upload(file)));

        const dataRef = await $database.persist<ProjectData>({
            data,
            path: PATH,
            validator,
            id,
        });

        return projectFactory({ dataRef });
    },

    async all(): Promise<Project[]> {
        const dataRefs = await $database.fetch<ProjectData>({ path: PATH, validator });

        return dataRefs.map(ref => projectFactory({ dataRef: ref }));
    },
};

export default $projectManager;
