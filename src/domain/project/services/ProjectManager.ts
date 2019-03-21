import $database from "../../../services/Database";
import {
    ProjectData,
    Project,
    PROJECT_TYPES,
    PROJECT_COUNTRIES,
    PROJECT_AREAS,
} from "../ProjectFacade";
import $error from "../../../services/error";

const PATH = "/projects";

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
        visible: Boolean(visible),
    };
}

interface create {
    data: any;
    id?: string;
}

const $projectManager = {
    async create({ data, id }: create): Promise<Project> {
        return $database.persist<ProjectData>({
            data,
            path: PATH,
            validator,
            id,
        });
    },

    async all(): Promise<Project[]> {
        return $database.fetch<ProjectData>({ path: PATH, validator });
    },
};

export default $projectManager;
