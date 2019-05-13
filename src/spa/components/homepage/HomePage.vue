<template>
    <v-container fluid>
        <Header/>
        <About/>
        <section class="spacing"></section>
        <WhyUs/>
        <Portfolio/>
        <Journey/>
        <Clients/>
        <ContactUs/>
    </v-container>
</template>

<script lang="ts">
import Vue from "vue";
import Header from "./components/Header.vue";
import About from "./components/About.vue";
import WhyUs from "./components/WhyUs.vue";
import Portfolio from "./components/Portfolio.vue";
import Journey from "./components/Journey.vue";
import Clients from "./components/Clients.vue";
import ContactUs from "./components/ContactUs.vue";

export default Vue.extend({
    components: {
        About,
        WhyUs,
        Portfolio,
        Journey,
        Clients,
        ContactUs,
        Header,
    },
});
</script>
