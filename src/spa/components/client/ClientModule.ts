import Vue from "vue";
import { Module, GetterTree, MutationTree, ActionTree } from "vuex";
import $client, { ClientData, Client } from "../../../domain/client";
interface ClientRef {
    id: string;
    data: ClientData;
    client: Client;
}
interface ClientSate {
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

    state: <ClientSate>{
        clients: {},
    },

    getters: <GetterTree<ClientSate, any>>{
        id: state => (id: string) => mapClientData(state.clients[id]),

        all: state => Object.values(state.clients).map(mapClientData),

        ref: state => (id: string) => state.clients[id].client,
    },

    mutations: <MutationTree<ClientSate>>{
        addClient(state, { client, data }: { client: Client; data: ClientData }) {
            Vue.set(state.clients, client.id, { id: client.id, client, data });
        },

        removeClient(state, { id }: { id: string }) {
            Vue.delete(state.clients, id);
        },
    },

    actions: <ActionTree<ClientSate, any>>{
        async create(context, payload): Promise<void> {
            const client = await $client.manager.create({ data: payload });

            const data = await client.data();

            context.commit("addClient", { client, data });
        },

        async update(context, data): Promise<void> {
            const client = context.getters.ref(data.id);

            await client.update(data);

            const clientData = await client.data();

            context.commit("addClient", { client, data: clientData });
        },

        async delete(context, id): Promise<void> {
            const client = context.getters.ref(id);

            await client.delete();

            context.commit("removeClient", { id: client.id });
        },

        async load(context): Promise<void> {
            const clients = await $client.manager.all();

            clients.forEach(client => {
                client.on("value", (data: ClientData) => {
                    context.commit("addClient", { client, data });
                });
            });
        },
    },
};

export default $clientModule;
