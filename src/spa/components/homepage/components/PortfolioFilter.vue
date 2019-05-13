<template>
    <v-layout class="project-filter" row wrap>
        <v-flex xs12 class="project-filter-list">
            <v-chip
                class="white--text"
                :style="isFilterSelected('country', country)"
                v-for="country in projectCountries"
                :key="country"
                @click="changeFilter('country', country)"
            >{{country}}</v-chip>
        </v-flex>
        <v-flex xs12 class="project-filter-list">
            <v-chip
                class="white--text"
                :style="isFilterSelected('area', area)"
                v-for="area in projectAreas"
                :key="area"
                @click="changeFilter('area', area)"
            >{{area}}</v-chip>
        </v-flex>
        <v-flex xs12 class="project-filter-list">
            <v-chip
                class="white--text"
                :style="isFilterSelected('type', type)"
                v-for="type in projectTypes"
                :key="type"
                @click="changeFilter('type', type)"
            >{{type}}</v-chip>
        </v-flex>
    </v-layout>
</template>

<script lang="ts">
import Vue from "vue";
import capitalize from "../../../mixins/capitalize";

export default Vue.extend({
    data() {
        return {
            selectedColor: "#fb6816",
            availableColor: "#202835",
            filter: {
                country: null,
                area: null,
                type: null,
            },
        };
    },

    mixins: [capitalize],

    methods: {
        changeFilter(this: any, filter: string, value: string) {
            if (this.filter[filter] === value) {
                this.filter[filter] = null;
            } else {
                this.filter[filter] = value;
            }

            this.$emit("filterChange", this.filter);
        },

        mapEnum(this: any, collection: string[]): Record<string, string> {
            return collection.reduce((carry: Record<string, string>, value: string) => {
                carry[value] = this.capitalize(this.$store.getters["lang/translate"](value));

                return carry;
            }, {});
        },

        findKey(this: any, enumBag: Record<string, string>, value: string) {
            return Object.entries(enumBag).reduce((key: string, entry) => {
                if (entry[1] === value) {
                    // eslint-disable-next-line no-param-reassign, prefer-destructuring
                    key = entry[0];
                }

                return key;
            }, "");
        },
    },

    computed: {
        projectCountries(this: any) {
            return this.mapEnum(this.$store.getters["projects/countries"]);
        },

        projectAreas(this: any) {
            return this.mapEnum(this.$store.getters["projects/areas"]);
        },

        projectTypes(this: any) {
            return this.mapEnum(this.$store.getters["projects/types"]);
        },

        isFilterSelected(this: any) {
            return (filter: string, value: string) => {
                const colour = this.filter[filter] === value ? this.selectedColor : this.availableColor;
                return {
                    "background-color": colour,
                    "border-color": colour,
                };
            };
        },
    },
});
</script>
