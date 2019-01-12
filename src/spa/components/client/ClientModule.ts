import {
    Module, GetterTree, MutationTree, ActionTree,
} from "vuex";

import $client, { Client } from "../../../domain/client";

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
        const client = await $client.manager.create(data);

        const clientData = await client.data();

        return context.commit("client", {
            id: client.id,
            data: clientData,
        });
    },

    async load(context): Promise<void> {
        const clients = await $client.manager.all();

        await Promise.all(
            clients.map(async (client) => {
                // save client
                context.commit("client", client);

                // update client data when it changes
                client.on("value", (data: ClientData) => {
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
