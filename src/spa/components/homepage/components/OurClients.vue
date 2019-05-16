<template>
    <section class="padding-top" id="clients">
        <p
            class="section-title"
            align="center"
        >{{$store.getters["lang/translate"]("clients-title")}}</p>
        <hr class="hr-color">
        <span class="clients-p">{{$store.getters["lang/translate"]("clients-text")}}</span>
        <v-layout row align-start justify-space-around="">
            <div v-for="client in clients" :key="client.id">
                <v-card v-if="client.image">
                    <a :href="client.website">
                        <img :src="client.image" style="height:100px;width:auto;">
                    </a>
                </v-card>
            </div>
        </v-layout>
    </section>
</template>

<script lang="ts">
import Vue from "vue";
import { ClientData } from "../../../../domain/client";

export default Vue.extend({
    computed: {
        clients(this: any) {
            return this.$store.getters["clients/all"].filter((client: ClientData) => client.visible);
        },
    },
});
</script>
