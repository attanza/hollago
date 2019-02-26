<template>
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
        <div class="row">
          <div class="col"></div>
          <div class="col text-right">
            <button
              type="button"
              class="btn btn-success mr-2"
              data-toggle="tooltip"
              data-placement="top"
              title="Refresh form"
              @click="setFields"
            >
              <i class="material-icons">refresh</i>
            </button>
            <button
              type="button"
              class="btn btn-primary"
              data-toggle="tooltip"
              data-placement="top"
              title="Save"
              @click="submit"
            >
              <i class="material-icons">save</i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
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
        { key: "name", value: "", rules: "required|max:50" },
        { key: "email", value: "", rules: "required|email" },
        { key: "phone", value: "", rules: "required|max:30" },
        { key: "province", value: "", rules: "max:50" },
        { key: "city", value: "", rules: "max:50" },
        { key: "zip_code", value: "", rules: "max:10" },
        { key: "address", value: "", rules: "max:250" }
      ],
      formData: {}
    };
  },
  created() {
    this.setFields();
  },
  methods: {
    setFields() {
      if (this.currentEdit) {
        this.fillable.forEach(
          data => (this.formData[data.key] = this.currentEdit[data.key])
        );
      }
      this.errors.clear();
    },
    submit(e) {
      e.preventDefault();

      this.$validator.validateAll().then(result => {
        if (result) {
          this.editData();
          return;
        }
      });
    },
    async editData() {
      try {
        const resp = await axios.put(
          `${PROFILE_URL}/${this.currentEdit.id}`,
          this.formData
        );
        if (resp.status === 200) {
          this.$store.commit("currentEdit", resp.data);
          showNoty("Data " + this.$t("message.updated"), "success");
        }
      } catch (e) {
        catchError(e);
      }
    }
  }
};
</script>
