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

        <FileDropzone ref="dropzone"/>

        <v-checkbox v-model="project.visible" label="Visible en pagina principal" required></v-checkbox>

        <v-card-actions>
            <v-layout justify-end>
                <v-btn class="primary" @click="persist">{{project.id ? 'actualizar' : 'crear'}}</v-btn>
            </v-layout>
        </v-card-actions>
    </v-card>
</template>

<script lang="ts">
import Vue from "vue";
import FileDropzone from "../../common/FileDropzone.vue";

export default Vue.extend({
    components: {
        FileDropzone,
    },

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

        persist() {
            /** @todo: find a way to get the correct typescript for the dropzone component */
            this.project.files = (this.$refs.dropzone as any).files();
            this.$emit("persist", this.project);
        },
    },

    computed: {
        projectTypes(this: any) {
            return this.$store.getters["projects/types"].map((string: string) => ({
                label: this.capitalize(string),
                value: string,
            }));
        },

        projectAreas(this: any) {
            return this.$store.getters["projects/areas"].map((string: string) => ({
                label: this.capitalize(string),
                value: string,
            }));
        },

        projectCountries(this: any) {
            return this.$store.getters["projects/countries"].map((string: string) => ({
                label: this.capitalize(string),
                value: string,
            }));
        },
    },
});
</script>
