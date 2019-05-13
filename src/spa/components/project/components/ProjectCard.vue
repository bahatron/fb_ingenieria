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
                <v-btn class="primary" @click="persist">{{project ? "Actualizar" : "Crear"}}</v-btn>
            </v-layout>
        </v-card-actions>
    </v-card>
</template>

<script lang="ts">
import Vue from "vue";
import FileDropzone from "../../common/FileDropzone.vue";
import $error from "../../../../services/error";
import { ProjectData, ProjectRecord } from "../../../../domain/project";
import capitalize from "../../../mixins/capitalize";

export default Vue.extend({
    components: {
        FileDropzone,
    },

    mixins: [capitalize],

    props: {
        project: {
            type: Object,
        },
    },

    methods: {
        async persist(this: any) {
            const images: File[] = this.$refs.dropzone.getFiles() || [];

            const projectRecord: ProjectRecord = this.project || await this.$store.dispatch("projects/create");

            try {
                projectRecord.update(this.formData);

                await Promise.all(images.map((file: File) => projectRecord.addImage(file)));

                await projectRecord.save();

                this.$emit("close");

                alert("Projecto guardado");
            } catch (err) {
                alert(err.message);
                if (!err.httpCode) {
                    throw err;
                }
            }
        },
    },

    computed: {
        formData(): any {
            return Object.assign({}, this.project ? this.project.data : {});
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
