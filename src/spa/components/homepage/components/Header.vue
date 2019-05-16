<template>
    <v-toolbar fixed style="background-color: rgb(32, 40, 53); z-index:3">
        <v-layout justify-start>
            <img
                class="ml-2 mr-2"
                style="max-height: 30px; cursor: pointer;"
                src="/img/1495683664_United-States-Flag.png"
                @click="changeLanguage('en')"
            >
            <img
                class="ml-2 mr-2"
                style="max-height: 30px; cursor: pointer;"
                src="/img/1495683661_Spain-Flag.png"
                @click="changeLanguage('es')"
            >
        </v-layout>
    </v-toolbar>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({
    methods: {
        changeLanguage(lang: string) {
            this.$store.dispatch("lang/changeLang", lang);
        },
    },
});
</script>
