<template>
  <div>
    <button
      class="btn btn-danger"
      data-toggle="modal"
      :data-target="'#delete-schedule-modal-' + schedule.id"
    >
      Delete schedule
    </button>
    <div
      class="modal fade"
      :id="'delete-schedule-modal-' + schedule.id"
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
              Delete schedule
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
            <h6>
              Are you sure?
            </h6>
            <div class="form-group mt-4 text-right">
              <button
                class="btn btn-danger"
                v-show="!isLoading"
                @click="doDelete()"
              >
                Delete
              </button>
              <button
              type="button"
              class="btn"
              data-dismiss="modal"
              v-show="!isLoading"
              aria-label="Close"
              >
                Cancel
              </button>
              <button class="btn btn-danger" disabled v-show="isLoading">
                Deleting...
              </button>
              <button class="btn" disabled v-show="isLoading">
                Cancel
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
  name: "ScheduleDeleteModal",

  props: {
    schedule: {
      type: Object
    },
  },

  data() {
    return {
      isLoading: false,
      errors: {},
    };
  },

  methods: {
    async doDelete() {
      this.isLoading = true;
      var url = "/station/" + this.schedule.station_id + "/schedule/" + this.schedule.id;
      try {
        let response = await axios.delete(url);
        this.$emit('deleted')
        alert('deleted')
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