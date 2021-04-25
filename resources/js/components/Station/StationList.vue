<template>
    <div>
        <table class="table table-borderless table-responsive d-md-table">
            <thead style="border-bottom: 1px solid #c4c4c4;">
                <tr>
                    <th scope="col" style="width: 20%">Nama</th>
                    <th scope="col" style="width: 25%">Deskripsi</th>
                    <th scope="col" style="width: 25%">Alamat</th>
                    <th scope="col" style="width: 15%">Total Dropbox</th>
                    <th scope="col" style="width: 15%"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(station) in stations" :key="station.id">
                    <td class="align-top text-primary font-weight-bold">{{ station.name }}</td>
                    <td class="align-top">{{ station.description }}</td>
                    <td class="align-top">{{ station.address }}</td>
                    <td class="align-top text-center">{{ station.dropboxes_count }}</td>
                    <td class="align-top text-right">
                        <a
                            :href = "'/station/' + station.id"
                            class="btn btn-primary "
                        >
                            Detail Station
                        </a>
                    </td>
                </tr>
            </tbody> 
        </table>
    </div>
</template>

<script>
    export default {
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