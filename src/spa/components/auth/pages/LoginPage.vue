<template>
  <v-container fluid>
    <v-layout fill-height row justify-center class="pt-4">
      <v-flex xs4>
        <LoginForm @submit="login($event)"/>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script lang="ts">
import LoginForm from "../LoginForm.vue";

export default {
    components: {
        LoginForm,
    },

    data() {
        return {
            email: null,
            password: null,
            authFailed: false,
        };
    },

    methods: {
        async login(credentials: any) {
            const self: any = this;
            try {
                await self.$store.dispatch("auth/login", credentials);
                self.$router.push({ name: "admin" });
            } catch (err) {
                self.authFailed = true;
                console.log(err.message);
            }
        },
    },
};
</script>
