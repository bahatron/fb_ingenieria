<template>
    <v-card class="pa-4">
        <v-text-field v-model="formData.name" label="Nombre del projecto"></v-text-field>
        <v-textarea
            auto-grow
            rows="2"
            v-model="formData.shortDescription"
            label="Descripcion corta"
            counter="140"
        ></v-textarea>
        <v-textarea auto-grow rows="2" v-model="formData.longDescription" label="Reseña"></v-textarea>
        <v-select
            :items="$store.getters['clients/all']"
            label="Cliente"
            item-value="id"
            v-model="formData.clientId"
            item-text="name"
        ></v-select>

        <v-select
            :items="projectTypes"
            label="Tipo de Projecto"
            item-text="label"
            item-value="value"
            v-model="formData.type"
        ></v-select>

        <v-select
            :items="projectAreas"
            label="Area de Projecto"
            item-text="label"
            item-value="value"
            v-model="formData.area"
        ></v-select>

        <v-select
            :items="projectCountries"
            label="Pais de Projecto"
            item-text="label"
            item-value="value"
            v-model="formData.country"
        ></v-select>

        <FileDropzone ref="dropzone"/>

        <v-checkbox v-model="formData.visible" label="Visible en pagina principal"></v-checkbox>

        <v-card-actions>
            <v-layout justify-end>
                <v-btn class="primary" @click="persist">{{projectData ? "Actualizar" : "Crear"}}</v-btn>
            </v-layout>
        </v-card-actions>
    </v-card>
</template>

<script lang="ts">
import Vue from "vue";
import FileDropzone from "../../common/FileDropzone.vue";
import $error from "../../../../services/error";
import { ProjectData } from "../../../../domain/project";

export default Vue.extend({
    components: {
        FileDropzone,
    },

    props: {
        projectData: {
            type: Object,
        },
    },

    methods: {
        capitalize(string: string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },

        persist(this: any) {
            /** @todo: find a way to get the correct typescript for the dropzone component */
            const images = (this.$refs.dropzone as any).getFiles() || [];

            this.$store.dispatch("projects/save", {
                images,
                data: this.formData,
            }).then(() => {
                /** @todo: use snackbar, maybe move this logic to the module */
                alert("Projecto guardado");
            }).catch((err: Error) => {
                /** @todo: use snackbar, maybe move this logic to the module */
                alert(`Error guardando projecto: ${err.message}`);
                console.log(err);
            });

            this.$emit("close");
        },
    },

    computed: {
        formData(): any {
            return Object.assign({}, this.projectData || {});
        },

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
