<template>
    <div>
        <section class="project-portfolio" id="portfolio">
            <p
                class="section-title"
                align="center"
            >{{$store.getters["lang/translate"]("portfolio-title")}}</p>
            <hr class="hr-color">
            <PortfolioFilter @filterChange="filter = $event"/>
            <!-- <PortfolioCarousel :projects="filteredProjects"/> -->
        </section>
        <section class="padding-top">
            <v-layout align-start justify-space-around row fill-height>
                <v-flex xs12 md3 v-for="project in filteredProjects" :key="project.uid">
                    <div class="p-box" @click="dialogOpen = !dialogOpen">
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
        </section>
    </div>
</template>

<script lang="ts">
import Vue from "vue";

import PortfolioFilter from "./PortfolioFilter.vue";
import { ProjectRecord, ProjectData } from "../../../../domain/project";

export default Vue.extend({
    // maybe this should be in the store
    data() {
        return {
            filter: {},
            dialogOpen: false,
        };
    },
    components: {
        PortfolioFilter,
    },
    computed: {
        filteredProjects(this: any): ProjectRecord[] {
            console.log("i changed");
            return this.$store.getters["projects/records"].filter((project: any) => {
                let result = project.data.visible;

                Object.keys(this.filter).forEach((key) => {
                    console.log("key", key);
                    console.log("filter key", this.filter[key]);
                    console.log("project data key", project.data[key]);
                    if (this.filter[key] && project.data[key] === this.filter[key]) {
                        console.log("should be false");
                        result = false;
                    }
                });

                return result;
            });
        },
    },
    methods: {
        projectFrontImage(project: ProjectRecord): string {
            return project.imageUrls().shift() || "/img/journey.png";
        },
    },
});
</script>
