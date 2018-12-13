<template>
  <v-form ref="loginForm" @submit.prevent>
    <v-card class="elevation-12">
      <v-toolbar dark color="primary">
        <v-toolbar-title>Login</v-toolbar-title>
      </v-toolbar>
      <v-card-text>
        <v-text-field
          v-model="email"
          :rules="emailRules"
          prepend-icon="person"
          name="Email"
          label="Email"
          type="text"
          required
        ></v-text-field>
        <v-text-field
          v-model="password"
          :rules="passwordRules"
          prepend-icon="lock"
          name="password"
          label="Password"
          type="password"
          required
        ></v-text-field>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="primary" @click="submit" type="submit">Login</v-btn>
      </v-card-actions>
    </v-card>
  </v-form>
</template>

<script lang="ts">
export default {
    data() {
        return {
            email: null,
            password: null,
            valid: true,
            emailRules: [
                (v: any) => !!v || "Email is required",
                (v: any) => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v)
          || "Must be a valid email address",
            ],
            passwordRules: [
                (v: any) => !!v || "Password is required",
            ],
        };
    },

    methods: {
        submit(this: any) {
            this.$emit("submit", { email: this.email, password: this.password });
        },

        clear(this: any) {
            this.email = null;
            this.password = null;
        },
    },
};
</script>
