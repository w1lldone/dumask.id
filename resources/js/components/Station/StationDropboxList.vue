<template>
    <div>
        <div class="row my-4" v-for="(dropboxes) in station.dropboxes" :key="dropboxes.id">
            <div class="col-md-3">
                {{ dropboxes.color }}
            </div>
            <div class="col-md-3">
                {{ dropboxes.model }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "StationDropboxList",

        props: {
    station: {
      type: Object,
    }
  },

        data() {
            return {
               
            }
        },

        methods: {
        },
    }
</script>

<style lang="scss" scoped>

</style>