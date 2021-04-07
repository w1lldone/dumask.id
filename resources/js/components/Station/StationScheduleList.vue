<template>
    <div class="d-flex flex-column">
        <div class="d-flex my-2" v-for="(schedules, index) in schedules" :key="schedules.id">
            <div class="col-2">
                {{ days[schedules.day] }}
            </div>
            <div class="col-2">
                {{ schedules.opened_at }}
            </div>
            <div class="col-2">
                {{ schedules.closed_at }}
            </div>
            <div class="col-6 d-flex">
                <div class="mx-2">
                    <schedule-edit-modal :schedule="schedules" @updated="handleUpdated(index, $event)"></schedule-edit-modal>
                </div>
                <div class="mx-2">
                    <schedule-delete-modal :schedule="schedules" @deleted="handleDeleted(index)"></schedule-delete-modal>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import dayOfWeeks from '../../mixins/dayOfWeeks';

    export default {
        name: "StationScheduleList",

        mixins: [dayOfWeeks],

        props: {
            station: {
                type: Object,
            },
        },

        data() {
            return {
                schedules: this.station.schedules
            }
        },

        methods: {
            handleDeleted(index) {
                this.schedules.splice(index, 1)
            },
            handleUpdated(index, schedule) {
                this.schedules.splice(index, 1, schedule)
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>