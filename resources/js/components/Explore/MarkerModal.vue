<template>
    <div>
        <div class="modal fade" id="marker-modal-id" tabindex="-1" role="dialog" aria-labelledby="modal-id" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header mx-4">
                        <h5 class="modal-title font-weight-bold text-muted" id="modal-title">STATION</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-4">
                        <media-carousel :station-id="station.id"></media-carousel>
                        <div class="mt-4">
                            <h5 class="text-secondary font-weight-bold">{{ station.name }}</h5>
                            <p>{{ station.address }}</p>
                            <div v-if="station.dropboxes_count">
                                <div>
                                    <span class="mdi mdi-archive-outline text-secondary"></span>
                                    <span class="text-secondary font-weight-bold align-middle ml-2">{{ station.dropboxes_count }} Dropbox tersedia</span>
                                    <div class="text-danger align-middle ml-4">
                                        Dropbox ini khusus untuk limbah APD dari masyarakat, bukan untuk limbah medis dari RS/Klinik
                                    </div>
                                </div>
                                <div>

                                </div>
                                <div>
                                    <marker-schedule :schedules="station.schedules"></marker-schedule>
                                </div>
                                <div v-if="distance">
                                    <span class="mdi mdi-crosshairs-gps text-secondary"></span>
                                    <span class="text-secondary font-weight-bold align-middle ml-2">{{ distance }} km dari lokasi Anda</span>
                                </div>
                                <div v-else>
                                    <span class="mdi mdi-crosshairs text-muted"></span>
                                    <span class="text-muted font-weight-bold align-middle ml-2">Nyalakan lokasi untuk menghitung jarak</span>
                                </div>
                                <div class="text-right mt-3">
                                    <a target="_blank" class="btn btn-dark text-white shadow mr-3" :href="'/submit-report/' + station.id">REPORT<span class="mdi mdi-open-in-new"></span></a>
                                    <a target="_blank" class="btn btn-primary shadow" :href="routeUrl">ROUTE <span class="mdi mdi-open-in-new"></span></a>
                                </div>
                            </div>
                            <div v-else>
                                <h5 class="text-secondary text-center font-weight-bold my-4">Dropbox DUMASK.ID akan segera hadir di lokasi ini.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { latLng } from "leaflet";
import MarkerSchedule from './MarkerSchedule.vue';

export default {
  components: { MarkerSchedule },
    name: "MarkerModal",

    props: {
        station: {
            type: Object
        },
        userLat: Number,
        userLong: Number
    },

    computed: {
        routeUrl() {
            return `https://www.google.com/maps/dir/?api=1&destination=${this.station.latitude},${this.station.longitude}`
        },
        distance() {
            if (this.station.distance) {
                return Math.round(this.station.distance * 10) / 10;
            }

            if (this.userLat && this.userLong) {
                return Math.round(latLng([this.userLat, this.userLong]).distanceTo([this.station.latitude, this.station.longitude]) / 1000 * 10) / 10;
            }

            return null;
        }
    },
}
</script>

<style lang="sass" scoped>

</style>
