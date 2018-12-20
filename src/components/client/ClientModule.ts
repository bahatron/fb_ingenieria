import {
    Module, GetterTree, MutationTree, ActionTree,
} from "vuex";
import Vue from "vue";
import $clientManager from "./services/ClientManager";
import { Client } from "./ClientFacade";

export interface ClientSate {
    clients: {
        [id: string]: Client;
    };

    clientData: {
        [id: string]: ClientData;
    };
}

const state: ClientSate = {
    clients: {},
    clientData: {},
};

/**
 * @todo: define getters
 */
const getters: GetterTree<ClientSate, any> = {
    all: state => Object.values(state.clientData),
};

const mutations: MutationTree<ClientSate> = {
    client(this: any, state, client: Client) {
        this._vm.$set(state.clients, client.id, client);
    },

    clientData(this: any, state, { id, data }) {
        this._vm.$set(state.clientData, id, data);
    },
};

const actions: ActionTree<ClientSate, any> = {
    async create(context, data): Promise<any> {
        const client = await $clientManager.create(data);

        const clientData = await client.data();

        return context.commit("client", {
            id: client.id,
            data: clientData,
        });
    },

    async load(context): Promise<void> {
        const clients = await $clientManager.all();

        await Promise.all(
            clients.map(async (client) => {
                // save client
                context.commit("client", client);

                // save client's data
                client.on("value", (data) => {
                    context.commit("clientData", {
                        id: client.id,
                        data: {
                            id: client.id,
                            ...data,
                        },
                    });
                });
            }),
        );
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
