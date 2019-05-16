import $projectManager from "./services/ProjectManager";

export { ProjectRecord } from "./services/ProjectManager";

export interface Project {
    uid: string;
    name: string;
    shortDescription?: string;
    longDescription?: string;
    visible: boolean;
    clientId: string;
    country: ProjectCountry;
    type: ProjectType;
    area: ProjectArea;
    images?: string[];
}

export type ProjectCountry = "panama" | "venezuela";
export const PROJECT_COUNTRIES: ProjectCountry[] = ["panama", "venezuela"];

export type ProjectArea = "industrial" | "commercial" | "institutional" | "residential";
export const PROJECT_AREAS: ProjectArea[] = [
    "industrial",
    "commercial",
    "institutional",
    "residential",
];

export type ProjectType = "shop" | "restaurant" | "office" | "public" | "private";
export const PROJECT_TYPES: ProjectType[] = ["shop", "restaurant", "office", "public", "private"];

const $project = {
    create: $projectManager.create,
    all: $projectManager.all,
};

export default $project;
