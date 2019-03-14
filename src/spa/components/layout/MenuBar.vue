<template>
  <v-navigation-drawer temporary v-model="nav" fixed app>
    <v-list dense class="grey lighten-4">
      <template v-for="(item, i) in items">
        <v-layout v-if="item.heading" :key="i" row align-center @click="goToPage(item.route)">
          <v-flex xs6>
            <h3 v-if="item.heading" class="pl-4">{{ item.heading }}</h3>
          </v-flex>
        </v-layout>
        <v-divider v-else-if="item.divider" :key="i" dark class="my-3"></v-divider>
        <v-list-tile v-else :key="i" @click="goToPage(item.route)">
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title class="grey--text">{{ item.text }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </template>
    </v-list>
  </v-navigation-drawer>
</template>

<script lang="ts">
import Vue from "vue";
import { Location } from "vue-router";

export default Vue.extend({
    data() {
        return {
            items: [
                {
                    heading: "Menu",
                },
                {
                    divider: true,
                },
                {
                    icon: "face",
                    text: "Clientes",
                    route: "clientAdminPage",
                },
                {
                    icon: "work",
                    text: "Projectos",
                    route: "projectAdminPage",
                },
            ],
        };
    },

    computed: {
        nav: {
            get() {
                const self: any = this;
                return self.$store.getters["layout/nav"];
            },

            set(state: boolean) {
                const self: any = this;
                self.$store.commit("layout/nav", state);
            },
        },
    },

    methods: {
        goToPage(route?: string) {
            const location: Location = {
                name: route,
            };
            this.$router.push(location);
        },
    },
});
</script>
