<template>
  <div>
    <div class="d-flex my-2" v-for="(schedules, index) in sortedSchedules" :key="schedules.id">
      <div class="col-4 my-auto text-secondary font-weight-bold">{{ days[schedules.day] }}</div>
      <div class="col-4 my-auto">{{ schedules.summary }}</div>
      <div class="col-4 d-flex align-middle">
          <schedule-edit-modal
            class="mx-1"
            :schedule="schedules"
            @updated="handleUpdated(index, $event)"
          ></schedule-edit-modal>
          <schedule-delete-modal
            class="mx-1"
            :schedule="schedules"
            @deleted="handleDeleted(index)"
          ></schedule-delete-modal>
      </div>
    </div>
    <div class="d-flex">
      <div class="col-12">
        <schedule-create-modal :station="station" @created="handleCreated($event)"></schedule-create-modal>
      </div>
    </div>
  </div>
</template>

<script>
import dayOfWeeks from "../../mixins/dayOfWeeks";
import ScheduleCreateModal from "../Schedule/ScheduleCreateModal.vue";

export default {
  components: { ScheduleCreateModal },
  name: "StationScheduleList",

  mixins: [dayOfWeeks],

  props: {
    station: {
      type: Object,
    },
  },

  data() {
    return {
      schedules: this.station.schedules,
    };
  },

  methods: {
    handleDeleted(index) {
      this.schedules.splice(index, 1);
    },
    handleUpdated(index, schedule) {
      this.schedules.splice(index, 1, schedule);
    },
    handleCreated(schedule) {
        this.schedules.push(schedule)
    },
    
    getScheduleSummary(schedule) {
        var days = dayOfWeeks.computed.days()
        var summary = "Buka Hari Ini"

        for (let i = 0; i < days.length; i++) {
            // Cari hari
            if (schedule.day == i) {
                if (schedule.opened_at && schedule.closed_at) {
                    summary = schedule.opened_at + " - " + schedule.closed_at
                } else {
                    summary = "Tutup"
                }
            }
        }
        return summary
    },
  },

  computed: {
    sortedSchedules() {        
        var days = dayOfWeeks.computed.days()
        var schedules = this.schedules
        var sortedSchedules = []

        for (let i = 0; i < schedules.length; i++) {
          for (let j = 0; j < days.length; j++) {
            if (schedules[i].day == j) {
              schedules[i].summary = this.getScheduleSummary(schedules[i])
              sortedSchedules.push(schedules[i]);
            }
          }
        }
        return sortedSchedules
    }
  },

};
</script>

<style lang="scss" scoped>
</style>
