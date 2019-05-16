<template>
    <v-data-table
        :headers="headers"
        :items="projects"
        :search="search"
        item-key="id"
        :hide-actions="true"
    >
        <template slot="items" slot-scope="props">
            <td>{{ props.item.name }}</td>

            <td>
                <v-icon v-if="props.item.visible" color="green">done</v-icon>
                <v-icon v-else color="red">clear</v-icon>
            </td>

            <td>{{ props.item.country }}</td>

            <td>{{ props.item.type }}</td>

            <td>{{ props.item.area }}</td>

            <td>{{$store.getters["clients/id"](props.item.clientId).name}}</td>

            <td>
                <v-icon small class="mr-2" @click="$emit('edit', props.item.uid)">edit</v-icon>
                <v-icon small @click="$emit('remove', props.item.uid)">delete</v-icon>
            </td>
        </template>
    </v-data-table>
</template>

<script lang="ts">
import Vue from "vue";
import { Project } from "../../../../domain/project";

export default Vue.extend({
    props: {
        search: {
            type: String,
        },
    },

    data(this: any) {
        return {
            headers: [
                {
                    text: "Projecto",
                    value: "name",
                },
                {
                    text: "Visible",
                    value: "visible",
                },
                {
                    text: "Pais",
                    value: "country",
                },
                {
                    text: "Tipo",
                    value: "type",
                },
                {
                    text: "Area",
                    value: "area",
                },
                {
                    text: "Cliente",
                    value: "clientId",
                },
                {
                    text: "Acciones",
                    value: "id",
                    sortable: false,
                },
            ],
        };
    },

    computed: {
        projects(): Project[] {
            return this.$store.getters["projects/data"];
        },
    },

});
</script>
