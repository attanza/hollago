<template>
  <div>
    <form @submit="submit">
      <div class="card">
        <div class="card-body">
          <div class="form-row mt-3">
            <div class="col-md-6 mb-3" v-for="(f, index) in fillable" :key="index">
              <label for="validationServer03">{{ $t(`message.${f.key}`) }}</label>
              <input
                type="text"
                :class="{'form-control': true, 'is-invalid': !!errors.first(f.key)}"
                v-validate="f.rules"
                v-model="formData[f.key]"
                :error-messages="errors.collect(f.key)"
                :name="f.key"
                :data-vv-name="f.key"
                :data-vv-as="$t(`message.${f.key}`)"
              >
              <div class="invalid-feedback">{{ errors.first(f.key) }}</div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col">
              <button
                type="button"
                class="btn btn-warning btn-block text-white"
                @click="submit"
              >{{ $t("message.changePassword") }}</button>
            </div>
          </div>
        </div>
      </div>
    </form>
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
          this.saveData();
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
