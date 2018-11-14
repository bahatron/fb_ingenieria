<template>
    <div>
        <v-carousel class="portfolio-carousel">
            <v-carousel-item>
                <v-layout row wrap="">
                    <v-flex xs12 md3>
                        <div class="p-box" @click="dialogOpen = !dialogOpen">
                            <img src="/img/journey.png" class="portoflio-img">
                            <div class="p-hover">
                                <br>
                                <br>
                                <div class="portfolio-item">
                                    <a>
                                        <i class="material-icons i-hover">menu</i>
                                    </a>
                                    <p>project name</p>
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
    data() {
        return {
            dialogOpen: false,
        };
    },

    components: {
        ProjectDetails,
    },
});
</script>
