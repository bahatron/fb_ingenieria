<template>
  <v-select v-model="selected" :items="clients" item-text="name" return-object solo></v-select>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({
    data() {
        return {
            selected: null,
        };
    },

    computed: {
        clients(this: Vue) {
            return this.$store.getters["client/all"];
        },
    },
});
</script>
