import Vue from "vue";
import { Module, ActionContext } from "vuex";
import $project, {
    PROJECT_TYPES,
    PROJECT_COUNTRIES,
    PROJECT_AREAS,
    ProjectData,
    ProjectRecord,
} from "../../../domain/project";
interface ProjectState {
    projects: Record<string, ProjectRecord>;
}

/**
 * This could be a Vuex mutator, but then it would be accesible to all components through the store.
 * Which would serve no purpose as it's the store's responsability to keep the state of all records
 */
function register(state: ProjectState, project: ProjectRecord) {
    Vue.set(state.projects, project.uid, project);

    project.on("updated", () => {
        Vue.set(state.projects, project.uid, project);
    });

    project.on("deleted", () => {
        Vue.delete(state.projects, project.uid);
    });
}

async function create({ state }: ActionContext<ProjectState, any>) {
    const project = await $project.create();

    project.on("created", () => {
        register(state, project);
    });

    return project;
}

interface PersistPayload {
    data: ProjectData;
    images?: File[];
}
const $projectModule: Module<ProjectState, any> = {
    namespaced: true,

    state: <ProjectState>{
        projects: {},
    },

    getters: {
        id: state => (id: string) => state.projects[id],
        data: state => Object.values(state.projects).map(record => record.data),
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

        async save(context, { data, images }: PersistPayload) {
            const record = data.uid ? context.getters.id(data.uid) : await create(context);

            record.update(data);

            (images || []).forEach((file: File) => {
                record.addImage(file);
            });

            await record.save();
        },
    },
};

export default $projectModule;
