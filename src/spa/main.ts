import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

// plugins
import "./plugins/vuetify";

// PWA
import "./registerServiceWorker";

// Styles
import "roboto-fontface/css/roboto/roboto-fontface.css";
import "font-awesome/css/font-awesome.css";

// require('./assets/styles/hestia.scss');

Vue.config.productionTip = false;

new Vue({
    router,
    store,
    render: h => h(App),
}).$mount("#app");
