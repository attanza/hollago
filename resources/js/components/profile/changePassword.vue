<template>
  <form>
    <v-card>
      <v-container>
        <v-card-text>
          <v-layout row wrap class="mt-3 px-2">
            <v-flex v-for="(f, index) in fillable" :key="index" xs12>
              <label>{{ $t(`message.${f.key}`) }}</label>
              <v-text-field
                v-validate="f.rules"
                v-model="formData[f.key]"
                :error-messages="errors.collect(f.key)"
                :name="f.key"
                :data-vv-name="f.key"
                :data-vv-as="f.caption"
              />
            </v-flex>
          </v-layout>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" dark @click="submit">Change Password</v-btn>
        </v-card-actions>
      </v-container>
    </v-card>
  </form>
</template>
<script>
import { global } from "../../mixins";
export default {
  mixins: [global],
  data() {
    return {
      fillable: [
        {
          key: "password",
          caption: "Password",
          value: "",
          rules: "required|min:6"
        },
        {
          key: "password_confirmation",
          caption: "Password Confirmation",
          value: "",
          rules: "required|confirmed:password"
        }
      ],
      formData: {}
    };
  },

  methods: {
    submit() {
      this.$validator.validateAll().then(result => {
        if (result) {
          this.saveData();
          return;
        }
      });
    },
    saveData() {
      alert("saved");
    }
  }
};
</script>
