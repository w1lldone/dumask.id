<template>
  <div
    id="carouselExampleIndicators"
    class="carousel slide"
    data-ride="carousel"
    v-if="media.length"
  >
    <ol class="carousel-indicators">
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
    station: {
      type: Object,
    },
  },

  data() {
    return {
      media: [],
    };
  },

  methods: {
    async doFetch() {
      try {
        let response = await axios.get(`/station/${this.station.id}/media`);
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
