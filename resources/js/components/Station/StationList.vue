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
                    <td class="align-top font-weight-bold">
                        <a :href = "'/station/' + station.id">
                            {{ station.name }}
                        </a>
                    </td>
                    <td class="align-top">{{ station.description }}</td>
                    <td class="align-top">{{ station.address }}</td>
                    <td class="align-top text-center">{{ station.dropboxes_count }}</td>
                    <td class="align-top text-right">
                        <div>
                            <station-edit-modal :station='station' class="d-inline"></station-edit-modal>
                            <delete-modal 
                                class="d-inline mx-md-1" 
                                :delete-url="`/station/${station.id}`" 
                                :delete-id="(station.id).toString()"
                                :delete-name="station.name"
                                delete-type="station"
                                @deleted="handleDeleted(index)">
                            </delete-modal>
                        </div>
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