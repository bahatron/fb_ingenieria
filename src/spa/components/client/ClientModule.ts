import { Store, Module, GetterTree, MutationTree, ActionTree, ActionContext } from "vuex";
import Vue from "vue";

import $client, { ClientData } from "../../../domain/client";

interface Client {
    id: string;
    data: ClientData;
}
export interface ClientSate {
    clients: {
        [id: string]: Client;
    };
}

const $clientModule: Module<ClientSate, any> = {
    namespaced: true,
    state: {
        clients: {},
    },

    getters: <GetterTree<ClientSate, any>>{
        all: state => Object.values(state.clients),
        get: state => (id: string) => state.clients[id],
    },

    mutations: <MutationTree<ClientSate>>{
        addClient(state, client: Client) {
            Vue.set(state.clients, client.id, client);
        },
        removeClient(state, { id }) {
            Vue.delete(state.clients, id);
        },
    },

    actions: <ActionTree<ClientSate, any>>{
        async create(context, data): Promise<void> {
            const client = await $client.create({ data });

            const clientData = await client.data();

            context.commit("addClient", { id: client.id, data: clientData });
        },

        async delete(context, id): Promise<void> {
            /** @todo */
        },

        async load(context): Promise<void> {
            const clients = await $client.all();

            await Promise.all(
                clients.map(async client => {
                    client.on("value", (data: ClientData) => {
                        context.commit("addClient", {
                            id: client.id,
                            data,
                        });
                    });
                }),
            );
        },
    },
};

export default $clientModule;
