<template>
  <v-card class="pa-4">
    <v-text-field v-model="client.name" label="Nombre del cliente"></v-text-field>
    <!-- <v-text-field v-model="client.image" label="Logo o Imagen URL"></v-text-field> -->
    <v-text-field v-model="client.website" label="Pagina web del cliente"></v-text-field>
    <v-textarea auto-grow rows="2" v-model="client.descripcion" label="Descripcion del cliente"></v-textarea>
    <v-checkbox v-model="client.visible" label="Visible en pagina principal"></v-checkbox>

    <v-card-actions>
      <v-layout justify-end>
        <v-btn class="primary" @click="alert('clicked')">{{client.id ? 'update' : 'create'}}</v-btn>
      </v-layout>
    </v-card-actions>
  </v-card>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({

    props: {
        client: {
            type: Object,
            default() {
                return {
                    id: null,
                    name: null,
                    image: null,
                    website: null,
                    description: null,
                    visible: false,
                };
            },
        },
    },

    computed: {
        translate(this: Vue, label = "") {
            return this.$store.getters["lang/translate"](label) || label;
        },
    },

    methods: {
        async submit() {
            await this.$store.dispatch("clients/persist", this.client);
        },

        alert(msg: any): void {
            alert(msg);
        },
    },
});
</script>
