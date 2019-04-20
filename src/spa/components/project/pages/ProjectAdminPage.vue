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

                    <ProjectList
                        :projects="projects"
                        @edit="showCard($event)"
                        @remove="remove($event)"
                    />
                </v-card>
            </v-flex>
        </v-layout>

        <v-dialog v-model="dialog" max-width="75%">
            <ProjectCard ref="card" :project="selectedProject" @persist="persist($event)"/>
        </v-dialog>
    </v-container>
</template>

<script lang="ts">
import Vue from "vue";
import ProjectCard from "../components/ProjectCard.vue";
import ProjectList from "../components/ProjectList.vue";
import { ProjectData } from "../../../../domain/project/ProjectFacade";

export default Vue.extend({
    data() {
        return {
            dialog: false,
            search: null,
            selectedProject: {}
        };
    },

    created() {
        this.$store.dispatch("clients/load");
        this.$store.dispatch("projects/load");
    },

    computed: {
        projects(): ProjectData[] {
            return this.$store.getters["projects/all"];
        }
    },

    methods: {
        showCard(projectId?: string) {
            this.selectedProject =
                this.$store.getters["projects/id"](projectId) || {};
            this.dialog = true;
        },

        async persist(project: any) {
            try {
                await this.$store.dispatch("projects/persist", project);
            } catch (err) {
                switch (err.httpCode) {
                    case 400:
                        alert(err.message);
                        break;
                    default:
                        alert("Error de coneccion, intente de nuevo");
                        throw err;
                }
            } finally {
                this.dialog = false;
            }
        },

        remove(projectID: string) {
            if (confirm("Esta seguro de que quiere eliminar este project?")) {
                this.$store
                    .dispatch("projects/delete", { id: projectID })
                    .then(() => {
                        alert("Projecto eliminado");
                    })
                    .catch(err => {
                        /** @todo report on sentry */
                        console.log(err.message);
                        alert(
                            "Hubo un error eliminando el projecto, intente nuevamente"
                        );
                    });
            }
        }
    },

    components: {
        ProjectList,
        ProjectCard
    }
});
</script>
