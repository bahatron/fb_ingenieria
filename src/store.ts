import Vue from "vue";
import Vuex from "vuex";
import $loginModule from "./pages/login/LoginModule";
import $layoutModule from "./components/layout/LayoutModule";
import $clientModule from "./modules/ClientModule";

Vue.use(Vuex);
export default new Vuex.Store<any>({
    modules: {
        auth: $loginModule,
        layout: $layoutModule,
        client: $clientModule,
    },
});
