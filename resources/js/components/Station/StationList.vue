<template>
    <div>
        <div class="row my-4" v-for="(station) in stations" :key="station.id">
            <div class="col-md-3">
                <h5 class="m-0">
                    {{ station.name }}
                </h5>
            </div>
            <div class="col-md-2">
                {{ station.description }}
            </div>
            <div class="col-md-3">
                {{ station.address }}
            </div>
            <div class="col-md-1">
                {{ station.dropboxes_count }}
            </div>
            <div class="col-md-3">
                <a
                    :href = "'/station/' + station.id"
                    class="btn btn-primary"
                >
                Detail Station
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import DeleteButton from '../DeleteButton.vue'
import StationEditModal from './StationEditModal.vue'
    export default {
  components: { DeleteButton, StationEditModal },
        name: "StationList",

        props: {
            initialStations: {
                type: Array,
            },
        },

        data() {
            return {
                stations: this.initialStations,
            }
        },

        methods: {
        },
    }
</script>

<style lang="scss" scoped>

</style>