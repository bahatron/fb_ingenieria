<template>
    <v-card class="pa-4">
        <v-card-text class="pa-4">
            <p style="font-size:0.89em;text-align:justify;">{{projectData.shortDescription}}</p>
            <p style="font-size:1em;text-align:justify;">{{projectData.longDescription}}</p>
        </v-card-text>
        <v-carousel v-if="projectImages.length > 0">
            <v-carousel-item v-for="url in projectImages" :key="url" :src="url"></v-carousel-item>
        </v-carousel>
    </v-card>
</template>

<script lang="ts">
import Vue from "vue";
import { Project, ProjectRecord } from "../../../../domain/project";

export default Vue.extend({
    props: {
        project: {
            type: Object,
        },
    },

    computed: {
        projectData(this: any) {
            return this.project ? this.project.data : {};
        },

        projectImages(this: any): string[] {
            return this.project ? this.project.imageUrls() : [];
        },
    },
});
</script>
