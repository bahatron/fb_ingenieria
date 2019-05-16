<template>
    <v-container fluid fill-height style="background-color: grey">
        <v-layout class="pa-2" row wrap>
            <v-flex xs12>
                <v-card>
                    <v-card-title>
                        <v-btn color="primary" @click="showCard()">Agregar</v-btn>

                        <v-spacer></v-spacer>

                        <!-- create search component -->
                        <v-text-field
                            v-model="search"
                            append-icon="search"
                            label="Search"
                            single-line
                            hide-details
                        ></v-text-field>
                    </v-card-title>

                    <ProjectList @edit="showCard($event)" @remove="remove($event)"/>
                </v-card>
            </v-flex>
        </v-layout>

        <v-dialog v-model="dialog" max-width="75%">
            <ProjectCard ref="card" :project="selectedProject" @close="dialog = false"/>
        </v-dialog>
    </v-container>
</template>

<script lang="ts">
import Vue from "vue";
import ProjectCard from "../components/ProjectCard.vue";
import ProjectList from "../components/ProjectList.vue";
import { Project, ProjectRecord } from "../../../../domain/project";

export default Vue.extend({
    data() {
        return {
            dialog: false,
            search: null,
            selectedProject: null,
        };
    },

    created() {
        this.$store.dispatch("clients/load");
        this.$store.dispatch("projects/load");
    },

    methods: {
        async showCard(projectId?: string) {
            // this.selectedProject = projectId
            //     ? this.$store.getters["projects/id"](projectId).data
            //     : null;

            this.selectedProject = this.$store.getters["projects/id"](projectId) || null;

            this.dialog = true;
        },

        async remove(projectID: string) {
            if (confirm("Esta seguro de que quiere eliminar este projecto?")) {
                const project: ProjectRecord = this.$store.getters["projects/id"](projectID);

                await project.delete();
            }
        },
    },

    components: {
        ProjectList,
        ProjectCard,
    },
});
</script>
