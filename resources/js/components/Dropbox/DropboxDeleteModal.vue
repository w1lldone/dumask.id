<template>
  <div>
    <button
      class="btn btn-danger"
      data-toggle="modal"
      :data-target="'#delete-dropbox-modal-' + dropbox.id"
    >
      <span class="mdi mdi-delete"></span>
    </button>
    <div
      class="modal fade"
      :id="'delete-dropbox-modal-' + dropbox.id"
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
              HAPUS DROPBOX
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
                  Apakah Anda yakin akan menghapus dropbox <b>{{ dropbox.color }}-{{ dropbox.model }}</b>?
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
  name: "DropboxDeleteModal",

  props: {
    dropbox: {
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
      var url = "/station/" + this.dropbox.station_id + "/dropbox/" + this.dropbox.id;
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