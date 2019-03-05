<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md6>
        <v-card class="elevation-0">
          <v-toolbar color="cyan darken-1" class="elevation-0" dark>
            <v-toolbar-title>Holla-Go</v-toolbar-title>
            <v-spacer/>
          </v-toolbar>
          <v-card-text>
            <form>
              <v-text-field
                v-validate="'required|email'"
                v-model="email"
                :error-messages="errors.collect('email')"
                name="email"
                prepend-icon="email"
                :label="$t('message.email')"
                data-vv-name="email"
              />

              <v-text-field
                v-validate="'required'"
                v-model="password"
                :append-icon="e1 ? 'visibility_off' : 'visibility'"
                :type="e1 ? 'text' : 'password'"
                :error-messages="errors.collect('password')"
                prepend-icon="lock"
                name="password"
                label="Password"
                hint="At least 6 characters"
                min="6"
                @click:append="e1 = !e1"
              />
            </form>
          </v-card-text>
          <v-card-actions>
            <v-spacer/>
            <v-btn :loading="loading" :disabled="loading" color="primary" @click="submit">Login</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import { LOGIN_URL } from "../utils/apis";
import catchError, { showNoty } from "../utils/catchError";
export default {
  data: () => ({
    email: "superuser@system.com",
    password: "password",
    e1: false,
    loading: false
  }),
  methods: {
    submit() {
      this.$validator.validateAll().then(result => {
        if (result) {
          this.doLogin();
          return;
        }
      });
    },
    doLogin() {
      try {
        this.loading = true;
        let credential = {
          email: this.email,
          password: this.password
        };
        axios
          .post(LOGIN_URL, credential)
          .then(() => window.location.replace("/manage"));
      } catch (e) {
        console.log("e", e);
        this.loading = false;
        catchError(e);
      }
    }
  }
};
</script>
