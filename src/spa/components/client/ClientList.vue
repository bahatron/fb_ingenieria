<template>
  <v-data-table :headers="headers" :items="clients" :search="search">
    <template slot="items" slot-scope="props">
      <td>{{ props.item }}</td>

      <td>
        <v-icon v-if="props.item.data.visible" color="green">done</v-icon>
        <v-icon v-else color="red">clear</v-icon>
      </td>

      <td>
        <a target="_blank" :href="props.item.data.website">{{ props.item.website }}</a>
      </td>

      <td>
        <v-icon small class="mr-2" @click="$emit('edit', props.item.id)">edit</v-icon>
        <v-icon small @click="$emit('remove', props.item.id)">delete</v-icon>
      </td>
    </template>
  </v-data-table>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({
    props: {
        clients: {
            type: Array,
            required: true,
        },
        search: {
            type: String,
        },
    },

    data(this: any) {
        return {
            headers: [
                {
                    text: "Cliente",
                    value: "name",
                },
                {
                    text: "Visible",
                    value: "visible",
                },
                {
                    text: "Pagina web",
                    value: "website",
                },
                {
                    text: "Acciones",
                    value: "id",
                    sortable: false,
                },
            ],
        };
    },

});
</script>
