<template>
    <div>
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
                    <td class="align-top"></td>
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
        },

        methods: {
        },
    }
</script>

<style lang="scss" scoped>

</style>