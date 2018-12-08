<template>
    <v-toolbar color="amber" app absolute clipped-left>
        <v-toolbar-side-icon @click.native="$store.commit('layout/nav', true)">
        </v-toolbar-side-icon>
        <span class="title ml-3 mr-5">
            <span>Admin Panel</span>
        </span>
    </v-toolbar>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({
});
</script>
