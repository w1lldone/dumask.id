<template>
    <div>
        <div class="row my-4" v-for="(dropboxes) in station.dropboxes" :key="dropboxes.id">
            <div class="col-md-3">
                {{ dropboxes.color }}
            </div>
            <div class="col-md-3">
                {{ dropboxes.model }}
            </div>
            <div class="col-md-3">
                <dropbox-edit-modal :dropbox="dropboxes" :colors='colors' :models='models'></dropbox-edit-modal>
            </div>
            <div class="col-md-3">
                <dropbox-delete-modal :dropbox="dropboxes"></dropbox-delete-modal>
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
               
            }
        },

        methods: {
        },
    }
</script>

<style lang="scss" scoped>

</style>