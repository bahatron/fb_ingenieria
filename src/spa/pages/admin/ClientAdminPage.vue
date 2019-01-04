<template>
  <v-container fluid fill-height style="background-color: grey">
    <v-layout class="pa-2" row wrap>
      <v-flex xs12>
        <ClientList/>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script lang="ts">
import Vue from "vue";
import ClientCard from "../../components/client/ClientCard.vue";
import ClientList from "../../components/client/ClientList.vue";

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
