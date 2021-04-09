<template>
  <div>
    <h2 class="text-primary text-center font-weight-bold mt-2 mb-0">
      YUK, BUANG MASKER KITA PADA TEMPATNYA
    </h2>
    <p class="text-secondary text-center font-weight-bold">
      Temukan dropboxes DUMASK.ID di sekitarmu
    </p>

    <div class="row mb-4 justify-content-between form-group mx-auto">
      <div class="col-md-8 col-12 py-2 px-0">
        <form @submit.prevent="fetchStations()">
          <div class="input-group shadow">
            <input
              type="text"
              placeholder="Cari Station"
              class="form-control border-0"
              v-model="form.keywords"
              aria-label="Cari Station"
            />
            <div class="input-group-append text-primary">
              <button
                v-show="form.keywords"
                type="button"
                class="btn border-0"
                @click="form.keywords = null"
              >
                <span class="mdi mdi-close"></span>
              </button>
              <button type="submit" class="btn border-0">
                <span class="mdi mdi-magnify"></span>
              </button>
            </div>
          </div>
        </form>
      </div>
      <div
        class="d-flex col-md-4 py-2 col-12 px-0 pl-md-3 justify-content-between"
      >
        <button
          id="btn-location"
          @click="getUserLocation()"
          class="btn btn-primary shadow mr-2"
        >
          <img src="/img/icon_location.svg" class="mx-auto my-auto" />
        </button>
        <button
          v-show="!form.distance"
          class="btn btn-primary shadow ml-2 w-100"
          @click="getNearbyStations()"
        >
          STATION TERDEKAT
        </button>
        <button
          v-show="form.distance"
          class="btn btn-primary shadow ml-2 w-100"
          @click="getAllStations()"
        >
          TAMPILKAN SEMUA STATION
        </button>
      </div>
    </div>
    <div style="height: 400px">
      <l-map
        :zoom="13"
        :center="[-7.770717, 110.377724]"
        ref="map"
        style="border-radius: 0.5rem"
      >
        <!-- Marker for stations -->
        <l-marker
          v-for="station in stations"
          :key="station.id"
          :lat-lng="[station.latitude, station.longitude]"
          @click="showMarkerModal(station)"
        >
          <l-icon
            v-if="station.dropboxes_count"
            icon-url="/img/pin_location.svg"
            :icon-size="[30, 30 * 1.15]"
            :icon-anchor="anchor"
          ></l-icon>
          <!-- Stations with no dropbox -->
          <l-icon
            v-else
            icon-url="/img/pin_location_dark.svg"
            :icon-size="[30, 30 * 1.15]"
            :icon-anchor="anchor"
          ></l-icon>
        </l-marker>

        <!-- Marker for users -->
        <l-marker
          v-if="form.latitude"
          :lat-lng="[form.latitude, form.longitude]"
        >
          <l-icon
            icon-url="/img/pin_user.svg"
            :icon-size="[30, 30 * 1.15]"
            :icon-anchor="anchor"
          ></l-icon>
          <l-popup>Lokasi Anda</l-popup>
        </l-marker>
        <l-tile-layer
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        ></l-tile-layer>
      </l-map>
    </div>
    <marker-modal
      :station="activeStation"
      :user-lat="form.latitude"
      :user-long="form.longitude"
    ></marker-modal>
  </div>
</template>

<script>
import { LIcon, LPopup } from "vue2-leaflet";

export default {
  name: "ExploreMap",

  data() {
    return {
      form: {
        keywords: null,
        latitude: null,
        longitude: null,
        distance: null
      },
      stations: [],
      activeStation: {},
      anchor: [17, 38]
    };
  },

  components: {
    LIcon,
    LPopup
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
      this.fitBounds();
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

      if (this.stations.length == 0) {
        alert('Ups, Kami tidak menemukan stasiun DUMASK.ID yang anda cari. Silahkan coba dengan kata kunci lain.');
      }

      return response.data.data;
    },
    async getUserLocation() {
      try {
        const position = await this.getCoordinates();
        this.form.latitude = position.coords.latitude;
        this.form.longitude = position.coords.longitude;
      } catch (error) {
        alert("Please turn on your location service and try again.");
      }
    },
    async getNearbyStations() {
      await this.getUserLocation();
       // Set maximum distance in km
      this.form.distance = 15
      await this.fetchStations();
      this.fitBounds();
    },
    async getAllStations() {
      // Clear distance
      this.form.distance = null
      await this.fetchStations();
      this.fitBounds();
    },
    fitBounds() {
      this.$refs.map.mapObject.fitBounds(this.bounds, {
        padding: [30, 30],
      });
    },
    showMarkerModal(station) {
      this.activeStation = station
      $("#marker-modal-id").modal("toggle")
    }
  },

  mounted() {
    this.fetchStations();
  },
};
</script>

<style lang="scss" scoped>
</style>