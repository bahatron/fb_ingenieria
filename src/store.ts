import Vue from 'vue';
import Vuex from 'vuex';
import $loginStore from './pages/login/module';
import $layoutModule from './components/layout/module';

Vue.use(Vuex);
export default new Vuex.Store<any>({
    modules: {
        auth: $loginStore,
        layout: $layoutModule,
    },
});
