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
            @edit="edit($event)"
            @remove="remove($event)"
            @create="create()"
            :search="search"
          />
        </v-card>
      </v-flex>
    </v-layout>

    <v-dialog v-model="dialog" max-width="50%">
      <clientCard :client="client" @persist="persist($event)"/>
    </v-dialog>
  </v-container>
</template>

<script lang="ts">
import Vue from "vue";
import ClientCard from "../../components/client/ClientCard.vue";
import ClientList from "../../components/client/ClientList.vue";

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
        async persist(clientData: any) {
            try {
                console.log("clientDasnapshot.val()ta", clientData);
                await this.$store.dispatch("clients/create", clientData);
            } catch (err) {
                alert(err.message);
                console.log(err.stack);
            } finally {
                this.dialog = false;
            }
        },

        create() {
            // reset client
            this.client = {};
            this.dialog = true;
        },

        async edit(id: string) {
            try {
                this.client = this.$store.getters["clients/get"](id);
                this.dialog = true;
            } catch (err) {
                alert(err.message);
                console.log(err);
            }
        },

        async remove(id: string) {
            const client = this.$store.getters["clients/get"](id);
            if (confirm(`Esta seguro de que quiere eliminar al cliente: ${client.name}`)) {
                try {
                    await this.$store.dispatch("clients/delete", id);
                    alert("done");
                } catch (err) {
                    alert(`Error: ${err.message}`);
                }
            }
        },
    },

    components: {
        ClientCard,
        ClientList,
    },
});
</script>
