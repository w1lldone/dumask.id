<template>
    <div>
        <table class="table table-borderless table-responsive d-md-table">
            <thead style="border-bottom: 1px solid #c4c4c4;">
                <tr>
                    <th scope="col" style="width: 40%">Dropbox</th>
                    <th scope="col" style="width: 45%"></th>
                    <th scope="col" style="width: 15%"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(dropbox, index) in dropboxes" :key="dropbox.id">
                    <td class="align-top text-primary font-weight-bold">Box {{ dropbox.color }}-{{ dropbox.model }}</td>
                    <td class="align-top">
                        <dropbox-replace @succeed="handleSucceed($event, index)" class="d-inline" :dropbox="dropbox"></dropbox-replace>
                        <dropbox-inspect v-if="dropbox.active_log_id" class="d-inline" :dropbox="dropbox"></dropbox-inspect>
                    </td>
                    <td class="align-top text-right">
                        <dropbox-edit-modal :dropbox="dropbox" :colors='colors' :models='models' class="d-inline"></dropbox-edit-modal>
                        <dropbox-delete-modal :dropbox="dropbox" class="d-inline"></dropbox-delete-modal>
                    </td>
                </tr>
            </tbody> 
        </table>
    </div>
</template>

<script>
    export default {
        name: "StationDropboxList",

        props: {
            station: {
                type: Object,
            },
            colors: {
                type: Array,
            },
            models: {
                type: Array,
            }
        },

        data() {
            return {
                dropboxes: this.station.dropboxes
            }
        },

        methods: {
            handleSucceed(dropboxLog, index) {
                this.dropboxes[index].active_log_id = dropboxLog.id
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
