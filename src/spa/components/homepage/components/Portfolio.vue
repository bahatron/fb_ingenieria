<template>
    <div>
        <section class="project-portfolio" id="portfolio">
            <p
                class="section-title"
                align="center"
            >{{$store.getters["lang/translate"]("portfolio-title")}}</p>
            <hr class="hr-color">

            <v-layout class="project-filter" row wrap>
                <v-flex xs12 class="project-filter-list">
                    <v-chip
                        class="white--text"
                        :style="isFilterSelected('country', country)"
                        v-for="country in projectCountries"
                        :key="country"
                        @click="changeFilter('country', country)"
                    >{{$store.getters["lang/translate"](country)}}</v-chip>
                </v-flex>
                <v-flex xs12 class="project-filter-list">
                    <v-chip
                        class="white--text"
                        :style="isFilterSelected('area', area)"
                        v-for="area in projectAreas"
                        :key="area"
                        @click="changeFilter('area', area)"
                    >{{$store.getters["lang/translate"](area)}}</v-chip>
                </v-flex>
                <v-flex xs12 class="project-filter-list">
                    <v-chip
                        class="white--text"
                        :style="isFilterSelected('type', type)"
                        v-for="type in projectTypes"
                        :key="type"
                        @click="changeFilter('type', type)"
                    >{{$store.getters["lang/translate"](type)}}</v-chip>
                </v-flex>
            </v-layout>
        </section>

        <section class="pt-4">
            <v-layout align-start justify-space-around row fill-height>
                <v-flex xs12 md3 v-for="project in filteredProjects" :key="project.uid">
                    <div class="p-box" @click="openDialog(project)">
                        <img :src="projectFrontImage(project)" class="portoflio-img">
                        <div class="p-hover">
                            <br>
                            <br>
                            <div class="portfolio-item">
                                <a>
                                    <i class="material-icons i-hover">menu</i>
                                </a>
                                <h4>{{project.data.name}}</h4>
                            </div>
                        </div>
                    </div>
                </v-flex>
            </v-layout>

            <v-dialog fullscreen v-model="dialogOpen">
                <v-toolbar dark color="primary">
                    <v-btn icon dark @click="dialogOpen = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title>{{selectedProject ? selectedProject.data.name : ""}}</v-toolbar-title>
                </v-toolbar>
                <ProjectDetials :project="selectedProject"/>
            </v-dialog>
        </section>
    </div>
</template>

<script lang="ts">
import Vue from "vue";

import { ProjectRecord, Project } from "../../../../domain/project";
import capitalize from "../../../mixins/capitalize";
import ProjectDetials from "../../project/components/ProjectDetails.vue";

export default Vue.extend({
    // maybe this should be in the store
    data() {
        return {
            dialogOpen: false,
            selectedColor: "#fb6816",
            availableColor: "#202835",
            filter: {
                country: null,
                area: null,
                type: null,
            },
            selectedProject: null,
        };
    },

    components: {
        ProjectDetials,
    },

    mixins: [capitalize],

    computed: {
        filteredProjects(this: any): ProjectRecord[] {
            return this.$store.getters["projects/records"].filter((project: any) => {
                let result = project.data.visible;

                Object.keys(this.filter).forEach((key) => {
                    if (this.filter[key] && project.data[key] !== this.filter[key]) {
                        result = false;
                    }
                });

                return result;
            });
        },

        projectCountries(this: any) {
            return this.$store.getters["projects/countries"];
        },

        projectAreas(this: any) {
            return this.$store.getters["projects/areas"];
        },

        projectTypes(this: any) {
            return this.$store.getters["projects/types"];
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

    methods: {
        openDialog(this: any, project: ProjectRecord): void {
            this.selectedProject = project;
            this.dialogOpen = true;
        },

        projectFrontImage(project: ProjectRecord): string {
            return project.imageUrls().shift() || "/img/journey.png";
        },

        changeFilter(this: any, filter: string, value: string) {
            if (this.filter[filter] === value) {
                this.filter[filter] = null;
            } else {
                this.filter[filter] = value;
            }

            this.$emit("filterChange", this.filter);
        },
    },
});
</script>
