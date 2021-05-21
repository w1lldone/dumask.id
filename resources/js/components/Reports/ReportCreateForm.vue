<template>
  <div>
    <div class="d-flex">
      <h5 class="text-dark font-weight-bold my-auto">
          REPORT STATION
      </h5>
    </div>
    <hr style="border-bottom: 2px solid #c4c4c4;">
    <div class="text-left">

      <div class="form-group">
        <label for="condition">
          Kondisi Dropbox
          <abbr class="text-danger">*</abbr>
        </label>
        <div class="custom-control custom-radio"
          v-for="(condition, index) in conditions"
          :key="index"
        >
            <input
              :name="'conditon'"
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
        <label for="photo">
          Foto (Opsional)
        </label>
        <div class="col-md-3 px-0">
          <label
            class="btn btn-outline-primary d-flex w-md-50"
          >
            <div class="mdi mdi-image"></div>
            <div class="my-auto">Upload Image</div>
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
      </div>
      <div class="form-group mt-4 text-right">
        <button
          style="background: #A7A7A7"
          class="btn text-white shadow mx-2"
          @click="doReset()"
        >
          RESET
        </button>
        <button
          class="btn btn-primary shadow"
          v-show="!isLoading"
          @click="doSubmit()"
        >
          SUBMIT
        </button>
        <button class="btn btn-primary" disabled v-show="isLoading">
          SUBMITTING...
        </button>
      </div>
    </div>
  </div>
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
      await this.getUserLocation() ;
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

      formData.append('condition', this.form.condition);
      formData.append('user_latitude', this.form.user_latitude);
      formData.append('user_longitude', this.form.user_longitude);

      try {
        let response = await axios.post(url, formData, config);
        alert("Report submitted!");
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
      this.form = {
        condition: null,
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
      try {
        const position = await this.getCoordinates();
        this.form.user_latitude = position.coords.latitude;
        this.form.user_longitude = position.coords.longitude;
      } catch (error) {
        alert("Please turn on your location service and try again.");
        this.isLoading = false;
      }
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