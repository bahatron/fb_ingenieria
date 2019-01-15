<template>
  <v-container fluid>
    <v-data-table :headers="headers" :items="clients" hide-actions>
      <template slot="items" slot-scope="props">
        <td>{{ props.item.name }}</td>

        <td>
          <v-icon v-if="props.item.visible" color="green">done</v-icon>
          <v-icon v-else color="red">clear</v-icon>
        </td>

        <td>
          <a :href="props.item.website">{{ props.item.website }}</a>
        </td>

        <td>
          <v-icon small class="mr-2" @click="$emit('edit', props.item.id)">edit</v-icon>
          <v-icon small @click="$emit('dekete', props.item.id)">delete</v-icon>
        </td>
      </template>

      <template slot="no-data">
        <v-btn color="primary" @click="$emit('create')">Reset</v-btn>
      </template>
    </v-data-table>
  </v-container>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({
    props: {
        clients: {
            type: Array,
            required: true,
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
            selected: null,
        };
    },

});
</script>
