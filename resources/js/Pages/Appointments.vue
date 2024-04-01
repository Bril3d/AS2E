<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AddAppointmentModal from './AddAppointmentModal.vue'
import moment from 'moment'
// import ShowAppointmentModal from './ShowAppointmentModal'
import { router } from '@inertiajs/vue3'
export default {
  components: {
    FullCalendar,
    AuthenticatedLayout,
    AddAppointmentModal
  },
  data() {
    return {
      new_event_modal_open: false,
      event_detail_modal_open: false,
      new_event_details: {
        start: null,
        end: null,
      },
      current_event: null,
      show_event_details_modal: false,
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
        select: this.handleDateClick,
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
    },
    handleDateClick(e) {
      console.log('hi')
      this.new_event_modal_open = true
      this.new_event_start = e.start
      this.new_event_details.start = e.start
      this.new_event_details.end = e.end
    },

    handleEventDrop(e) {
      let updatedEventData = {
        start: e.event.start,
        end: e.event.end
      }
      router.put(`appointments/${e.event.id}`, updatedEventData)
        .then(({ data }) => {
          console.log(data)
        })
        .catch(error => {
          console.log(error)
        })
    },

    handleEventClick(e) {
      this.current_event = e.event
      this.show_event_details_modal = true
    },

    formatDate(date) {
      return moment.utc(date).format('DD/MM/YY HH:mm')
    },

    resetNewEventData() {
      this.new_event_details.start = null
      this.new_event_details.end = null
      this.new_event_details.title = null
      this.new_event_modal_open = false
    },

    newEventCreated() {
      this.rerenderCalendar()
      this.new_event_modal_open = false
      this.resetNewEventData()
      // new Noty({
      //   text: `Appointment has been created.`,
      //   timeout: 1000,
      //   type: 'success'
      // }).show()
    },

    eventResize(e) {
      let updatedEventData = {
        start: e.event.start,
        end: e.event.end
      }
      router.put(`/appointments/${e.event.id}`, updatedEventData)
        .then(({ data }) => {
          console.log(data)

        })
        .catch(error => {
          console.log(error)
        })
    },

    rerenderCalendar() {
      this.$refs.fullCalendar.getApi().refetchEvents()
    }
  }
}
</script>
<template>
  <AuthenticatedLayout>
    <add-appointment-modal :show="new_event_modal_open" :date="new_event_details" @close="resetNewEventData"
      @event-created="newEventCreated" />
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <button @click="toggleWeekends">toggle weekends</button>
      <FullCalendar ref="fullCalendar" class="dark:text-white " :options="calendarOptions" />
    </div>


    <!-- <show-appointment-modal :show="show_event_details_modal" :event="current_event"
      @close="show_event_details_modal = false" @event-deleted="rerenderCalendar" @event-updated="rerenderCalendar" /> -->
  </AuthenticatedLayout>
</template>