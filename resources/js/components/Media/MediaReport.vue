<template>
  <div
    id="carouselExampleIndicators"
    class="carousel slide"
    data-ride="carousel"
  >
    <div
      class="d-flex align-items-center justify-content-center text-muted card card-body border rounded bg-light"
      style="height: 200px"
      v-if="media == null"
    >
      <span class="mdi mdi-image-filter h1"></span>
      <h3>Foto tidak tersedia</h3>
    </div>
    <div v-else>
      <div class="carousel-inner bg-dark">
        <img class="d-block mx-auto" :src="media.url" style="max-height: 200px;"/>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MediaReport",

  props: {
    reportId: {
      type: Number,
    },
    stationId: {
      type: Number,
    },
  },

  data() {
    return {
      media: [],
    };
  },

  watch: {
    reportId(newValue, oldValue) {
      this.doFetch();
    },
  },

  methods: {
    async doFetch() {
      if (this.reportId == null) {
        return;
      }

      try {
        let response = await axios.get(`/station/${this.stationId}/report/${this.reportId}`);
        this.media = response.data.photo;
      } catch (error) {
        console.log(error);
      }
    },
  },

  mounted() {
    this.doFetch();
  },
};
</script>

<style lang="scss" scoped>
.carousel-item img {
  max-height: 200px;
  min-width: auto;
  margin-left: auto;
  margin-right: auto;
}
</style>
