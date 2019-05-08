import Vue from "vue";
import Vuex from "vuex";
import $loginModule from "./components/auth/LoginModule";
import $layoutModule from "./components/layout/LayoutModule";
import $clientModule from "./components/client/ClientModule";
import $projectModule from "./components/project/ProjectModule";
import $languageModule from "./modules/LanguageModule";

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
