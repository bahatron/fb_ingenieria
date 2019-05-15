<template>
    <!--  class="padding-top about-section header-section" -->
    <section class="padding-top header-section" id="about">
        <p class="section-title">{{$store.getters["lang/translate"]("about-us-title")}}</p>
        <hr class="hr-color">
        <div class="about-box display-big" align="center">
            <div class="row">
                <div class="col-md-6 about-us-box border-down" align="left">
                    <div class="col-md-3" style="padding:0px;">
                        <i
                            class="material-icons custom-icon"
                        >{{$store.getters["lang/translate"]("edit")}}</i>
                    </div>
                    <div class="col-md-9.1" style="padding:0px;">
                        <span
                            class="about-span"
                        >{{$store.getters["lang/translate"]("about-us-subtitle-1")}}</span>
                        <span
                            style="display:block;"
                        >{{$store.getters["lang/translate"]("about-us-text-1")}}</span>
                    </div>
                </div>
                <div class="col-md-6 about-us-box border-down border-center" align="right">
                    <div class="col-md-9" style="padding:0px;">
                        <span
                            class="about-span"
                        >{{$store.getters["lang/translate"]("about-us-subtitle-2")}}</span>
                        <span
                            style="display:block;"
                        >{{$store.getters["lang/translate"]("about-us-text-2")}}</span>
                    </div>
                    <div class="col-md-3" style="padding:0px;">
                        <i
                            class="material-icons custom-icon"
                        >{{$store.getters["lang/translate"]("format_paint")}}</i>
                    </div>
                </div>
            </div>
            <div class="floater"></div>
            <div class="row">
                <div class="col-md-6 about-us-box" align="left">
                    <div class="col-md-3" style="padding:0px;">
                        <i
                            class="material-icons custom-icon"
                        >{{$store.getters["lang/translate"]("build")}}</i>
                    </div>
                    <div class="col-md-9.1" style="padding:0px;">
                        <span
                            class="about-span"
                        >{{$store.getters["lang/translate"]("about-us-subtitle-3")}}</span>
                        <span
                            style="display:block;"
                        >{{$store.getters["lang/translate"]("about-us-text-3")}}</span>
                    </div>
                </div>
                <div class="col-md-6 about-us-box border-center" align="right">
                    <div class="col-md-9" style="padding:0px;">
                        <span
                            class="about-span"
                        >{{$store.getters["lang/translate"]("about-us-subtitle-4")}}</span>
                        <span
                            style="display:block;"
                        >{{$store.getters["lang/translate"]("about-us-text-4")}}</span>
                    </div>
                    <div class="col-md-3" style="padding:0px;">
                        <i
                            class="material-icons custom-icon"
                        >{{$store.getters["lang/translate"]("chat_bubble_outline")}}</i>
                    </div>
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

<style>
.header-section {
    background: url("/img/about-background.jpg") center / cover no-repeat;
}
</style>
