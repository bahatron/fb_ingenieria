<template>
    <section class="padding-top project-portfolio" id="portfolio">
        <p class="section-title" align="center">portfolio-title</p>
        <hr class="hr-color">
        <PortfolioFilter/>
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
});
</script>