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
                    <th scope="col" style="width: 20%">Kategori</th>
                    <th scope="col" style="width: 20%">Tanggal Laporan</th>
                    <th scope="col" style="width: 20%">Status</th>
                    <th scope="col" style="width: 15%">Pelapor</th>
                    <th scope="col" style="width: 15%"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(report) in reports" :key="report.id">
                    <td class="align-top text-primary font-weight-bold">{{ report.condition }}</td>
                    <td class="align-top">{{ report.created_at }}</td>
                    <td class="align-top">
                        <div v-if="report.resolver_id">
                            Resolved
                        </div>
                        <div v-else class="text-danger">
                            Open
                        </div>
                    </td>
                    <td class="align-top text-center">{{ report.reporter_id }}</td>
                    <td class="align-top text-right">
                        <a
                            href = "#"
                            class="btn btn-primary "
                        >
                            DETAIL LAPORAN
                        </a>
                    </td>
                </tr>
            </tbody> 
        </table>
    </div>
</template>

<script>
    export default {
        name: "ReportList",

        props: {
            reports: {
                type: Array,
            },
            conditions: {
                type : Array
            }
        },

        methods: {

        },

        data() {
            return {
                dataReports: this.reports,
                dataConditions : this.conditions
            };
        },

        computed: {
            groupedReports() {
                const groupedReports = {};

                var reports = this.dataReports
                var conditions = this.dataConditions

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
    }

</script>

<style lang="scss" scoped>

</style>