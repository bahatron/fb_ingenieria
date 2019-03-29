<template>
    <default>
        <router-view></router-view>
    </default>
</template>

<script lang="ts">
import Vue from "vue";

import Default from "../../layout/DefaultLayout.vue";

export default Vue.extend({
    components: {
        Default,
    },
});

</script>
