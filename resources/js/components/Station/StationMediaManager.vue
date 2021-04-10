<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#stationMediaModal"
    >
      Manage Galery
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="stationMediaModal"
      tabindex="-1"
      aria-labelledby="stationMediaModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title font-weight-bold text-muted"
              id="modal-title"
            >
              Station Galery Manager
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
          <div class="modal-body">
            <div class="row">
              <div v-show="!isLoading" class="col-md-6 mb-2">
                <label
                  class="btn btn-block btn-file btn-outline-primary h-100 d-flex align-items-center flex-column justify-content-center"
                >
                  <div class="h2 mdi mdi-image"></div>
                  <div>Upload New Image</div>
                  <div id="uploadMediaForm">
                    <input
                      type="file"
                      ref="media"
                      name="media"
                      style="display: none"
                      accept="image/*"
                      @change="doSubmit()"
                    />
                  </div>
                </label>
              </div>
              <div v-show="isLoading" class="col-md-6 mb-2">
                <div class="card card-body border-primary h-100">
                  <div class="text-primary text-center my-auto">
                    <span class="h2 mdi mdi-upload"></span>
                    <div>{{ uploadProgress }} %</div>
                    <div class="progress">
                      <div
                        class="progress-bar"
                        role="progressbar"
                        :style="{ width: uploadProgress+'%' }"
                        aria-valuenow="25"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                v-for="(item, index) in media"
                :key="item.id"
                class="col-md-6 mb-2"
              >
                <div class="card border-primary">
                  <img
                    :src="item.url"
                    style="max-height: 200px"
                    class="rounded mx-auto d-block"
                    alt=""
                  />
                  <delete-button
                    style="position: absolute; bottom: 10px; right: 10px"
                    :delete-url="`/station/${station.id}/media/${item.id}`"
                    @deleted="handleDeleted(index)"
                  >
                    <span class="mdi mdi-delete"></span>
                  </delete-button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "StationMediaManager",

  props: {
    station: Object,
  },

  data() {
    return {
      media: [],
      isLoading: false,
      uploadProgress: 0,
      errors: {},
    };
  },

  methods: {
    async doSubmit() {
      this.isLoading = true;
      var media = this.$refs.media.files[0];
      let formData = new FormData();
      formData.append("media", media);

      try {
        let response = await axios.post(
          `/station/${this.station.id}/media`,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
            onUploadProgress: function (progressEvent) {
              this.uploadProgress = parseInt(
                Math.round((progressEvent.loaded * 100) / progressEvent.total)
              );
            }.bind(this),
          }
        );
        this.media.push(response.data.data);
      } catch (error) {
        console.log(error);
      }

      this.isLoading = false;
    },
    async doFetch() {
      try {
        let response = await axios.get(`/station/${this.station.id}/media`);
        this.media = response.data.data;
      } catch (error) {
        console.log(error);
      }
    },
    handleDeleted(index) {
      this.media.splice(index, 1);
    },
  },

  mounted() {
    this.doFetch();
  },
};
</script>

<style lang="scss" scoped>
label {
  margin-bottom: 0;
}

.btn-file {
  position: relative;
  overflow: hidden;
}
.btn-file input[type="file"] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  outline: none;
  background: white;
  cursor: inherit;
  display: block;
}
</style>
