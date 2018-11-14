<template>
    <v-card style="padding:12px;" v-if="selectedProject">
        <v-card-row>
            <a :href="selectedProject.websiteUrl">
                <img :src="selectedProject.imageUrl" style="width:100px;">
            </a>
            <v-card-title>{{selectedProject.project_name}}</v-card-title>
        </v-card-row>
        <v-card-row>
            <p style="font-size:0.89em;text-align:justify;">{{selectedProject.shortDescription}}</p>
        </v-card-row>
        <v-card-row>
            <p style="font-size:1em;text-align:justify;">{{selectedProject.longDescription}}</p>
        </v-card-row>
        <v-card-row>
            <v-carousel cycle="false" class="modal-carousel">
                <v-carousel-item>
                    <img :src="image.url" style="height:40vh;width:auto;">
                </v-carousel-item>
            </v-carousel>
        </v-card-row>
    </v-card>
</template>
