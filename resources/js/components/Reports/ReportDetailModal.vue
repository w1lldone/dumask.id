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
          <div class="modal-body text-left mx-4">
            {{ report }}
            <div class="text-secondary my-2">
                <b>Jenis Laporan</b>
                <br>
                {{ report.condition }}
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
export default {
  name: "ReportDetailModal",

  props: {
    report: {
      type: Object
    }
  },

  methods: {
    doReset() {
      this.form = {
        name: null,
        description: null,
        address: null,
        longitude: null,
        latitude: null,
      }
    },
  },
};
</script>

<style lang="scss" scoped>
</style>