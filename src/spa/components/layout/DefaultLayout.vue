<template>
  <v-app>
    <MenuBar/>
    <ToolBar/>
    <v-content>
      <v-container fluid fill-height class="pa-0" justify-center>
        <slot>Default layout content</slot>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import Vue from "vue";
import MenuBar from "./MenuBar.vue";
import ToolBar from "./ToolBar.vue";

export default Vue.extend({
    name: "default",

    components: {
        ToolBar,
        MenuBar,
    },
});
</script>
