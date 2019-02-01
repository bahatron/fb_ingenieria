<template>
  <v-container fluid fill-height style="background-color: grey">
    <v-layout class="pa-2" row wrap>
      <v-flex xs12>
        <v-card>
          <v-card-title>
            <v-btn color="primary" @click="create()">Agregar</v-btn>

            <v-spacer></v-spacer>

            <!-- create search component -->
            <v-text-field
              v-model="search"
              append-icon="search"
              label="Search"
              single-line
              hide-details
            ></v-text-field>
          </v-card-title>

          <ClientList
            :clients="clients"
            @edit="openDialogWithClient($event)"
            @remove="remove($event)"
            @create="openEmptyDialog()"
            :search="search"
          />
        </v-card>
      </v-flex>
    </v-layout>

    <v-dialog v-model="dialog" max-width="50%">
      <clientCard :client="client" @persist="updateOrCreateClient($event)"/>
    </v-dialog>
  </v-container>
</template>

<script lang="ts">
import Vue from "vue";
import ClientCard from "../../../domain/client/vue/ClientCard.vue";
import ClientList from "../../../domain/client/vue/ClientList.vue";

export default Vue.extend({
    data() {
        return {
            dialog: false,
            search: null,
            client: {},
        };
    },

    created() {
        this.$store.dispatch("clients/load");
    },

    computed: {
        clients(): any {
            return this.$store.getters["clients/all"];
        },
    },

    methods: {
        openEmptyDialog() {
            this.client = {};
            this.dialog = true;
        },

        openDialogWithClient(id: string) {
            this.client = this.$store.getters["clients/id"](id);
            this.dialog = true;
        },

        async updateOrCreateClient(payload: any) {
            try {
                const action = payload.id ? "update" : "create";

                await this.$store.dispatch(`clients/${action}`, payload);
            } catch (err) {
                throw err;
            } finally {
                this.dialog = false;
            }
        },

        async remove(id: string) {
            const client = this.$store.getters["clients/id"](id);

            /** @todo: refactor into proper dialog */
            if (!confirm(`Esta seguro de que quiere eliminar al cliente: ${client.name}`)) {
                return;
            }

            try {
                await this.$store.dispatch("clients/delete", id);
            } catch (err) {
                throw err;
            }
        },
    },

    components: {
        ClientCard,
        ClientList,
    },
});
</script>
