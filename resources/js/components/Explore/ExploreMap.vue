<template>
  <div>
    <h2 class="text-primary text-center font-weight-bold mt-2 mb-0">
      YUK, BUANG MASKER KITA PADA TEMPATNYA
    </h2>
    <p class="text-secondary text-center font-weight-bold">
      Temukan dropboxes DUMASK.ID di sekitarmu
    </p>

    <div class="d-md-flex justify-content-between form-group mx-auto">
      <div class="col-md-8 col-12">
        <input
          type="text"
          placeholder="Cari Station"
          class="form-control shadow"
          v-model="form.keywords"
        />
      </div>
      <div class="d-flex col-md-4 col-12 justify-content-between">
        <button
          id="btn-location"
          @click="getUserLocation()"
          class="btn btn-primary shadow mr-2"
        >
          <img src="/img/icon_location.svg" class="mx-auto my-auto" />
        </button>
        <button class="btn btn-primary shadow ml-2 w-100">
          Station Terdekat
        </button>
      </div>
    </div>
    <div id="leaflet" class="mx-auto" style="height: 400px"></div>
  </div>
</template>

<script>
export default {
  name: "ExploreMap",

  data() {
    return {
      map: null,
      markers: [],
      userMarker: null,
      form: {
        keywords: null,
      },
    };
  },

  methods: {
    initialize() {
      this.map = new L.map("leaflet");
      var latlng = new L.LatLng(-7.770717, 110.377724);
      this.map.setView(latlng, 13);
      L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
        attribution:
          '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      }).addTo(this.map);

      this.fetchStations();
    },
    async fetchStations() {
      var response = await axios.get("/api/stations");
      if (!response.data.data) return;

      var leaflet = this.map;
      this.markers = response.data.data.map(function (item) {
        var coordinates = new L.LatLng(item.latitude, item.longitude);
        L.marker(coordinates).addTo(leaflet);
        return coordinates;
      });

      this.map.fitBounds(this.markers, {
        padding: [20, 20],
      });
    },
    async getUserLocation() {
      // Variable redeclaration. Because `this` can not be used inside a callback function
      var markers = this.markers;
      var userMarker = this.userMarker;
      var leaflet = this.map;
      navigator.geolocation.getCurrentPosition(
        function (location) {
          var latlng = new L.LatLng(
            location.coords.latitude,
            location.coords.longitude
          );

          if (userMarker) {
            leaflet.removeLayer(userMarker);
            markers.pop();
          }

          userMarker = L.marker(latlng);
          markers.push(latlng);
          leaflet.addLayer(userMarker);

          leaflet.fitBounds(markers, {
            padding: [20, 20],
          });
        },
        async function (err) {
          alert("Silakan nyalakan lokasi dan coba lagi.");
        }
      );
    },
  },

  mounted() {
    this.initialize();
  },
};
</script>

<style lang="scss" scoped>
</style>