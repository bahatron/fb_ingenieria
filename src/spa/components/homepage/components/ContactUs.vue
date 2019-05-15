<template>
    <section class="padding-top contact-section" id="contact">
        <p class="section-title" align="center">contact-title</p>
        <div class="row" style="position: relative;  overflow: hidden;">
            <div class="col-md-3"></div>
            <div class="col-md-6 contact-form" style="height:auto; padding:90px;">
                <form name="contact-form" action="">
                    <div class="col-md-6" align="center">
                        <div class="row">
                            <input
                                type="text"
                                name="name"
                                value=""
                                placeholder="contact-name"
                                required
                            >
                        </div>
                        <div class="row">
                            <input
                                type="text"
                                name="lastname"
                                value=""
                                placeholder="contact-lastname"
                                required
                            >
                        </div>
                        <div class="row">
                            <input
                                type="email"
                                name="mail"
                                value=""
                                placeholder="contact-mail"
                                required
                            >
                        </div>
                    </div>
                    <div class="col-md-6" align="center">
                        <textarea
                            rows="4"
                            cols="2"
                            name="comment"
                            placeholder="<?php echo $FBIngenieria->translate('contact-comment', $lang); ?>"
                            required
                        ></textarea>
                        <input
                            type="submit"
                            name="submit"
                            class="btn"
                            style="background-color:#fb6816; box-shadow:none;"
                        >
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
            <i class="material-icons contact-icon" style="position:absolute;">mail_outline</i>
        </div>
    </section>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({

});
</script>
