<template>
  <div>
    <div
      class="modal fade"
      id="report-detail-modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal-id"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header mx-4">
            <h5
              class="modal-title font-weight-bold text-muted"
              id="modal-title"
            >
              REPORT DETAILS
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div v-if="report.id" class="modal-body text-left mx-4">
            <!-- {{ report }} -->
            <div class="text-secondary my-2">
                <b>Jenis Laporan</b>
                <br>
                {{ conditionDetails(report.condition) }}
            </div>
            <div class="text-secondary my-2">
                <b>Pembuat Laporan</b>
                <br>
                {{ report.reporter.name }}
            </div>
            <div class="text-secondary my-2">
                <b>Tanggal Laporan</b>
                <br>
                {{ new Date(report.created_at) | date("dd MMMM yyyy") }} 
            </div>
            <div class="text-secondary my-2">
                <b>Lokasi Pelapor dari Station</b>
                <br>
                <div v-if="distance">
                  {{ distance }} m
                </div>
                <div v-else class="text-dark">
                  Pelapor tidak memberikan lokasi
                </div>
            </div>
            <div class="text-secondary my-2">
                <b>Foto Laporan</b>
            </div>
            <media-report
                :stationId="report.station_id"
                :reportId="report.id"
            ></media-report>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { latLng } from "leaflet";
export default {
  name: "ReportDetailModal",

  props: {
    report: {
      type: Object
    },
    station: {
      type: Object
    },
    conditions: {
      type : Object
    },
  },

  methods: {
    conditionDetails(condition) {
        return this.conditions[condition]
    },
  },

  computed: {
    distance() {
      if (this.report.user_latitude && this.report.user_longitude) {
        var userLat = this.report.user_latitude
        var userLong = this.report.user_longitude
          return Math.round(latLng([userLat, userLong]).distanceTo([this.station.latitude, this.station.longitude]) * 10) / 10;
      }

      return null;
    }
  }

};
</script>

<style lang="scss" scoped>
</style>