<template>
  <div>
    <h2 class="text-primary text-center font-weight-bold mt-2 mb-0">
      YUK, BUANG MASKER KITA PADA TEMPATNYA
    </h2>
    <p class="text-secondary text-center font-weight-bold">
      Temukan dropboxes DUMASK.ID di sekitarmu
    </p>

    <div class="row mb-4 justify-content-between form-group mx-auto">
      <div class="col-md-8 col-12 py-2">
        <input
          type="search"
          placeholder="Cari Station"
          class="form-control shadow"
          v-model="form.keywords"
        />
      </div>
      <div class="d-flex col-md-4 py-2 col-12 justify-content-between">
        <button
          id="btn-location"
          @click="getUserLocation()"
          class="btn btn-primary shadow mr-2"
        >
          <img src="/img/icon_location.svg" class="mx-auto my-auto" />
        </button>
        <button
          class="btn btn-primary shadow ml-2 w-100"
          @click="getNearbyStations()"
        >
          Station Terdekat
        </button>
      </div>
    </div>
    <div style="height: 400px">
      <l-map :zoom="13" :center="[-7.770717, 110.377724]" ref="map">
        <!-- Marker for stations -->
        <l-marker
          v-for="station in stations"
          :key="station.id"
          :lat-lng="[station.latitude, station.longitude]"
        >
        </l-marker>

        <!-- Marker for users -->
        <l-marker
          v-if="form.latitude"
          :lat-lng="[form.latitude, form.longitude]"
        ></l-marker>
        <l-tile-layer
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        ></l-tile-layer>
      </l-map>
    </div>
  </div>
</template>

<script>
export default {
  name: "ExploreMap",

  data() {
    return {
      form: {
        keywords: null,
        latitude: null,
        longitude: null,
      },
      stations: [],
    };
  },

  computed: {
    bounds() {
      // get longitude and latitude from stations
      var bounds = this.stations.map(function (station) {
        return [station.latitude, station.longitude];
      });

      // Merge stations with user location
      if (this.form.latitude && this.form.longitude) {
        bounds.push([this.form.latitude, this.form.longitude]);
      }

      return bounds;
    },
  },

  watch: {
    // Watch changes on bounds computed property (line 74)
    // This will automatically adjust map bounds on station changes or user location changes
    bounds(newValue, oldValue) {
      // refit bounds on changes
      this.fitBounds()
    },
  },

  methods: {
    async getCoordinates() {
      return new Promise(function (resolve, reject) {
        navigator.geolocation.getCurrentPosition(resolve, reject);
      });
    },
    async fetchStations() {
      var response = await axios.get("/api/stations", {
        params: this.form,
      });

      this.stations = response.data.data;

      return response.data.data;
    },
    async getUserLocation() {
      try {
        const position = await this.getCoordinates();
        this.form.latitude = position.coords.latitude;
        this.form.longitude = position.coords.longitude;
      } catch (error) {
        alet("Please turn on your location service and try again.");
      }
    },
    async getNearbyStations() {
      await this.getUserLocation();
      await this.fetchStations();
      this.fitBounds()
    },
    fitBounds() {
      this.$refs.map.mapObject.fitBounds(this.bounds, {
        padding: [30, 30],
      });
    },
  },

  mounted() {
    this.fetchStations();
  },
};
</script>

<style lang="scss" scoped>
</style>