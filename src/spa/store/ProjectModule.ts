import Vue from "vue";
import { Module, ActionContext } from "vuex";
import $project, {
    PROJECT_TYPES,
    PROJECT_COUNTRIES,
    PROJECT_AREAS,
    Project,
    ProjectRecord,
} from "../../domain/project";

/**
 * This could be a Vuex mutator, but then it would be accesible to all components through the store.
 * Which would serve no purpose as it's the store's responsability to keep the state of all records
 */
function register(state: ProjectState, project: ProjectRecord) {
    Vue.set(state.projects, project.uid, project);

    project.on("updated", () => {
        Vue.set(state.projectData, project.uid, project.data);
    });

    project.on("deleted", () => {
        Vue.delete(state.projects, project.uid);
        Vue.delete(state.projectData, project.uid);
    });
}

interface ProjectState {
    projects: Record<string, ProjectRecord>;
    projectData: Record<string, Project>;
}
const $projectModule: Module<ProjectState, any> = {
    namespaced: true,

    state: <ProjectState>{
        projects: {},
        projectData: {},
    },

    getters: {
        id: state => (id: string) => state.projects[id],
        records: state => Object.values(state.projects),
        data: state => Object.values(state.projectData),
        types: () => PROJECT_TYPES,
        areas: () => PROJECT_AREAS,
        countries: () => PROJECT_COUNTRIES,
    },

    actions: {
        async load({ state }) {
            const projects = await $project.all();

            projects.forEach(project => {
                register(state, project);
            });
        },

        async create({ state }: ActionContext<ProjectState, any>): Promise<ProjectRecord> {
            const project = await $project.create();

            project.on("created", () => {
                register(state, project);
            });

            return project;
        },
    },
};

export default $projectModule;
