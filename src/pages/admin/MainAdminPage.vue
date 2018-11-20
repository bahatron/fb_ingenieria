<template>
    <default>
        <router-view></router-view>
    </default>
</template>

<script lang="ts">
import Vue from 'vue';

import Default from '@/components/layout/default.vue';

export default Vue.extend({
    components: {
        Default,
    },

    mounted() {
        const self: any = this;
    },
});

</script>
