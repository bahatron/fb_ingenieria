<template>
    <div>
        <v-carousel class="portfolio-carousel">
            <v-carousel-item>
                <v-layout row wrap="" v-if="list">
                    <v-flex xs12 md3 v-for="project in list" :key="project.id">
                        <div class="p-box">
                            <img v-if="project.images.length === 0" src="" alt="">
                            <img v-else :src="getBackgroundImage(project)" class="portoflio-img">
                            <div class="p-hover">
                                <br>
                                <br>
                                <div class="portfolio-item">
                                    <a @click="showDialog($event, project)">
                                        <i class="material-icons i-hover">menu</i>
                                    </a>
                                    <p>{{project.project_name}}</p>
                                </div>
                            </div>
                        </div>
                    </v-flex>
                </v-layout>
            </v-carousel-item>
        </v-carousel>
        <v-dialog v-model="dialogOpen" width="756">
            <ProjectDetails/>
        </v-dialog>
    </div>
</template>

<script lang="ts">
import ProjectDetails from '@/components/ProjectDetails.vue';
import Vue from 'vue';

export default Vue.extend({
    components: {
        ProjectDetails,
    },
});
</script>
