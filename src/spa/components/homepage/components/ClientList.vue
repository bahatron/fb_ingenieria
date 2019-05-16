<template>
    <section class="padding-top" id="clients">
        <p
            class="section-title"
            align="center"
        >{{$store.getters["lang/translate"]("clients-title")}}</p>
        <hr class="hr-color">
        <span class="clients-p">{{$store.getters["lang/translate"]("clients-text")}}</span>
        <div class="client-carousel">
            <!-- <v-carousel class="client-carousel">
                <v-carousel-item>
                    <a href="client.websiteUrl">
                        <img src="client.imageUrl" style="height:100px;width:auto;">
                    </a>
                </v-carousel-item>
            </v-carousel>-->
        </div>
    </section>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({

});
</script>
