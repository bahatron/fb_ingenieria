import {
    Module, GetterTree, MutationTree, ActionTree,
} from "vuex";
import Vue from "vue";
import { Client } from "./ClientFacade";
import $clientManager from "./services/ClientManager";

export interface ClientSate {
    clients: {
        [id: string]: Client;
    };
}

const state: ClientSate = {
    clients: {},
};

/**
 * @todo: define getters
 */
const getters: GetterTree<ClientSate, any> = {
    clients(state) {
        return state.clients;
    },
};

const mutations: MutationTree<ClientSate> = {
    client(this: Vue, state, client: Client) {
        this.$set(state.clients, client.id, client);

        return client.id;
    },
};

const actions: ActionTree<ClientSate, any> = {
    async create(context, data): Promise<any> {
        const client = await $clientManager.persist(data);

        return context.commit("client", client);
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
