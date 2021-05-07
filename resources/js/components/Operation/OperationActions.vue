<template>
  <div>
    <dropbox-replace
      class="mb-2"
      :dropbox="dropbox"
      @succeed="dropbox.active_log = $event"
    ></dropbox-replace>
    <dropbox-inspect
      v-if="dropbox.active_log"
      :dropbox="dropbox"
      @succeed="dropbox.active_log = $event"
    ></dropbox-inspect>
    <transition name="slide-fade" mode="out-in">
      <div v-if="dropbox.active_log" class="mt-3" :key="dropbox.active_log.id">
        <div v-if="dropbox.active_log.ends_at">
          <b>Pengukuran Terakhir</b>: {{ dropbox.active_log.final_weight }} gram
          <br />
          <b>Tanggal</b>:
          {{ new Date(dropbox.active_log.ends_at) | date("dd MMMM yyyy") }}
        </div>
        <div v-else>
          <b>Pengukuran Terakhir</b>: {{ dropbox.active_log.weight }} gram
          <br />
          <b>Tanggal</b>:
          {{ new Date(dropbox.active_log.starts_at) | date("dd MMMM yyyy") }}
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  name: "OperationActions",

  props: {
    initialDropbox: {
      type: Object,
    },
  },

  data() {
    return {
      dropbox: {
        id: "",
        active_log: null,
      },
    };
  },

  mounted() {
    this.dropbox = { ...this.initialDropbox };
  },
};
</script>

<style lang="scss" scoped>
.slide-fade-enter-active {
  transition: all 0.3s ease;
}
.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active for <2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>
