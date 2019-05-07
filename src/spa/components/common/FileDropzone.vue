<template>
    <vue-dropzone ref="dropzone" id="dropzone_id" :options="dropzoneOptions" :duplicateCheck="true"></vue-dropzone>
</template>

<script lang="ts">
import Vue from "vue";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

const vueDropzone = require("vue2-dropzone");

export default Vue.extend({
    components: {
        vueDropzone,
    },

    data() {
        return {
            dropzoneOptions: {
                url: "/",
                autoProcessQueue: false,
                acceptedFiles: "image/*",
                addRemoveLinks: true,
            },
        };
    },

    methods: {
        getFiles(this: any): File[] {
            const files = this.$refs.dropzone.getAcceptedFiles();

            this.$refs.dropzone.removeAllFiles();

            return files;
        },
    },
});
</script>

<style>
.dz-progress {
    display: none;
}
</style>
