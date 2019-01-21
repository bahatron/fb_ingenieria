<template>
  <v-card class="pa-4">
    <v-text-field v-model="client.name" label="Nombre del cliente" required></v-text-field>
    <!-- <v-text-field v-model="client.image" label="Logo o Imagen URL"></v-text-field> -->
    <v-text-field v-model="client.website" label="Pagina web del cliente"></v-text-field>
    <v-textarea auto-grow rows="2" v-model="client.description" label="Descripcion del cliente"></v-textarea>
    <v-checkbox v-model="client.visible" label="Visible en pagina principal" required></v-checkbox>

    <v-card-actions>
      <v-layout justify-end>
        <v-btn
          class="primary"
          @click="persist()"
          :disabled="!valid"
        >{{client.id ? 'update' : 'create'}}</v-btn>
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
        valid(this: any) {
            return this.client.name && this.client.name.length > 0;
        },
    },

    methods: {
        persist() {
            if (typeof this.client.visible !== "boolean") {
                this.client.visible = false;
            }

            this.$emit("persist", this.client);
        },
    },
});
</script>
