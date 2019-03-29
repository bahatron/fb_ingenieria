<template>
    <vue-dropzone
        ref="dropzone"
        id="dropzone_id"
        :options="dropzoneOptions"
        :duplicateCheck="true"
        :destroyDropzone="true"
    ></vue-dropzone>
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
                url: (file: File) => {
                    console.log("file", file);
                    return "";
                },
                autoProcessQueue: false,
                acceptedFiles: "image/*",
                addRemoveLinks: true,
            },
        };
    },
});
</script>
