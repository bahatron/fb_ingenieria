import { GetterTree, MutationTree, Module } from 'vuex';

export interface LayoutState {
    nav: boolean;
}

const state: LayoutState = {
    nav: false,
};

const getters: GetterTree<LayoutState, any> = {
    nav(state, getters, rootState, rootGetters) {
        return state.nav && !!rootGetters['auth/user'];
    },
};

const mutations: MutationTree<LayoutState> = {
    nav(state, value = false) {
        state.nav = value;
    },
};

const $layoutModule: Module<LayoutState, any> = {
    namespaced: true,

    state,
    getters,
    mutations,
};

export default $layoutModule;
