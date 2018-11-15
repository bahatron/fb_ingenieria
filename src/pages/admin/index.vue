<template>
    <default>
        <router-view></router-view>
    </default>
</template>

<script>
import Vue from 'vue';

import Default from '@/components/layout/default.vue';

export default Vue.extend({
    components: {
        Default,
    },
});

</script>
