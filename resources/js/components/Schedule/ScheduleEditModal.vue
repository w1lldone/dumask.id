<template>
  <div>
    <button
      class="btn btn-warning"
      data-toggle="modal"
      :data-target="'#edit-schedule-modal-' + schedule.id"
    >
      Update schedule
    </button>
    <div
      class="modal fade"
      :id="'edit-schedule-modal-' + schedule.id"
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
              Update schedule
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
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" :id="`editIsClosed${schedule.id}`" v-model="isClosed">
                <label class="custom-control-label" :for="`editIsClosed${schedule.id}`">Closed today</label>
              </div>
            </div>

            <div class="form-group">
              <label for="opened_at">Open At</label>
              <input type="time"
              required
              :disabled="isClosed"
              v-model="form.opened_at" 
              class="form-control"
              :class="{ 'is-invalid': hasErrors('opened_at') }"
              />
              <div class="invalid-feedback">
                {{ getErrors("opened_at") }}
              </div>
            </div>

            <div class="form-group">
              <label for="closed_at">Close At</label>
              <input type="time"
              :disabled="isClosed"
              required 
              v-model="form.closed_at" 
              class="form-control"
              :class="{ 'is-invalid': hasErrors('closed_at') }"
              />
              <div class="invalid-feedback">
                {{ getErrors("closed_at") }}
              </div>
            </div>

            <div class="form-group mt-4 text-right">
              <button class="btn" data-dismiss="modal">
                Cancel
              </button>
              <button
                class="btn btn-success"
                v-show="!isLoading"
                @click="doSubmit()"
              >
                Update schedule
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
  name: "ScheduleEditModal",

  props: {
    schedule: {
      type: Object
    },
  },

  data() {
    return {
      form: {...this.schedule},
      isClosed: false,
      isLoading: false,
      errors: {},
    };
  },

  methods: {
    async doSubmit() {
      this.isLoading = true;
      var url = "/station/" + this.schedule.station_id + "/schedule/" + this.schedule.id;
      try {
        let response = await axios.put(url, this.form);
        $('#edit-schedule-modal-' + this.schedule.id).modal('hide')
        this.$emit('updated', response.data)
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

  watch: {
    isClosed(newValue, oldValue) {
      if (newValue == true) {
        this.form.opened_at = null
        this.form.closed_at = null
      }
    }
  },

  mounted(){
    if (this.form.opened_at == null && this.form.closed_at == null) {
      this.isClosed = true
    }
  }
};
</script>

<style lang="scss" scoped>
</style>