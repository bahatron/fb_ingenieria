import $projectManager from "./services/ProjectManager";
import { Model } from "../../services/FirebaseManager";

export interface ProjectData {
    name: string;
    shortDescription?: string;
    longDescription?: string;
    visible: boolean;
    clientId: string;
    country: "panama" | "venezuela";
    type: "shop" | "restaurant" | "office" | "public" | "private";
    area: "industrial" | "commercial" | "institutional" | "residential";
}

export type Project = Model<ProjectData>;

const $project = {
    create: $projectManager.create,
    all: $projectManager.all,
};

export default $project;
