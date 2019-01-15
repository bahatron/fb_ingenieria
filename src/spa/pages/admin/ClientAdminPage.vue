<template>
  <v-container fluid fill-height style="background-color: grey">
    <v-layout class="pa-2" row wrap>
      <v-flex xs12>
        <ClientList :clients="clients"/>
      </v-flex>
      <v-dialog v-model="dialog" max-width="50%">
        <v-btn slot="activator" color="primary" dark>Open Dialog</v-btn>
        <ClientCard :client="clients[0]"/>
      </v-dialog>
    </v-layout>
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

    components: {
        ClientCard,
        ClientList,
    },
});
</script>
