<template>
  <div>
    <button
      class="btn btn-sm btn-warning"
      data-toggle="modal"
      :data-target="'#edit-operation-modal-' + log.id"
    >
      <span class="mdi mdi-pencil"></span>
    </button>
    <!-- Modal -->
    <div
      class="modal fade"
      :id="'edit-operation-modal-' + log.id"
      tabindex="-1"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ubah Data Pengukuran</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="doSubmit()">
              <div class="form-group">
                <label for="">Tanggal Pengukuran</label>
                <div>
                  <date-picker
                    value-type="format"
                    v-model="timestamp"
                    type="date"
                    :editable="false"
                  ></date-picker>
                </div>
              </div>
              <div class="form-group">
                <label for="">Berat</label>
                <input type="number" v-model="weight" class="form-control" />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" data-dismiss="modal">
              Close
            </button>
            <button v-show="isLoading == false" type="button" @click="doSubmit()" class="btn btn-primary">Save changes</button>
            <button v-show="isLoading" class="btn btn-bg-primary" disabled>Saving...</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "OperationEditModal",

  props: {
    initialLog: {
      type: Object,
    },
  },

  data() {
    return {
      log: { ...this.initialLog },
      isLoading: false,
    };
  },

  computed: {
    timestamp: {
      get: function () {
        if (this.log.parent_id == null) {
          return this.log.starts_at;
        }

        return this.log.ends_at;
      },
      set: function (newValue) {
        if (this.log.parent_id == null) {
          this.log.starts_at = newValue;
        } else {
          this.log.ends_at = newValue;
        }
      },
    },
    weight: {
      get: function () {
        if (this.log.parent_id == null) {
          return this.log.weight;
        }

        return this.log.final_weight;
      },
      set: function (newValue) {
        if (this.log.parent_id == null) {
          this.log.weight = newValue;
        } else {
          this.log.final_weight = newValue;
        }
      },
    },
  },

  methods: {
      async doSubmit() {
          this.isLoading = true

          try {
              let response = await axios.put(`/dropboxLog/${this.log.id}`, this.log)
              alert('Succeess')
              window.location.reload()
          } catch (error) {
              alert("Something went wrong");
              console.log(error)
          }

          this.isLoading = false
      }
  },
};
</script>

<style lang="scss" scoped>
</style>
