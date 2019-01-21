import { Store, Module, GetterTree, MutationTree, ActionTree, ActionContext } from "vuex";
import Vue from "vue";

import $client, { ClientData, Client } from "../../../domain/client";
interface ClientRef {
    id: string;
    data: ClientData;
    client: Client;
}

interface addClientPayload {
    client: Client;
    data: ClientData;
}
export interface ClientSate {
    clients: {
        [id: string]: ClientRef;
    };
}

function mapClientData(record: ClientRef) {
    return {
        id: record.id,
        ...record.data,
    };
}

const $clientModule: Module<ClientSate, any> = {
    namespaced: true,
    state: {
        clients: {},
    },

    getters: <GetterTree<ClientSate, any>>{
        all: state => Object.values(state.clients).map(mapClientData),

        id: state => (id: string) => mapClientData(state.clients[id]),

        client: state => (id: string) => state.clients[id].client,
    },

    mutations: <MutationTree<ClientSate>>{
        addClient(state, { client, data }: addClientPayload) {
            Vue.set(state.clients, client.id, { id: client.id, client, data });
        },

        removeClient(state, { id }: { id: string }) {
            Vue.delete(state.clients, id);
        },
    },

    actions: <ActionTree<ClientSate, any>>{
        async create(context, payload): Promise<void> {
            const client = await $client.create({ data: payload });

            const data = await client.data();

            context.commit("addClient", { client, data });
        },

        async update(context, data): Promise<void> {
            const client = context.getters.client(data.id);

            await client.update(data);

            /** @todo: find out why the on condition is not triggering the mutations */
            const clientData = await client.data();

            context.commit("addClient", { client, data: clientData });
        },

        async delete(context, id): Promise<void> {
            const client = context.getters.client(id);

            /** @todo: use error module */
            if (!client) {
                throw new Error(`Client ${id} not found in store`);
            }

            await client.delete();

            context.commit("removeClient", { id: client.id });
        },

        async load(context): Promise<void> {
            const clients = await $client.all();

            clients.forEach(client => {
                client.on("value", (data: ClientData) => {
                    context.commit("addClient", { client, data });
                });
            });
        },
    },
};

export default $clientModule;
