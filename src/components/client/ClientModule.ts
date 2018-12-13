import {
    Module, GetterTree, MutationTree, ActionTree,
} from "vuex";
import $client from "./ClientFacade";

export interface ClientSate {}

/**
 * @todo: define state
 */
const state: ClientSate = {};

/**
 * @todo: define getters
 */
const getters: GetterTree<ClientSate, any> = {};

const mutations: MutationTree<ClientSate> = {};

const actions: ActionTree<ClientSate, any> = {
    async create(context, payload): Promise<any> {
        const client = await $client.manager.persist(payload);

        /**
         * @todo: commit client reference
         */
        return client;
    },
};

const $clientModule: Module<ClientSate, any> = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};

export default $clientModule;
