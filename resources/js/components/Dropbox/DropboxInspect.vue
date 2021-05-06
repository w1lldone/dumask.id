<template>
  <div>
    <button
      class="btn btn-outline-secondary"
      data-toggle="modal"
      :data-target="`#inspect${dropbox.id}`"
    >
      Ukur Berat Dropbox
    </button>
    <div
      class="modal fade"
      :id="`inspect${dropbox.id}`"
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
              Ukur berat Dropbox {{ dropbox.color }} - {{ dropbox.model }}
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
              <label for="model">Tanggal</label>
              <div>
                <date-picker
                  value-type="format"
                  v-model="form.timestamp"
                  type="date"
                  :editable="false"
                ></date-picker>
              </div>
              <div class="invalid-feedback">
                {{ getErrors("timestamp") }}
              </div>
            </div>

            <div class="form-group">
              <label for="filled_weight">Berat</label>
              <div class="input-group">
                <input
                  type="number"
                  required
                  v-model="form.filled_weight"
                  class="form-control"
                  :class="{ 'is-invalid': hasErrors('filled_weight') }"
                />
                <div class="input-group-append">
                  <span class="input-group-text">gram</span>
                </div>
                <div class="invalid-feedback">
                  {{ getErrors("filled_weight") }}
                </div>
              </div>
            </div>

            <div class="form-group mt-4 text-right">
              <button class="btn" data-dismiss="modal">Batal</button>
              <button
                class="btn btn-success"
                v-show="!isLoading"
                @click="doSubmit()"
              >
                Simpan Hasil Pengukuran
              </button>

              <button class="btn btn-success" disabled v-show="isLoading">
                menyimpan...
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
  name: "DropboxInspect",

  props: {
    dropbox: {
      type: Object,
    },
  },

  data() {
    return {
      form: {
        dropbox_id: this.dropbox.id,
        timestamp: this.$date(new Date(), "yyyy-MM-dd"),
        filled_weight: null,
      },
      isLoading: false,
      errors: {},
    };
  },

  methods: {
    async doSubmit() {
      this.isLoading = true;

      try {
        let response = await axios.post(
          `/operation/${this.dropbox.station_id}/inspect`,
          this.form
        );
        // alert("Data Tersimpan");
        this.form.timestamp = this.$date(new Date(), "yyyy-MM-dd");
        this.form.filled_weight = null;
        this.error = {};
        $(`#inspect${this.dropbox.id}`).modal("hide");
        this.$emit('succeed', response.data)
      } catch (error) {
        console.log(error.response.data.errors);
        alert("Ada yang salah " + error.response.data.message);
        if (error.response.status == 422) {
            this.errors = error.response.data.errors;
        }
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
