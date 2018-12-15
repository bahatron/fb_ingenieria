import {
    Module, GetterTree, MutationTree, ActionTree,
} from "vuex";
import { User } from "firebase";
import $firebase from "../../services/firebase";

export interface AuthState {
    user: User | null;
}

function initUser(): User | null {
    const user = localStorage.getItem("auth_user");

    if (!user) {
        return null;
    }

    /**
     * @todo: validate user and verify credentials before returning
     */
    return JSON.parse(user);
}

const state: AuthState = {
    user: initUser(),
};

const getters: GetterTree<AuthState, any> = {
    user: state => state.user,
};

const mutations: MutationTree<AuthState> = {
    user(store, user: User) {
        localStorage.setItem("auth_user", JSON.stringify(user));

        store.user = user;
    },
};

const actions: ActionTree<AuthState, any> = {
    async login({ commit }, { email, password }) {
        await $firebase.auth().signInWithEmailAndPassword(email, password);
        const user = $firebase.auth().currentUser;
        commit("user", user);
    },
};

const $loginModule: Module<AuthState, any> = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};

export default $loginModule;
