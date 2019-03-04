import Vue from "vue";
import { Module, GetterTree, MutationTree, ActionTree } from "vuex";
import $client, { ClientData, Client } from "../../../domain/client";

interface ClientSate {
    clients: {
        [id: string]: {
            data: ClientData;
            ref: Client;
        };
    };
}

const $clientModule: Module<ClientSate, any> = {
    namespaced: true,

    state: <ClientSate>{
        clients: {},
    },

    getters: <GetterTree<ClientSate, any>>{
        id: state => (id: string) => state.clients[id].data,

        all: state => Object.values(state.clients),
    },

    mutations: <MutationTree<ClientSate>>{
        addClient(state, { client, data }: { client: Client; data: ClientData }) {
            Vue.set(state.clients, client.id, { client, data });
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
            // @todo: validate!!
            const client = context.state.clients[data.id].ref;

            await client.update(data);

            const clientData = await client.data();

            context.commit("addClient", { client, data: clientData });
        },

        async delete(context, id): Promise<void> {
            // @todo: validate!!
            const client = context.state.clients[id].ref;

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
