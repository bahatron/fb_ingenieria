export interface ProjectData {
    clientId: string;
    name: string;
    shortDescription?: string;
    longDescription?: string;
    visible: boolean;
    country: string;
    area: string;
    type: string;
    images: string[];
}

export interface Project {
    id: string;
    data(): Promise<ProjectData>;
}

const $project = {};

export default $project;
