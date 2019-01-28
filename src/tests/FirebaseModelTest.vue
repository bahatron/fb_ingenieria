<template>
  <div>
    <h1>model data: {{model}}</h1>
    <h1>reference data: {{ref}}</h1>
  </div>
</template>

<script lang="ts">
import "./assets/styles/bootstrap.css";
import "./assets/styles/hestia.css";
import "./assets/styles/styles.css";

import $firebase from "../adapters/firebase";

/** @todo: why is ESlint giving an error here? */
import $firebaseManager, { Model } from "../services/FirebaseManager";

const $db = $firebase.database();

const PATH = "/test";

export default {
    name: "App",
    data() {
        return {
            modelData: null,
            refData: null,
        };
    },

    async mounted(this: any) {
        this.mountModel();

        this.mountReference();
    },

    computed: {
        model(this: any) {
            return this.modelData;
        },

        ref(this: any) {
            return this.refData;
        },
    },

    methods: {
        async mountModel(this: any) {
            const model = await $firebaseManager.persist({
                path: PATH,
                validator: (data: any) => data,
                data: {
                    name: "rick",
                },
                id: "1",
            });

            model.on("value", (data: any) => {
                this.modelData = data;
            });
        },

        async mountReference(this: any) {
            const ref = $db.ref(`${PATH}/2`);

            await ref.set({
                lastname: "sanchez",
            });

            ref.on("value", (snapshot: any) => {
                if (snapshot) {
                    this.refData = snapshot.val();
                }
            });
        },
    },
};
</script>
