<template>
  <div>
    <v-card class="pt-3 elevation-0">
      <v-container grid-list-md fluid style="padding-top: 0px;">
        <form>
          <v-layout row wrap class="mt-3 px-2">
            <v-flex v-for="(f, index) in fillable" :key="index" sm6 xs12>
              <label>{{ $t(`message.${f.key}`) }}</label>
              <v-text-field
                v-validate="f.rules"
                v-model="formData[f.key]"
                :error-messages="errors.collect(f.key)"
                :name="f.key"
                :data-vv-name="f.key"
              />
            </v-flex>
          </v-layout>
          <v-layout>
            <v-flex xs12>
              <v-btn @click="submit">{{ $t("message.changePassword") }}</v-btn>
            </v-flex>
          </v-layout>
        </form>
      </v-container>
    </v-card>
    <Dialog
      :showDialog="showDialog"
      :text="$t('message.confirmMessage')"
      @onClose="showDialog = false"
      @onConfirmed="saveData"
    />
  </div>
</template>
<script>
import { global } from "../../mixins";
import { PROFILE_URL } from "../../utils/apis.js";
import catchError, { showNoty } from "../../utils/catchError.js";

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
          this.showDialog = true;
          return;
        }
      });
    },
    async saveData() {
      try {
        if (this.currentEdit) {
          const resp = await axios.put(
            `${PROFILE_URL}/${this.currentEdit.id}/change-password`,
            this.formData
          );
          if (resp.status === 200) {
            this.formData = {};
            showNoty("Password " + this.$t("message.updated"), "success");
            this.showDialog = false;
          }
        }
      } catch (e) {
        console.log("e", e);
        catchError(e);
      }
    }
  }
};
</script>
