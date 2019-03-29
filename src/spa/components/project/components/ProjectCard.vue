<template>
    <v-card class="pa-4">
        <v-text-field v-model="project.name" label="Nombre del projecto" required></v-text-field>
        <v-textarea
            auto-grow
            rows="2"
            v-model="project.shortDescription"
            label="Descripcion corta"
            counter="140"
        ></v-textarea>
        <v-textarea auto-grow rows="2" v-model="project.longDescription" label="Reseña"></v-textarea>
        <v-select
            :items="$store.getters['clients/all']"
            label="Cliente"
            item-value="id"
            v-model="project.clientId"
            item-text="name"
        ></v-select>

        <v-select
            :items="projectTypes"
            label="Tipo de Projecto"
            item-text="label"
            item-value="value"
            v-model="project.type"
        ></v-select>

        <v-select
            :items="projectAreas"
            label="Area de Projecto"
            item-text="label"
            item-value="value"
            v-model="project.area"
        ></v-select>

        <v-select
            :items="projectCountries"
            label="Pais de Projecto"
            item-text="label"
            item-value="value"
            v-model="project.country"
        ></v-select>

        <v-checkbox v-model="project.visible" label="Visible en pagina principal" required></v-checkbox>

        <v-card-actions>
            <v-layout justify-end>
                <v-btn
                    class="primary"
                    @click="$emit('persist', project)"
                >{{project.id ? 'actualizar' : 'crear'}}</v-btn>
            </v-layout>
        </v-card-actions>
    </v-card>
</template>

<script lang="ts">
import Vue from "vue";
import { PROJECT_TYPES, PROJECT_COUNTRIES, PROJECT_AREAS } from "../../../../domain/project/ProjectFacade";

export default Vue.extend({
    props: {
        project: {
            type: Object,
            default() {
                return {
                    id: null,
                    name: null,
                    shortDescription: null,
                    longDescription: null,
                    visible: false,
                    clientId: null,
                    country: null,
                    type: null,
                    area: null,
                };
            },
        },
    },

    methods: {
        capitalize(string: string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
    },

    computed: {
        projectTypes(this: any) {
            return PROJECT_TYPES.map(string => ({
                label: this.capitalize(string),
                value: string,
            }));
        },

        projectAreas(this: any) {
            return PROJECT_AREAS.map(string => ({
                label: this.capitalize(string),
                value: string,
            }));
        },

        projectCountries(this: any) {
            return PROJECT_COUNTRIES.map(string => ({
                label: this.capitalize(string),
                value: string,
            }));
        },
    },
});
</script>
