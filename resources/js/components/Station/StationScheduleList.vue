<template>
    <div class="d-flex flex-column">
        <div class="d-flex my-2" v-for="(schedules) in station.schedules" :key="schedules.id">
            <div class="col-2">
                {{ schedules.day }}
            </div>
            <div class="col-2">
                {{ schedules.opened_at }}
            </div>
            <div class="col-2">
                {{ schedules.closed_at }}
            </div>
            <div class="col-6 d-flex">
                <div class="mx-2">
                    <schedule-edit-modal :schedule="schedules"></schedule-edit-modal>
                </div>
                <div class="mx-2">
                    <schedule-delete-modal :schedule="schedules"></schedule-delete-modal>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "StationScheduleList",

        props: {
            station: {
                type: Object,
            },
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