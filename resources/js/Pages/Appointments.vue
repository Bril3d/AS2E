<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

export default {
  components: {
    FullCalendar, // make the <FullCalendar> tag available
    AuthenticatedLayout
  },
  data() {
    return {
      calendarOptions: {
        plugins: [
          dayGridPlugin,
          timeGridPlugin,
          interactionPlugin 
        ],
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth', 
        editable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        weekends: true,
        select: this.handleDateSelect,
        eventClick: this.handleEventClick,
        eventsSet: this.handleEvents
        /* you can update a remote database when these fire:
        eventAdd:
        eventChange:
        eventRemove:
        */
      },
    }
  },
  methods: {
    toggleWeekends: function () {
      this.calendarOptions.weekends = !this.calendarOptions.weekends
    }
  }
}
</script>
<template>
  <AuthenticatedLayout>
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <button @click="toggleWeekends">toggle weekends</button>
      <FullCalendar :options="calendarOptions" />
    </div>
  </AuthenticatedLayout>
</template>