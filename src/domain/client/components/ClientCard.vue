<template>
    <v-card class="pa-2">
        <v-form ref="form" v-model="valid" lazy-validation>
            <v-text-field label="Name"></v-text-field>
            <v-text-field label="Logo o imagen"></v-text-field>
            <v-text-field label="pagina web"></v-text-field>
            <v-text-field label="Descripcion"></v-text-field>
            <v-checkbox label="Visible" required></v-checkbox>
            <v-btn>submit</v-btn>
            <v-btn>clear</v-btn>
        </v-form>
    </v-card>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
    data() {
        return {
            valid: true,
        };
    },
});
</script>
