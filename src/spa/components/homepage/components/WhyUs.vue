<template>
    <!-- <section class="padding-top" id="whyus"> -->
    <section id="whyus">
        <p class="section-title" align="center">{{$store.getters["lang/translate"]("why-us-title")}}</p>
        <hr class="hr-color">
        <div class="row">
            <div class="col" align="center">
                <div class="box card card__box">
                    <span class="label">01</span>
                    <h6 class="label2">{{$store.getters["lang/translate"](`why-us-subtitle-1`)}}</h6>
                    <span class="whyus-p">{{$store.getters["lang/translate"]("why-us-text-1")}}</span>
                </div>
                <div class="box card card__box">
                    <span class="label">02</span>
                    <h6 class="label2">{{$store.getters["lang/translate"]("why-us-subtitle-2")}}</h6>
                    <span class="whyus-p">{{$store.getters["lang/translate"]("why-us-text-2")}}</span>
                </div>
                <div class="box card card__box">
                    <span class="label">03</span>
                    <h6 class="label2">{{$store.getters["lang/translate"]("why-us-subtitle-3")}}</h6>
                    <span class="whyus-p">{{$store.getters["lang/translate"]("why-us-text-3")}}</span>
                </div>
                <div class="box card card__box">
                    <span class="label">04</span>
                    <h6 class="label2">{{$store.getters["lang/translate"]("why-us-subtitle-4")}}</h6>
                    <span class="whyus-p">{{$store.getters["lang/translate"]("why-us-text-4")}}</span>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({

});
</script>
