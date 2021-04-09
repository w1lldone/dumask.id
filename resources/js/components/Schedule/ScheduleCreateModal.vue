<template>
  <div>
    <button
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#create-schedule-modal-id"
    >
      Create new schedule
    </button>
    <div
      class="modal fade"
      id="create-schedule-modal-id"
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
              Create New Schedule for {{ station.name }}
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
              <label for="color">Day</label>
              <select 
                name="day" 
                id="dy"
                class="form-control"
                :class="{ 'is-invalid': hasErrors('day') }"
                v-model="form.day"
              >
                <option 
                v-for="(day, index) in days"
                :key="day"
                :value="index"
                >
                  {{ day }}
                </option>
              </select>
              <div class="invalid-feedback">
                {{ getErrors("day") }}
              </div>
            </div>
            
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="isClosed" v-model="isClosed">
                <label class="custom-control-label" for="isClosed">Closed today</label>
              </div>
            </div>

            <div class="form-group">
              <label for="opened_at">Open At</label>
              <input type="time"
              :disabled="isClosed"
              required 
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
              required 
              :disabled="isClosed"
              v-model="form.closed_at" 
              class="form-control"
              :class="{ 'is-invalid': hasErrors('closed_at') }"
              />
              <div class="invalid-feedback">
                {{ getErrors("closed_at") }}
              </div>
            </div>

            <div class="form-group mt-4 text-right">
              <button
                class="btn btn-success"
                v-show="!isLoading"
                @click="doSubmit()"
              >
                Create schedule
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
import dayOfWeeks from '../../mixins/dayOfWeeks';

export default {
  name: "ScheduleCreateModal",

  mixins: [dayOfWeeks],

  props: {
    station: {
      type: Object
    },
  },

  data() {
    return {
      form: {
        station_id: this.station.id,
        day: null,
        opened_at: null,
        closed_at: null,
      },
      isClosed: false,
      isLoading: false,
      errors: {},
    };
  },

  methods: {
    async doSubmit() {
      this.isLoading = true;
      var url = "/station/" + this.station.id + "/schedule";
      try {
        let response = await axios.post(url, this.form);
        this.$emit('created', response.data);
        alert('schedule created')
        this.form.day = null
        this.form.closed_at = null
        this.form.opened_at = null
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
};
</script>

<style lang="scss" scoped>
</style>