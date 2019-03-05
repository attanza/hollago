<template>
  <div>
    <v-card class="pt-3 elevation-0">
      <v-container grid-list-md fluid style="padding-top: 0px;">
        <v-toolbar color="transparent" card>
          <v-spacer/>

          <Tbtn
            color="cyan darken-1"
            dark
            icon="save"
            icon-mode
            tooltip-text="Save"
            @onClick="submit"
          />
          <Tbtn
            color="cyan darken-1"
            dark
            icon="refresh"
            icon-mode
            tooltip-text="Refresh"
            @onClick="setFields"
          />
        </v-toolbar>
        <form>
          <v-layout row wrap class="mt-3 px-2">
            <v-flex v-for="(f, index) in fillable" :key="index" sm6 xs12>
              <span v-if="!inArray(notIncluded, f.key)">
                <label>{{ $t(`message.${f.key}`) }}</label>
                <v-text-field
                  v-validate="f.rules"
                  v-model="formData[f.key]"
                  :error-messages="errors.collect(f.key)"
                  :name="f.key"
                  :data-vv-name="f.key"
                />
              </span>
              <span v-if="f.key === 'address'">
                <label>{{ $t(`message.${f.key}`) }}</label>
                <v-textarea
                  v-validate="f.rules"
                  v-model="formData[f.key]"
                  :error-messages="errors.collect(f.key)"
                  :name="f.key"
                  :data-vv-name="f.key"
                />
              </span>
            </v-flex>
          </v-layout>
        </form>
      </v-container>
    </v-card>
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
        { key: "name", value: "", rules: "required|max:50" },
        { key: "email", value: "", rules: "required|email" },
        { key: "phone", value: "", rules: "required|max:30" },
        { key: "province", value: "", rules: "max:50" },
        { key: "city", value: "", rules: "max:50" },
        { key: "zip_code", value: "", rules: "max:10" },
        { key: "address", value: "", rules: "max:250" }
      ],
      formData: {},
      notIncluded: ["address"]
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
    submit() {
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
