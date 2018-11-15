<template>
    <v-navigation-drawer temporary v-model="nav" fixed app>
        <v-list dense class="grey lighten-4">
            <template v-for="(item, i) in items">
                <v-layout v-if="item.heading" :key="i" row align-center>
                    <v-flex xs6>
                        <v-subheader v-if="item.heading">{{ item.heading }}</v-subheader>
                    </v-flex>
                    <v-flex xs6 class="text-xs-right">
                        <v-btn small flat>edit</v-btn>
                    </v-flex>
                </v-layout>
                <v-divider v-else-if="item.divider" :key="i" dark class="my-3"></v-divider>
                <v-list-tile v-else :key="i">
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
import Vue from 'vue';

export default Vue.extend({
    data() {
        return {
            /**
             * @todo: move the nav menu list to the store
             */
            items: [
                // {
                //     heading: 'a heading',
                //     icon: 'anchor',
                //     text: 'a text'
                // }
            ],
        };
    },

    computed: {
        nav: {
            get() {
                const self: any = this;
                return self.$store.getters['layout/nav'];
            },

            set(state: boolean) {
                const self: any = this;
                self.$store.commit('layout/nav', state);
            },
        },
    },
});
</script>
