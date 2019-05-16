<template>
    <section class="padding-top-journey" id="journey" style="position: relative;">
        <div class="card_journey journey-backgound">
            <p class="p-journey">{{$store.getters["lang/translate"]("journey-title")}}</p>
            <hr class="hr-color hr-journey" width="20%">
            <div class="div-journey">
                <p class="text-journey">
                    {{$store.getters["lang/translate"]("journey-text-1")}}
                    <br>
                    {{$store.getters["lang/translate"]("journey-text-2")}}
                </p>
            </div>
        </div>
    </section>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({

});
</script>

<style>
.journey-backgound {
    background: url("/img/journey.png") center center / cover no-repeat;
}
</style>
