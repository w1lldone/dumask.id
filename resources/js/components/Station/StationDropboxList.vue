<template>
    <div>
        <div class="row my-4" v-for="(dropbox, index) in dropboxes" :key="dropbox.id">
            <div class="col-md-3">
                box {{ dropbox.color }}-{{ dropbox.model }}
            </div>
            <div class="col-md-6">
                <dropbox-replace @succeed="handleSucceed($event, index)" class="d-inline" :dropbox="dropbox"></dropbox-replace>
                <dropbox-inspect v-if="dropbox.active_log_id" class="d-inline" :dropbox="dropbox"></dropbox-inspect>
            </div>
            <div class="col-md-3">
                <dropbox-edit-modal :dropbox="dropbox" :colors='colors' :models='models' class="d-inline"></dropbox-edit-modal>
                <dropbox-delete-modal :dropbox="dropbox" class="d-inline"></dropbox-delete-modal>
            </div>
        </div>
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
