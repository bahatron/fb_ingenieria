<template>
    <v-card class="pa-2">
        <v-form ref="form" v-model="valid" lazy-validation @submit.prevent="submit">
            <v-text-field v-model="name" label="Name"></v-text-field>
            <v-text-field v-model="imageUrl" label="Logo o imagen"></v-text-field>
            <v-text-field v-model="website" label="pagina web"></v-text-field>
            <v-text-field v-model="descripcion" label="Descripcion"></v-text-field>
            <v-checkbox v-model="visible" label="Visible" required></v-checkbox>
            <v-btn type="submit">submit</v-btn>
            <v-btn>clear</v-btn>
        </v-form>
    </v-card>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({
    data() {
        return {
            valid: true,
            name: null,
            imageUrl: null,
            website: null,
            descripcion: null,
            visible: null,
        };
    },

    methods: {
        async submit() {
            const payload = {
                name: this.name,
                imageUrl: this.imageUrl,
                website: this.website,
                descripcion: this.descripcion,
                visible: this.visible,
            };

            console.log("creating client..", payload);
            await this.$store.dispatch("client/create", payload);
            console.log("client created");
        },
    },
});
</script>
