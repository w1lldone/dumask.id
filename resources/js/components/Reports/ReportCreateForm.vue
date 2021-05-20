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
        <div class="">
          <div class="custom-control custom-radio"
            v-for="(condition, index) in conditions"
            :key="index"
          >
              <input
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
        </div>
        <div class="invalid-feedback">
          {{ getErrors("condition") }}
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
          SAVE
        </button>
        <button class="btn btn-primary" disabled v-show="isLoading">
          SAVING...
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
      isLoading: false,
      errors: {},
    };
  },

  methods: {
    async doSubmit() {
      // this.isLoading = true;
      await this.getUserLocation() ;
      var url = "../station/" + this.station.id + "/report";
      try {
        let response = await axios.post(url, this.form);
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
      }
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
      }
    },
  },
};
</script>

<style lang="scss" scoped>
</style>