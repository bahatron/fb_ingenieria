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

        <div>
            <v-layout row wrap>
                <v-flex xs12 md3 v-for="entry in projectImages" :key="entry[0]">
                    <div class="p-box">
                        <img :src="entry[1]" class="portoflio-img">
                        <div class="p-hover">
                            <v-btn @click="deleteImage(entry[0])">Eliminar</v-btn>
                        </div>
                    </div>
                </v-flex>
            </v-layout>
        </div>

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
import { Project, ProjectRecord } from "../../../../domain/project";
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

        async deleteImage(uid: string) {
            if (confirm("Esta seguro que quiere eliminar esta imagen?")) {
                try {
                    await this.project.deleteImage(uid);
                    alert("Imagen eliminada");
                } catch (err) {
                    alert("No se pudo eliminar la imagen, refresque la pagina e intente nuevamente");
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

        projectImages(this: any) {
            return this.project ? Object.entries(this.project.imageMap()) : [];
        },
    },
});
</script>
