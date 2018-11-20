import Vue from 'vue';
import Vuex from 'vuex';
import $loginModule from './pages/login/LoginModule';
import $layoutModule from './components/layout/module';

Vue.use(Vuex);
export default new Vuex.Store<any>({
    modules: {
        auth: $loginModule,
        layout: $layoutModule,
    },
});
