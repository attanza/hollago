<template>
  <form @submit="submit">
    <div class="card">
      <div class="card-body">
        <div class="form-row mt-3">
          <div class="col-md-6 mb-3" v-for="(f, index) in fillable" :key="index">
            <span v-if="!inArray(notIncluded, f.key)">
              <label :for="f.key">{{ $t(`message.${f.key}`) }}</label>
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
            </span>
            <span v-if="f.key === 'role_id'">
              <label for="role">Role</label>
              <select
                :class="{'form-control': true, 'is-invalid': !!errors.first(f.key)}"
                v-validate="f.rules"
                v-model="formData[f.key]"
                :error-messages="errors.collect(f.key)"
                :name="f.key"
                :data-vv-name="f.key"
                data-vv-as="Role"
              >
                <option value selected disabled>Select role ...</option>
                <option v-for="role in roles" :value="role.id" :key="role.id">{{ role.name }}</option>
              </select>
              <div class="invalid-feedback">{{ errors.first(f.key) }}</div>
            </span>
            <span v-if="f.key === 'address'">
              <label for="validationServer03">{{ $t(`message.${f.key}`) }}</label>
              <textarea
                :class="{'form-control': true, 'is-invalid': !!errors.first(f.key)}"
                v-validate="f.rules"
                v-model="formData[f.key]"
                :error-messages="errors.collect(f.key)"
                :name="f.key"
                :data-vv-name="f.key"
                :data-vv-as="$t(`message.${f.key}`)"
              />
              <div class="invalid-feedback">{{ errors.first(f.key) }}</div>
            </span>
          </div>
        </div>
        <div class="row" v-if="canUpdate">
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
import { USERS_URL, COMBODATA_URL } from "../../utils/apis.js";
import catchError, { showNoty } from "../../utils/catchError.js";
export default {
  mixins: [global],
  props: ["canUpdate"],
  data() {
    return {
      fillable: [
        { key: "name", value: "", rules: "required|max:50" },
        { key: "email", value: "", rules: "required|email" },
        { key: "phone", value: "", rules: "required|max:30" },
        { key: "province", value: "", rules: "max:50" },
        { key: "city", value: "", rules: "max:50" },
        { key: "zip_code", value: "", rules: "max:10" },
        { key: "role_id", value: "", rules: "required|integer" },
        { key: "address", value: "", rules: "max:250" }
      ],
      notIncluded: ["role_id", "address"],
      formData: {},
      roles: []
    };
  },
  created() {
    this.getRoles();
    this.setFields();
  },
  methods: {
    async getRoles() {
      try {
        const resp = await axios
          .get(COMBODATA_URL + "?resource=Role")
          .then(res => res.data);
        this.roles = resp;
      } catch (e) {
        catchError(e);
      }
    },
    setFields() {
      if (this.currentEdit) {
        this.fillable.forEach(
          data => (this.formData[data.key] = this.currentEdit[data.key])
        );
      }
      this.formData.role_id = this.currentEdit.roles[0].id;
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
          `${USERS_URL}/${this.currentEdit.id}`,
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
