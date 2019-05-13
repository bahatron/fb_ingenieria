<template>
    <section class="padding-top project-portfolio" id="portfolio">
        <p
            class="section-title"
            align="center"
        >{{$store.getters["lang/translate"]("portfolio-title")}}</p>
        <hr class="hr-color">
        <PortfolioFilter @filterChange="updateList($event)"/>
        <PortfolioCarousel/>
    </section>
</template>

<script lang="ts">
import Vue from "vue";

import PortfolioFilter from "./PortfolioFilter.vue";
import PortfolioCarousel from "./PortfolioCarousel.vue";

export default Vue.extend({
    components: {
        PortfolioCarousel,
        PortfolioFilter,
    },

    methods: {
        updateList(filter: Record<string, string>) {
            console.log("filter: ", filter);
        },
    },
});
</script>
