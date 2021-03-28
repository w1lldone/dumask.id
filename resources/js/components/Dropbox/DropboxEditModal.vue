<template>
  <div>
    <button
      class="btn btn-warning"
      data-toggle="modal"
      :data-target="'#edit-dropbox-modal-' + dropbox.id"
    >
      Update Dropbox
    </button>
    <div
      class="modal fade"
      :id="'edit-dropbox-modal-' + dropbox.id"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal-id"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header mx-4">
            <h5
              class="modal-title font-weight-bold text-muted"
              id="modal-title"
            >
              Update Dropbox
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body mx-4">

            <div class="form-group" >
              <label for="color">Color</label>
              <select 
                name="color" 
                id="color"
                class="form-control"
                :class="{ 'is-invalid': hasErrors('color') }"
                v-model="form.color"
              >
                <option 
                v-for="(color) in colors"
                :key="color"
                :value="color"
                >
                  {{ color }}
                </option>
              </select>
              <div class="invalid-feedback">
                {{ getErrors("color") }}
              </div>
            </div>

            <div class="form-group" >
              <label for="model">Model</label>
              <select 
                name="model" 
                id="model"
                class="form-control"
                :class="{ 'is-invalid': hasErrors('models') }"
                v-model="form.model"
              >
                <option 
                v-for="(model) in models"
                :key="model"
                :value="model"
                >
                  {{ model }}
                </option>
              </select>
              <div class="invalid-feedback">
                {{ getErrors("model") }}
              </div>
            </div>

            <div class="form-group mt-4 text-right">
              <button
                class="btn btn-success"
                v-show="!isLoading"
                @click="doSubmit()"
              >
                Update Dropbox
              </button>
              <button class="btn btn-success" disabled v-show="isLoading">
                Updating...
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "DropboxEditModal",

  props: {
    dropbox: {
      type: Object
    },
    models: {
      type: Array
    },
    colors: {
      type: Array
    }
  },

  data() {
    return {
      form: {...this.dropbox},
      isLoading: false,
      errors: {},
    };
  },

  methods: {
    async doSubmit() {
      this.isLoading = true;
      var url = "/station/" + this.dropbox.station_id + "/dropbox/" + this.dropbox.id;
      try {
        let response = await axios.put(url, this.form);
        return location.reload();
      } catch (error) {
        alert(error.response.data.message);
        console.log(error.response);
        this.errors = error.response.data.errors;
      }

      this.isLoading = false;
    },
    hasErrors(key) {
      if (this.errors[key]) {
        return true;
      }

      return false;
    },
    getErrors(key) {
      if (this.hasErrors(key)) {
        return this.errors[key].join(", ");
      }

      return "";
    },
  },
};
</script>

<style lang="scss" scoped>
</style>