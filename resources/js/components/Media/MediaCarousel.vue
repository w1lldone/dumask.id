<template>
  <div
    id="carouselExampleIndicators"
    class="carousel slide"
    data-ride="carousel"
  >
    <div
      class="d-flex align-items-center justify-content-center text-muted card card-body border rounded bg-light"
      style="height: 200px"
      v-if="media.length == 0"
    >
      <span class="mdi mdi-image-filter h1"></span>
      <h3>Foto belum tersedia</h3>
    </div>
    <ol class="carousel-indicators" v-else>
      <li
        v-for="(item, index) in media"
        :key="item.id"
        data-target="#carouselExampleIndicators"
        :data-slide-to="index"
      ></li>
    </ol>
    <div class="carousel-inner">
      <div
        class="carousel-item bg-dark rounded"
        :class="{ active: index == 0 }"
        v-for="(item, index) in media"
        :key="item.id"
      >
        <img :src="item.url" class="d-block" />
      </div>
    </div>
    <a
      class="carousel-control-prev"
      href="#carouselExampleIndicators"
      role="button"
      data-slide="prev"
    >
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a
      class="carousel-control-next"
      href="#carouselExampleIndicators"
      role="button"
      data-slide="next"
    >
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</template>

<script>
export default {
  name: "MediaCarousel",

  props: {
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
    stationId(newValue, oldValue) {
      this.doFetch();
    },
  },

  methods: {
    async doFetch() {
      if (this.stationId == null) {
        return;
      }

      try {
        let response = await axios.get(`/station/${this.stationId}/media`);
        this.media = response.data.data;
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
