<template>
  <div>
    <button
      class="btn btn-danger shadow"
      data-toggle="modal"
      data-target="#delete-station-modal-id"
    >
      DELETE STATION
    </button>
    <div
      class="modal fade"
      id="delete-station-modal-id"
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
                  style="text-transform: uppercase"
                  >
                  HAPUS STATION
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
                  <div>
                      Apakah Anda yakin akan menghapus station <b>{{station.name}}</b>?
                  </div>
                  <div class="mt-4 text-right">
                      <button type="button" class="btn btn-primary mx-2 shadow" data-dismiss="modal">TIDAK</button>
                      <button
                          class="btn btn-secondary shadow"
                          v-show="!isLoading"
                          @click="doDelete()"
                      >
                          YA
                      </button>
                      <button class="btn btn-secondary" disabled v-show="isLoading">
                          YA
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
  name: "StationDeleteModal",

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
    
    async doDelete() {
      this.isLoading = true;

      try {
        var url = "/station/" + this.form.id;
        let response = await axios.delete(url);
        this.$emit('deleted')
        alert('deleted')
        return location.href = "/station/";
      } catch (error) {
        alert(error.response.data.message);
        console.log(error.response);
        this.errors = error.response.data.errors;
      }

      this.isLoading = false;
    },
  },
};
</script>

<style lang="scss" scoped>
</style>