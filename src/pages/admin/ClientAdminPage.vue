<template>
    <v-container fluid fill-height>
        <v-layout row wrap="" justify-center>
            <v-flex xs6>
                <ClientCard/>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script lang="ts">
import Vue from 'vue';
import ClientCard from '@/domain/client/components/ClientCard.vue';

export default Vue.extend({
    components: {
        ClientCard,
    },
});
</script>
