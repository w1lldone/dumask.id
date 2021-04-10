<template>
    <div>
        <a class="d-flex flex-row nav-link px-0" data-toggle="collapse" href="#station-schedule" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="mdi mdi-clock-outline text-secondary font-weight-bold"></span>
            <span v-if="isNowOpen()" class="text-secondary font-weight-bold align-middle ml-2">
                Buka Sekarang
            </span>
            <span v-else class="text-danger font-weight-bold align-middle ml-2">
                Tutup
            </span>
            <span class="mdi mdi-chevron-down text-secondary font-weight-bold ml-auto"></span>
        </a>
        <div class="collapse" id="station-schedule">
            <div class="card card-body px-3 py-1">
                <div
                    v-for="(schedule, index) in sortedSchedules"
                    :key="index"
                    class="d-flex px-2 my-1"
                >
                    <div class="col-3 px-0">
                        {{ schedule.day }}
                    </div>
                    <div v-if="schedule.open_hour == 'Tutup'" class="col-9 text-danger px-0">
                        {{ schedule.open_hour }}
                    </div>
                    <div v-else class="col-9 px-0">
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
        getOpenHourOnDay(day) {
            var openHour = "Buka Hari Ini"
            for (let i = 0; i < this.schedules.length; i++) {
                // Cari hari
                if (this.schedules[i].day == day) {
                    if (this.schedules[i].opened_at && this.schedules[i].closed_at) {
                        openHour = this.schedules[i].opened_at + " - " + this.schedules[i].closed_at
                    } else {
                        openHour = "Tutup"
                    }
                }
            }
            return openHour
        },

        getTodaySchedule(){
            var date = new Date()
            var today = date.getDay()

            var todaySchedule = {}

            for (let i = 0; i < this.schedules.length; i++) {
                // Cari hari
                if (this.schedules[i].day == today) {
                    if (this.schedules[i].opened_at && this.schedules[i].closed_at) {
                        // Split jam & menit
                        var openTime = this.schedules[i].opened_at.split(':')
                        var closeTime = this.schedules[i].closed_at.split(':')

                        var open = new Date()
                        open.setHours(openTime[0], openTime[1], 0)

                        var close = new Date()
                        close.setHours(closeTime[0], closeTime[1], 0)

                        todaySchedule.open = open
                        todaySchedule.close = close
                        break
                    }
                }
            }
            return todaySchedule
        },

        isNowOpen() {
            var schedule = this.sortedSchedules[0]

            var now = new Date()
            var nowOpen
            
            if (schedule.open_hour == "Buka Hari Ini") {
                nowOpen = true
            } else if (schedule.open_hour == "Tutup") {
                nowOpen = false
            } else {
                var todaySchedule = this.getTodaySchedule()
                if (now >= todaySchedule.open && now < todaySchedule.close ) {
                    nowOpen = true
                }
                else {
                    nowOpen = false
                }
            }
            
            return nowOpen
        },
    },

    computed: {
        sortedSchedules() {
            var date = new Date()
            var today = date.getDay()
            
            var days = dayOfWeeks.computed.days()
            var sortedSchedules = []

            // Today ... Sabtu
            for(let i = today; i < days.length; i++) {
                var schedule = new Object()

                schedule.day = days[i]
                schedule.open_hour = this.getOpenHourOnDay(i)
                
                sortedSchedules.push(schedule)
            }

            // Minggu ... today-1
            for(let i = 0; i < today; i++) {
                var schedule = new Object()

                schedule.day = days[i]
                schedule.open_hour = this.getOpenHourOnDay(i)
                
                sortedSchedules.push(schedule)
            }


            return sortedSchedules
        }
        
    },
}

</script>

<style lang="sass" scoped>

</style>