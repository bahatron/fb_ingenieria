<template>
  <v-layout class="pa-2" justify-start column>
    <h1 class="pl-4">FB Ingenieria</h1>
  </v-layout>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({
    mounted() {
        this.$store.commit("layout/nav", true);
    },
});
</script>
