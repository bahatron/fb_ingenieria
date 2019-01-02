<template>
  <v-card class="pa-2">
    <v-text-field v-model="name" :label="translate('CLIENT_NAME_LABEL')"></v-text-field>
    <v-text-field v-model="imageUrl" label="Logo o imagen"></v-text-field>
    <v-text-field v-model="website" label="pagina web"></v-text-field>
    <v-text-field v-model="descripcion" label="Descripcion"></v-text-field>
    <v-checkbox v-model="visible" label="Visible"></v-checkbox>
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

    computed: {
        translate(label = "") {
            const self: any = this;
            return self.$store.getters["lang/translate"](label);
        },
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

            await this.$store.dispatch("client/create", payload);
        },
    },
});
</script>
