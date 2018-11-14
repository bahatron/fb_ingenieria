import {
    Module, GetterTree, MutationTree, ActionTree,
} from 'vuex';
import $firebase from '@/modules/filebase';
import { User } from 'firebase';

export interface AuthState {
    user: User | null;
}

const state: AuthState = {
    user: null,
};

const getters: GetterTree<AuthState, any> = {
    user: state => state.user,
};

const mutations: MutationTree<AuthState> = {
    user(store, user: User) {
        store.user = user;
    },
};

const actions: ActionTree<AuthState, any> = {
    async login({ commit }, { email, password }) {
        await $firebase.auth().signInWithEmailAndPassword(email, password);
        commit('user', $firebase.auth().currentUser);
    },
};

const $loginStore: Module<AuthState, any> = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};

export default $loginStore;
