import Vue from "vue";
import Vuex from "vuex";
import $loginModule from "./store/LoginModule";
import $layoutModule from "./store/LayoutModule";
import $clientModule from "./store/ClientModule";
import $projectModule from "./store/ProjectModule";
import $languageModule from "./store/LanguageModule";

Vue.use(Vuex);
export default new Vuex.Store<any>({
    modules: {
        auth: $loginModule,
        layout: $layoutModule,
        clients: $clientModule,
        projects: $projectModule,
        lang: $languageModule,
    },
});
