<script setup>
import { ref, reactive, onMounted } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue'
import AddAppointmentModal from './Components/AddAppointmentModal.vue'
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

const currentEvent = ref(null)


const handleDateClick = (e) => {
  newEventModalOpen.value = true
  newEventDetails.start = e.start
  newEventDetails.end = e.end
}

const handleEventClick = (e) => {
  console.log(e.event)
  // currentEvent.value = e.event
  // eventDetailModalOpen.value = true
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
})

const toggleWeekends = () => {
  calendarOptions.weekends = !calendarOptions.weekends
}


const handleEventDrop = (e) => {
  const updatedEventData = {
    start: e.event.start,
    end: e.event.end
  }
  router.put(`appointments/${e.event.id}`, updatedEventData)
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

const eventResize = (e) => {
  const updatedEventData = {
    start: e.event.start,
    end: e.event.end
  }
  router.put(`/appointments/${e.event.id}`, updatedEventData)
}

const rerenderCalendar = () => {
  router.get('/appointments');
}

</script>
<template>

  <Head title="Calendar" />
  <AuthenticatedLayout>
    <add-appointment-modal :show="newEventModalOpen" :date="newEventDetails" @close="resetNewEventData"
      @event-created="newEventCreated" :users="props.users" />
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <PrimaryButton @click="toggleWeekends" class="my-6 ">toggle weekends</PrimaryButton>
      <FullCalendar ref="fullCalendar" class="dark:text-white " :options="calendarOptions" />
    </div>
    <!-- <show-appointment-modal :show="eventDetailModalOpen" :event="currentEvent"
      @close="eventDetailModalOpen = false" @event-deleted="rerenderCalendar" @event-updated="rerenderCalendar" /> -->
  </AuthenticatedLayout>
</template>
