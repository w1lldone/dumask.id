<template>
    <div>
        <a class="d-flex flex-row nav-link px-0" data-toggle="collapse" href="#station-schedule" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="mdi mdi-clock-outline text-secondary font-weight-bold"></span>
            <span v-if="getNow().isOpen" class="text-secondary font-weight-bold align-middle ml-2">
                Buka Sekarang
            </span>
            <span v-else class="text-danger font-weight-bold align-middle ml-2">
                Tutup
            </span>
            <span class="text-primary align-middle ml-3">
                {{ getNow().nextOpen }}
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
                    <div v-if="schedule.summary == 'Tutup'" class="col-9 text-danger px-0">
                        {{ schedule.summary }}
                    </div>
                    <div v-else class="col-9 px-0">
                        {{ schedule.summary }}
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
        getScheduleOnDay(schedule, day) {
            schedule.opened_at = ""
            schedule.closed_at = ""
            schedule.summary = "Buka Hari Ini"

            for (let i = 0; i < this.schedules.length; i++) {
                // Cari hari
                if (this.schedules[i].day == day) {
                    if (this.schedules[i].opened_at && this.schedules[i].closed_at) {
                        schedule.opened_at = this.schedules[i].opened_at
                        schedule.closed_at = this.schedules[i].closed_at
                        schedule.summary = this.schedules[i].opened_at + " - " + this.schedules[i].closed_at
                    } else {
                        schedule.summary = "Tutup"
                    }
                }
            }
            return schedule
        },

        getNow() {
            var today = this.sortedSchedules[0]

            var now = new Date()
            var getNow = {}
            
            if (today.summary == "Buka Hari Ini") {
                getNow.isOpen = true
                getNow.nextOpen = today.summary
            } else if (today.summary == "Tutup") {
                getNow.isOpen = false
                getNow.nextOpen = this.nextOpen()
            } else {
                var openTime = today.opened_at.split(':')
                var closeTime = today.closed_at.split(':')

                var openHour = new Date()
                openHour.setHours(openTime[0], openTime[1], 0)

                var closeHour = new Date()
                closeHour.setHours(closeTime[0], closeTime[1], 0)

                // Belum buka
                if (now < openHour) {
                    getNow.isOpen = false
                    getNow.nextOpen = "Buka: " + today.summary
                } else
                // Sedang Buka
                    if (now >= openHour && now < closeHour ) {
                        getNow.isOpen = true
                        getNow.nextOpen = "(" + today.summary + ")"
                    }
                    // Sudah Tutup
                    else {
                        getNow.isOpen = false
                        getNow.nextOpen = this.nextOpen()
                    }
            }
            
            return getNow
        },

        nextOpen() {
            var scheduleList = this.sortedSchedules

            for (let i = 1; i < scheduleList.length; i++) {
                if (scheduleList[i].summary == "Buka Hari Ini") {
                    return "Buka: " + scheduleList[i].day
                }
                if (scheduleList[i].summary != "Buka Hari Ini" && scheduleList[i].summary != "Tutup") {
                     return "Buka: " + scheduleList[i].day + " (" + scheduleList[i].summary + ")"
                }
            }
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
                this.getScheduleOnDay(schedule, i)
                
                sortedSchedules.push(schedule)
            }

            // Minggu ... today-1
            for(let i = 0; i < today; i++) {
                var schedule = new Object()

                schedule.day = days[i]
                this.getScheduleOnDay(schedule, i)
                
                sortedSchedules.push(schedule)
            }

            return sortedSchedules
        }
        
    },
}

</script>

<style lang="sass" scoped>

</style>