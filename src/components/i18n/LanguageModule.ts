import { Module, GetterTree, MutationTree, ActionTree } from "vuex";

export interface LanguageState {
    currentLanguage: "en" | "es";
    translations: {
        [key: string]: string;
    };
}

function initLanguage(): "en" | "es" {
    const lang = <"en" | "es" | null>localStorage.getItem("language");

    return lang || "en";
}

function loadTranslations(): any {
    /** @todo */
}

const state: LanguageState = {
    currentLanguage: initLanguage(),

    translations: loadTranslations(),
};

const getters: GetterTree<LanguageState, any> = {
    translate: (state: LanguageState) => (key: string): string => state.translations[key],
};

const $languageModule: Module<LanguageState, any> = {
    namespaced: true,
    state,
    getters,
};

export default $languageModule;
