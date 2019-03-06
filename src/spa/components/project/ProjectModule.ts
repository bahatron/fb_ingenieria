import Vue from "vue";
import { Module, Commit } from "vuex";
import $project, { Project, ProjectData } from "../../../domain/project/ProjectFacade";
import $error from "../../../domain/error";

const PROJECT_REF: { [id: string]: Project } = {};

interface mapProject {
    project: Project;
    commit: Commit;
}

async function mapProject({ project, commit }: mapProject): Promise<void> {
    PROJECT_REF[project.id] = project;

    project.on("value", data => {
        commit("add", { id: project.id, data });
    });

    const projectData = await project.data();

    commit("add", { id: project.id, data: projectData });
}

interface ProjectRecord extends ProjectData {
    id: string;
}

interface ProjectState {
    projects: {
        // [id: string]: {
        //     id: string & ProjectData;
        // };
        [id: string]: ProjectRecord;
    };
}

const $projectModule: Module<ProjectState, any> = {
    namespaced: true,

    state: <ProjectState>{
        projects: {},
    },

    getters: {
        id: state => (id: string) => state.projects[id],
        all: state => Object.values(state.projects),
    },

    mutations: {
        add(state, { id, data }) {
            Vue.set(state.projects, id, { id, ...data });
        },

        remove(state, { id }) {
            Vue.delete(state.projects, id);
        },
    },

    actions: {
        async load({ commit }) {
            const projects = await $project.all();

            await Promise.all(projects.map(project => mapProject({ project, commit })));
        },

        async create({ commit }, payload) {
            const project = await $project.create({ data: payload });

            await mapProject({ project, commit });
        },

        async update(context, { project }: { project: ProjectRecord }) {
            const model = PROJECT_REF[project.id];

            if (!model) {
                throw $error.NotFound(`Project ID: ${project.id} not found`);
            }

            // this should trigger the registered callback on value
            await model.update(project);
        },

        async delete(context, { id }) {
            const model = PROJECT_REF[id];

            if (!model) {
                return;
            }

            await model.delete();
        },
    },
};

export default $projectModule;
