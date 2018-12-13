import {
    Module, GetterTree, MutationTree, ActionTree,
} from "vuex";
import $firebase from "@/services/Firebase";
import $client from "./client/ClientFacade";
import $clientFirebaseRTManager from "./client/services/ClientFirebaseRTManager";

export interface ClientSate {}

const state: ClientSate = {};

const getters: GetterTree<ClientSate, any> = {};

const mutations: MutationTree<ClientSate> = {};

const actions: ActionTree<ClientSate, any> = {
    async create(context, payload): Promise<any> {
        // const client = await $client.firestore.persist(payload);

        const client = await $clientFirebaseRTManager.persist(payload);

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
