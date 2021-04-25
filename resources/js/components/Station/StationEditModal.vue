<template>
  <div>
    <button
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#edit-station-modal-id"
    >
      EDIT STATION
    </button>
    <div
      class="modal fade"
      id="edit-station-modal-id"
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
              EDIT STATION
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
          <div class="modal-body text-left mx-4">

            <div class="form-group">
              <label for="name">Nama</label>
              <input
                type="text"
                class="form-control"
                :class="{ 'is-invalid': hasErrors('name') }"
                v-model="form.name"
              />
              <div class="invalid-feedback">
                {{ getErrors("name") }}
              </div>
            </div>

            <div class="form-group">
              <label for="email">Deskripsi</label>
              <textarea type="text"
              required 
              v-model="form.description" 
              class="form-control"
              :class="{ 'is-invalid': hasErrors('description') }"
              ></textarea>
              <div class="invalid-feedback">
                {{ getErrors("description") }}
              </div>
            </div>

            <div class="form-group">
              <label for="address">Alamat</label>
              <textarea type="text"
              required 
              v-model="form.address" 
              class="form-control"
              :class="{ 'is-invalid': hasErrors('address') }"
              ></textarea>
              <div class="invalid-feedback">
                {{ getErrors("address") }}
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label for="longitude">Longitude</label>
                <input type="text"
                required 
                v-model="form.longitude" 
                class="form-control"
                :class="{ 'is-invalid': hasErrors('longitude') }"
                />
                <div class="invalid-feedback">
                  {{ getErrors("longitude") }}
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="latitude">Latitude</label>
                <input type="text"
                required 
                v-model="form.latitude" 
                class="form-control"
                :class="{ 'is-invalid': hasErrors('latitude') }"
                />
                <div class="invalid-feedback">
                  {{ getErrors("latitude") }}
                </div>
              </div>
            </div>

            <div class="form-group mt-4 text-right">
              <button
                class="btn btn-secondary text-white shadow mx-2"
                @click="doReset()"
              >
                RESET
              </button>
              <button
                class="btn btn-primary shadow"
                v-show="!isLoading"
                @click="doSubmit()"
              >
                SAVE
              </button>
              <button class="btn btn-primary" disabled v-show="isLoading">
                SAVING...
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
  name: "StationEditModal",

  props: {
    station: {
      type: Object,
    }
  },

  data() {
    return {
      form: {...this.station},
      isLoading: false,
      errors: {},
    };
  },

  methods: {
    
    async doSubmit() {
      this.isLoading = true;

      try {
        var url = "/station/" + this.form.id;
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
    doReset() {
      this.form = {...this.station}
    }
  },
};
</script>

<style lang="scss" scoped>
</style>