<template>
    <v-container fluid>
        <About/>
        <section class="spacing"></section>
        <WhyUs/>
        <Portfolio/>
    </v-container>
</template>

<script lang="ts">
import Vue from 'vue';

import About from '@/components/About.vue';
import WhyUs from '@/components/WhyUs.vue';
import Portfolio from '@/components/Portfolio.vue';

export default Vue.extend({
    computed: {
        headerSection() {
            return {
                // 'background-image': '~/img/about-background.jpg',
                'background-color: green': true,
            };
        },
    },

    components: {
        About,
        WhyUs,
        Portfolio,
    },
});
</script>

<style>
.header-section {
    background: url('/img/about-background.jpg') center / cover no-repeat;
}
</style>
