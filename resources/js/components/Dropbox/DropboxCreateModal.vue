<template>
  <div>
    <button
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#create-dropbox-modal-id"
    >
      Create new Dropbox
    </button>
    <div
      class="modal fade"
      id="create-dropbox-modal-id"
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
              Create New Dropbox for {{ station.name }}
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

            <div class="form-group">
              <label for="color">Color</label>
              <select 
                name="color" 
                id="color"
                class="form-control"
                :class="{ 'is-invalid': hasErrors('color') }"
                v-model="form.color"
              >
                  <option value="green">Hijau</option>
                  <option value="yellow">Kuning</option>
              </select>
              <div class="invalid-feedback">
                {{ getErrors("color") }}
              </div>
            </div>

            <div class="form-group">
              <label for="model">Model</label>
              <select 
                name="model" 
                id="model"
                class="form-control"
                :class="{ 'is-invalid': hasErrors('model') }"
                v-model="form.model"
              >
                  <option value="front_loading">Front Loading</option>
                  <option value="top_loading">Top Loading</option>
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
                Create Dropbox
              </button>
              <button class="btn btn-success" disabled v-show="isLoading">
                Creating...
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
  name: "DropboxCreateModal",

  props: {
    station: {
      type: Object
    }
  },

  data() {
    return {
      form: {
        station_id: this.station.id,
        color: null,
        model: null,
      },
      isLoading: false,
      errors: {},
    };
  },

  methods: {
    async doSubmit() {
      this.isLoading = true;
      var url = "/station/" + this.station.id + "/dropbox/";
      try {
        let response = await axios.post(url, this.form);
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