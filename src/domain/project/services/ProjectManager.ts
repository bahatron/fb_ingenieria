import $database, { Model } from "../../../services/Database";
import $error from "../../error";
import { ProjectData, Project } from "../ProjectFacade";

const PATH = "/projects";
const VALID_COUNTRIES = ["panama", "venezuela"];
const VALID_TYPES = ["shop", "restaurant", "office", "public", "private"];
const VALID_AREAS = ["industrial", "commercial", "institutional", "residential"];

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

    if (!clientId || !name) {
        throw $error.ValidationFailed("client ID and name are required");
    }

    if (!VALID_COUNTRIES.includes(country)) {
        throw $error.ValidationFailed(`${country} is not valid`);
    }

    if (!VALID_TYPES.includes(type)) {
        throw $error.ValidationFailed(`${type} is not a valid project type`);
    }

    if (!VALID_AREAS.includes(area)) {
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

const $projectManager = {
    async create({ data, id }: { data: any; id?: string }): Promise<Project> {
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
