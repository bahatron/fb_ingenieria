<template>
    <v-container fluid>
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
import Vue from 'vue';

import About from '@/pages/homepage/components/About.vue';
import WhyUs from '@/pages/homepage/components/WhyUs.vue';
import Portfolio from '@/pages/homepage/components/Portfolio.vue';
import Journey from '@/pages/homepage/components/Journey.vue';
import Clients from '@/pages/homepage/components/Clients.vue';
import ContactUs from '@/pages/homepage/components/ContactUs.vue';

export default Vue.extend({
    components: {
        About,
        WhyUs,
        Portfolio,
        Journey,
        Clients,
        ContactUs,
    },
});
</script>
