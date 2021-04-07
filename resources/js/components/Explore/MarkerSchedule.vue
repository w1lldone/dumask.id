<template>
    <div>
        <a class="d-flex flex-row nav-link px-0" data-toggle="collapse" href="#station-schedule" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="mdi mdi-clock-outline text-secondary font-weight-bold"></span>
            <span class="text-secondary font-weight-bold align-middle ml-2">07.00 - 20.00 WIB</span>
            <span class="mdi mdi-chevron-down text-secondary font-weight-bold ml-auto"></span>
        </a>
        <div class="collapse" id="station-schedule">
            <div class="card card-body px-3 py-1">
                <div
                    v-for="(day, index) in days"
                    :key="day"
                    :value="index"
                    class="d-flex my-1"
                >
                    <div class="col-3">
                        {{ day }}
                    </div>
                    <div class="col-9" v-if="sortedSchedules[index]">
                        <span v-if="sortedSchedules[index].opened_at && sortedSchedules[index].closed_at">
                            {{ sortedSchedules[index].opened_at }} - {{ sortedSchedules[index].closed_at }}
                        </span>
                        <span v-else>
                            Buka hari ini
                        </span>
                    </div>
                    <div class="col-9 text-danger" v-else>
                        Tutup
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import dayOfWeeks from '../../mixins/dayOfWeeks';

export default {
    name: "MarkerSchedule",

    mixins: [dayOfWeeks],

    props: {
        schedules: {
            type: Array
        },
    },

    computed: {
        sortedSchedules() {
            return _.orderBy(this.schedules, 'day')
        },
    },
}
</script>

<style lang="sass" scoped>

</style>