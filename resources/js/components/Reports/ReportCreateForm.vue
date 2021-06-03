<template>
  <form @submit.prevent="doSubmit()">
    <div class="d-flex">
      <h5 class="text-secondary font-weight-bold my-auto">
          Laporkan Kondisi Station
      </h5>
    </div>
    <hr style="border-bottom: 2px solid #c4c4c4;">

    <div class="text-left">
      <h4 class="text-secondary font-weight-bold" style="text-transform: uppercase;">{{ station.name }}</h4>
      <span class="mdi mdi-archive-outline text-secondary"></span>
      <span class="text-secondary font-weight-bold align-middle ml-2">{{ station.dropboxes_count }} Dropbox</span>
      <div class="mt-4">
        <div class="form-group">
          <label class="font-weight-bold" for="condition">
            Bagaimana kondisi dropbox di station ini?
            <small class="text-muted">(wajib diisi)</small>
          </label>
          <div class="custom-control custom-radio"
            v-for="(condition, index) in conditions"
            :key="index"
          >
              <input
                required
                name="conditon"
                :value="index"
                type="radio"
                class="custom-control-input"
                :id="'condition-' + index"
                v-model="form.condition"
              />
              <label class="custom-control-label" :for="'condition-' + index">
                {{ condition }}
              </label>
          </div>
          <div
            class="invalid-feedback"
            :class="{ 'd-block': hasErrors('condition') }"
          >
            {{ getErrors("condition") }}
          </div>
        </div>

        <div class="form-group">
          <label class="font-weight-bold" for="photo">
            Unggah foto pendukung
            <small class="text-muted">(opsional)</small>
          </label>
          <div class="col-md-3 px-0">
            <label
              class="btn btn-outline-secondary rounded d-flex"
            >
              <div class="mdi mdi-image"></div>
              <div class="my-auto">Unggah foto</div>
                <div id="uploadPhotoForm">
                  <input
                    id="inputPhoto"
                    type="file"
                    style="display: none"
                    ref="photo"
                    name="photo"
                    accept="image/*"
                    @change="getNewFileName"
                  />
                </div>
            </label>
          </div>
          <div
            id='photoName'
          >
            {{fileName}}
          </div>
          <small class="text-muted">Foto yang anda kirimkan dapat membantu kami memproses laporan dengan lebih tepat.</small>
        </div>

        <div class="form-group">


          <div>
            <div class="custom-control custom-checkbox mr-4">
              <input
                type="checkbox"
                class="custom-control-input"
                id="location-checkbox"
                v-model="form.send_location"
              />
              <label
                class="custom-control-label font-weight-bold"
                for="location-checkbox"
                >
                Saya setuju mengirimkan lokasi saya saat ini
                <small class="text-muted">(opsional)</small>
              </label>
              <div>
              </div>
            </div>
            <small class="text-muted">Lokasi yang Anda kirimkan dapat membantu kami memproses laporan dengan lebih cepat.</small>
          </div>
        </div>


        <div class="form-group mt-4 text-right">
          <button
            type="button"
            style="background: #A7A7A7"
            class="btn text-white shadow mx-2"
            @click="doReset()"
          >
            RESET
          </button>
          <button
            type="submit"
            class="btn btn-primary shadow"
            v-show="!isLoading"
          >
            SUBMIT
          </button>
          <button class="btn btn-primary" disabled v-show="isLoading">
            SUBMITTING...
          </button>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  name: "ReportCreateForm",

  props: {
    station: {
      type: Object
    },
    conditions: {
      type: Object
    }

  },

  data() {
    return {
      form: {
        condition: null,
        send_location: true,
        user_latitude: null,
        user_longitude: null,
      },
      photo: [],
      fileName: '',
      isLoading: false,
      isPhotoIncluded: false,
      errors: {},
    };
  },

  methods: {
    async doSubmit() {
      this.isLoading = true;
      var url = "../station/" + this.station.id + "/report";

      var config = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      }

      var formData = new FormData();

      if (this.isPhotoIncluded) {
        var photo = this.$refs.photo.files[0];
        formData.append('photo', photo);
      }

      if (this.form.send_location) {
        this.form.user_latitude = null
        this.form.user_longitude= null
        try {
            await this.getUserLocation();
        } catch (error) {
            this.isLoading = false
            return alert("Kami tidak dapat mendapatkan lokasi Anda. Pastikan GPS Anda aktif lalu silahkan coba lagi.");
        }
      }
      else {
        this.form.user_latitude = '',
        this.form.user_longitude= '';
      }

      formData.append('condition', this.form.condition);
      formData.append('user_latitude', this.form.user_latitude);
      formData.append('user_longitude', this.form.user_longitude);

      try {
        let response = await axios.post(url, formData, config);
        alert("Terima kasih atas laporan Anda!");
        return location.href = "/";
      } catch (error) {
        alert(error.response.data.message ?? error.response.data);
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

    doReset() {
      this.form = {
        condition: null,
        send_location: true,
      },
      this.photo = [],
      $('#inputPhoto').val(''),
      this.isPhotoIncluded = false,
      this.fileName = ''
    },

    async getCoordinates() {
      return new Promise(function (resolve, reject) {
        navigator.geolocation.getCurrentPosition(resolve, reject);
      });
    },

    async getUserLocation() {
        const position = await this.getCoordinates();
        this.form.user_latitude = position.coords.latitude;
        this.form.user_longitude = position.coords.longitude;
    },

    getNewFileName(event){
      var fileData =  event.target.files[0];
      this.fileName=fileData.name;
      this.isPhotoIncluded = true;
    }
  },
};
</script>

<style lang="scss" scoped>
</style>
