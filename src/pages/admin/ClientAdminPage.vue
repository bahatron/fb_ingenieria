<template>
  <v-container fluid fill-height style="background-color: grey">
    <v-layout class="pa-2" column>
      <v-flex xs12>
        <ClientList/>
      </v-flex>
      <v-flex xs7>
        <v-card style="background-color: red; height: 100px">

        </v-card>
      </v-flex>
      <v-flex xs6>
        <v-card style="background-color: red; height: 100px">

        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script lang="ts">
import Vue from "vue";
import ClientCard from "../../components/client/vue/ClientCard.vue";
import ClientList from "../../components/client/vue/ClientList.vue";

export default Vue.extend({
    created() {
        this.$store.dispatch("client/load");
    },

    components: {
    // ClientCard,
        ClientList,
    },
});
</script>
