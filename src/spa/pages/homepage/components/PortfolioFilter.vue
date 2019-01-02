<template>
  <v-layout class="project-filter" row wrap>
    <v-flex xs12 class="project-filter-list">
      <v-chip
        class="white--text"
        :style="isCountryFilterSelected('selectedCountryFilter')"
      >country filter name</v-chip>
    </v-flex>
    <v-flex xs12 class="project-filter-list">
      <v-chip
        class="white--text"
        :style="isAreaFilterSelected('selectedAreaFilter')"
      >area filter name</v-chip>
    </v-flex>
    <v-flex xs12 class="project-filter-list">
      <v-chip
        class="white--text"
        :style="isTypeFilterSelected('selectedTypeFilter')"
      >type filter name</v-chip>
    </v-flex>
  </v-layout>
</template>

<script lang="ts">
import Vue from "vue";
/**
 * @todo: refactor logic
 */
export default Vue.extend({
    data() {
        return {
            selectorColor: "#fb6816",
            availableColor: "#202835",
        };
    },
    computed: {
    // if filter is 'selected' then return 'selected' scheme, else return avaiable
        isCountryFilterSelected() {
            // return (filter: any) => ({
            //     'background-color': this.selectedCountryFilter === filter
            //         ? this.selectorColor
            //         : this.availableColor,
            //     'border-color': this.selectedCountryFilter === filter
            //         ? this.selectorColor
            //         : this.availableColor,
            // });
            return (filter: any) => ({
                "background-color": this.availableColor,
                "border-color": this.availableColor,
            });
        },
        // if filter is 'selected' then return 'selected' scheme, else return avaiable
        isAreaFilterSelected() {
            return (filter: any) => ({
                "background-color": this.selectorColor,
                "border-color": this.selectorColor,
            });
        },
        // if filter is 'selected' then return 'selected' scheme, else return avaiable
        isTypeFilterSelected() {
            return (filter: any) => ({
                "background-color": this.selectorColor,
                "border-color": this.selectorColor,
            });
        },
    },
});
</script>
