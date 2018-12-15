import { Module, GetterTree, MutationTree, ActionTree } from "vuex";

export interface LanguageState {
    currentLanguage: "en" | "es";
    translations: {
        [key: string]: string;
    };
}

const translationIndex = ["../client/translations"];

function initLanguage(): "en" | "es" {
    const lang = <"en" | "es" | null>localStorage.getItem("language");

    return lang || "en";
}

function loadTranslations(): any {
    const translations: any = {};

    /**
     * @todo: find a good way to import json files
     */
    translationIndex.forEach((path: string) => {
        ["en", "es.js"].forEach((file: string) => {
            let partial = require(`${path}/${file}`);

            if (!partial) {
                return;
            }

            Object.keys(partial).forEach((key: string) => {
                translations[key] = partial[key];
            });
        });
    });

    return translations;
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
