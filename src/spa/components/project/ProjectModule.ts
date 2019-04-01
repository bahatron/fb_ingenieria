import Vue from "vue";
import { Module, Commit } from "vuex";
import $project, {
    PROJECT_TYPES,
    PROJECT_COUNTRIES,
    PROJECT_AREAS,
    Project,
    ProjectData,
} from "../../../domain/project/ProjectFacade";
import $error from "../../../services/error";

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
        [id: string]: ProjectRecord;
    };
}

async function updateProject(project: ProjectRecord) {
    const model = PROJECT_REF[project.id];

    if (!model) {
        throw $error.NotFound(`Project ID: ${project.id} not found`);
    }

    // this should trigger the registered callback on value
    await model.update(project);
}

const $projectModule: Module<ProjectState, any> = {
    namespaced: true,

    state: <ProjectState>{
        projects: {},
    },

    getters: {
        id: state => (id: string) => Object.assign({}, state.projects[id] || {}),
        all: state => Object.values(state.projects),
        types: () => PROJECT_TYPES,
        areas: () => PROJECT_AREAS,
        countries: () => PROJECT_COUNTRIES,
    },

    mutations: {
        add(state, { id, data }) {
            Vue.set(state.projects, id, { id, ...data });
        },

        remove(state, id) {
            Vue.delete(state.projects, id);
        },
    },

    actions: {
        async load({ commit }) {
            const projects = await $project.all();

            await Promise.all(projects.map(project => mapProject({ project, commit })));
        },

        async persist({ commit }, payload) {
            if (payload.id) {
                return updateProject(payload);
            }

            const project = await $project.create({ data: payload });

            await mapProject({ project, commit });
        },

        async delete(context, { id }) {
            const model = PROJECT_REF[id];

            if (!model) {
                return;
            }

            await model.delete();

            context.commit("remove");
        },
    },
};

export default $projectModule;
