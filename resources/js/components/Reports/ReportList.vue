<template>
    <div>
        <div class="d-flex flex-row card border-0 py-3 mt-2 mb-4 shadow">
            <div
                v-for="(groupedReport, index) in groupedReports"
                :key="index"
                class="col text-center"
            >
                <h5 class="text-dark" style="text-transform: Capitalize">
                    {{ index }}
                </h5>
                <h4 class="text-secondary font-weight-bold">{{ groupedReport }}</h4>
            </div>
        </div>

        <table class="table table-borderless table-responsive d-md-table">
            <thead style="border-bottom: 1px solid #c4c4c4;">
                <tr>
                    <th scope="col" style="width:5%"></th>
                    <th scope="col" style="width: 25%">Kategori</th>
                    <th scope="col" style="width: 20%">Tanggal Laporan</th>
                    <th scope="col" style="width: 10%">Status</th>
                    <th scope="col" style="width: 15%">Pelapor</th>
                    <th scope="col" style="width: 15%"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(report) in dataReports" :key="report.id">
                    <td class="align-top">
                        <input v-if="!report.resolved_at" class="custom-control" name="report_id" type="checkbox" :value="report.id" v-model="form.report_id">
                    </td>
                    <td class="align-top text-primary font-weight-bold">{{ conditionDetails(report.condition) }}</td>
                    <td class="align-top">{{ new Date(report.created_at) | date("dd MMMM yyyy") }}</td>
                    <td class="align-top">
                        <div>
                            <h6>
                                <span v-if="report.resolved_at" class="badge badge-success badge-pill">
                                    Resolved
                                </span>
                                <span v-else class="badge badge-danger badge-pill">
                                    Open
                                </span>
                            </h6>
                        </div>
                    </td>
                    <td class="align-top">{{ report.reporter.name }}</td>
                    <td class="align-top text-right">
                        <button
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#report-detail-modal"
                            @click="showReportDetail(report)"
                        >
                            REPORT DETAILS
                        </button>
                    </td>
                </tr>
            </tbody>
            <report-detail-modal :report="selectedReport" :station="this.station" :conditions="this.conditions"></report-detail-modal>
        </table>
        <div class="col-12 text-right">
            <button
                style="background: #A7A7A7"
                class="btn text-white shadow mr-2"
                v-show="!isLoading"
                @click="doReset()"
            >
            RESET
            </button>
            <button
                style="background: #A7A7A7"
                class="btn text-white shadow mr-2"
                v-show="isLoading"
                disabled
            >
            RESET
            </button>

            <button
                class="btn btn-primary shadow mr-2"
                v-show="!isLoading && form.report_id != ''"
                @click="doSubmit()"
            >
            RESOLVE
            </button>
            <button
                class="btn btn-primary shadow mr-2"
                v-show="isLoading || form.report_id == ''"
                disabled
            >
            RESOLVE
            </button>

            <button
                class="btn btn-secondary shadow"
                v-show="!isLoading"
                @click="doResolveAll()"
            >
            RESOLVE ALL
            </button>
            <button
                class="btn btn-secondary shadow"
                v-show="isLoading"
                disabled
            >
            RESOLVE ALL
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ReportList",

        props: {
            station: {
                type: Object,
            },
            reports: {
                type: Array,
            },
            conditions: {
                type : Object
            },
        },

        data() {
            return {
                isLoading : false,
                dataReports: this.reports,
                form : {
                    report_id : []
                },
                selectedReport : {}
            };
        },

        computed: {
            groupedReports() {
                const groupedReports = {}

                var reports = this.dataReports
                var conditions = Object.keys(this.conditions)

                for (let i = 0; i < conditions.length; i++) {
                    groupedReports[conditions[i]] = 0;
                }

                for (let i = 0; i < reports.length; i++) {
                    for (let j = 0; j < conditions.length; j++) {
                        if (reports[i].condition == conditions[j]) {
                            groupedReports[conditions[j]] += 1;
                        }
                    }
                }

                return groupedReports
            }
        },

        methods: {
            conditionDetails(condition) {
                return this.conditions[condition]
            },
            async doSubmit() {
                this.isLoading = true;

                var url = "/station/" + this.station.id + "/report/resolve";

                try {
                    let response = await axios.put(url, this.form);
                    alert("Reports Resolved!");
                    return location.reload();
                } catch (error) {
                    alert(error.response.data.message);
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                }

                this.isLoading = false;
            },

            async doResolveAll() {
                this.isLoading = true;
                this.form.resolve_all = true;
                var url = "/station/" + this.station.id + "/report/resolve";

                try {
                    let response = await axios.put(url, this.form);
                    alert("Reports Resolved!");
                    return location.reload();
                } catch (error) {
                    alert(error.response.data.message);
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                }

                this.isLoading = false;
            },

            async doReset() {
                this.isLoading = false;
                this.form = {
                    report_id : [],
                    resolve_all : false
                }
            },

            showReportDetail(report) {
                this.selectedReport = report
            }
        },
    }

</script>

<style lang="scss" scoped>

</style>
