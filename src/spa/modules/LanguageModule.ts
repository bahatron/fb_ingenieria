import Vue from "vue";
import { Module } from "vuex";

import $es from "../assets/lang/es.json";
import $en from "../assets/lang/en.json";
import $error from "../../services/error";

interface LanguageState {
    lang: "en" | "es";
    translations: Record<string, string>;
}

const LANGUAGE_KEY = "app-lang";

/** @todo: do this with a webpack dynamic imports */
function getTranslations(lang: LanguageState["lang"]) {
    switch (lang) {
        case "es":
            return $es;
        case "en":
            return $en;
        default:
            throw $error.InternalError(`Invalid language: ${lang}`);
    }
}

function initState(): LanguageState {
    const lang = <LanguageState["lang"]>localStorage.getItem(LANGUAGE_KEY) || "es";

    return {
        lang,
        translations: getTranslations(lang),
    };
}

const $languageModule: Module<LanguageState, any> = {
    namespaced: true,

    state: initState(),

    getters: {
        translate: state => (word: string) => state.translations[word] || word,
    },

    actions: {
        changeLang({ state }, lang: LanguageState["lang"]) {
            localStorage.setItem(LANGUAGE_KEY, lang);
            Vue.set(state, "lang", lang);
            Vue.set(state, "translations", getTranslations(lang));
        },
    },
};

export default $languageModule;
