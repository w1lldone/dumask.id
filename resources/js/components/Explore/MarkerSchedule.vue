<template>
    <div>
        <a class="d-flex flex-row nav-link px-0" data-toggle="collapse" href="#station-schedule" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="mdi mdi-clock-outline text-secondary font-weight-bold"></span>
            <span class="text-secondary font-weight-bold align-middle ml-2">07.00 - 20.00 WIB</span>
            <span class="mdi mdi-chevron-down text-secondary font-weight-bold ml-auto"></span>
        </a>
        <div class="collapse" id="station-schedule">
            <div class="card card-body px-3 py-1">
                <!-- <div
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
                </div> -->

                <div
                    v-for="(schedule, index) in sortedSchedules"
                    :key="index"
                    class="d-flex row my-1"
                >
                    <div class="col-3">
                        {{ schedule.day }}
                    </div>
                    <div class="col-9">
                        {{ schedule.open_hour }}
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

    methods: {
        getToday() {
            d = new Date();
            var n = d.getDay();
            return n
        }
    },

    methods: {
        getOpenHourOnDay(i){
            var openHour = ""

            if (this.schedules[i].opened_at && this.schedules[i].closed_at) {
                openHour = this.schedules[i].opened_at + " - " + this.schedules[i].closed_at
            } else {
                openHour = "Buka Hari Ini"
            }

            return openHour
        },
    },

    computed: {
        sortedSchedules() {
            var date = new Date()
            var today = date.getDay()
            
            var days = dayOfWeeks.computed.days()
            var sortedSchedules = []

            // Today ... Sabtu
            for(var i = today; i < days.length; i++) {
                var schedule = new Object()
                // Nama hari
                schedule.day = days[i]
                // Ada jadwal hari
                if (this.schedules.length > i) {
                    schedule.open_hour = this.getOpenHourOnDay(i)
                }
                // Tidak ada jadwal hari
                else{
                    schedule.open_hour = "Tutup"
                }

                sortedSchedules.push(schedule)
            }

            // Minggu ... today-1
            for(var i = 0; i < today; i++) {
                var schedule = new Object()
                // Nama hari
                schedule.day = days[i]
                // Ada jadwal hari
                if (this.schedules.length > i) {
                    schedule.open_hour = this.getOpenHourOnDay(i)
                }
                // Tidak ada jadwal hari
                else{
                    schedule.open_hour = "Tutup"
                }

                sortedSchedules.push(schedule)
            }


            return sortedSchedules
        }
        
    },
}

</script>

<style lang="sass" scoped>

</style>