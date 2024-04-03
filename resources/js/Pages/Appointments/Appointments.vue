<script setup>
import { ref, reactive } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import AddAppointmentModal from './Components/AddAppointmentModal.vue'
import ShowAppointmentModal from './Components/ShowAppointmentModal.vue'
import moment from 'moment'
import { router, Head } from '@inertiajs/vue3'



const props = defineProps({
  events: {
    type: Object,
    required: true
  },
  users: {
    type: Object,
    required: true
  }
})

const newEventModalOpen = ref(false)
const eventDetailModalOpen = ref(false)
const newEventDetails = reactive({
  start: null,
  end: null,
})

const currentEvent = ref({})


const handleDateClick = (e) => {
  newEventModalOpen.value = true
  newEventDetails.start = e.start
  newEventDetails.end = e.end
}

const handleEventClick = (e) => {
  currentEvent.value = e.event;
  eventDetailModalOpen.value = true;
};


const formatDate = (date, format = 'YYYY-MM-DD HH:mm:ss') => {
  return moment(date).format(format)
}

const handleEventDrop = (e) => {
  const updatedEventData = {
    start: formatDate(e.event.start),
    end: formatDate(e.event.end)
  }
  router.put(`appointments/${e.event.id}`, updatedEventData)
}

const eventResize = (e) => {
  const updatedEventData = {
    start: formatDate(e.event.start),
    end: formatDate(e.event.end)
  }
  router.put(`/appointments/${e.event.id}`, updatedEventData)
}

const calendarOptions = reactive({
  plugins: [
    dayGridPlugin,
    timeGridPlugin,
    interactionPlugin
  ],
  events: props.events,
  headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: 'dayGridMonth,timeGridWeek,timeGridDay'
  },
  buttonText: {
    today: 'Today',
    month: 'Month',
    week: 'Week',
    day: 'Day',
  },
  initialView: 'dayGridMonth',
  editable: true,
  selectable: true,
  selectMirror: true,
  dayMaxEvents: true,
  weekends: true,
  longPressDelay: 0,
  select: handleDateClick,
  eventClick: handleEventClick,
  eventDrop: handleEventDrop,
  eventResize: eventResize
})

const toggleWeekends = () => {
  calendarOptions.weekends = !calendarOptions.weekends
}

const resetNewEventData = () => {
  newEventDetails.title = null
  newEventDetails.start = null
  newEventDetails.end = null
  newEventModalOpen.value = false
}

const newEventCreated = () => {
  rerenderCalendar()
  resetNewEventData()
}

const rerenderCalendar = () => {
  router.get('/appointments');
}

</script>
<template>

  <Head title="Calendar" />

  <AuthenticatedLayout title="Calendar">
    <PrimaryButton @click="toggleWeekends" class="my-6 ">toggle weekends</PrimaryButton>
    <FullCalendar ref="fullCalendar" class="dark:text-white" :options="calendarOptions" />
    <add-appointment-modal :show="newEventModalOpen" :date="newEventDetails" @close="resetNewEventData"
      @event-created="newEventCreated" :users="props.users" />
    <show-appointment-modal v-if="eventDetailModalOpen" :show="eventDetailModalOpen" :appointment="currentEvent"
      @close="eventDetailModalOpen = false" @appointment-deleted="rerenderCalendar"
      @appointment-updated="rerenderCalendar" :users="props.users" />
  </AuthenticatedLayout>
</template>
