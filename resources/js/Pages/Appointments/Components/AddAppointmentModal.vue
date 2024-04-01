<template>
  <Teleport to="body">
    <div v-if="show" class="backdrop"></div>
    <transition name="route">
      <div v-if="show" @click.self="closeModal"
        class="block w-full h-full fixed top-0 left-0 overflow-x-hidden overflow-y-auto z-[61]">
        <div class="duration-500 mt-7 opacity-100 ease-out transition-all md:max-w-2xl md:w-full m-3 md:mx-auto">
          <div class="flex flex-col border shadow-sm rounded-xl bg-gray-50 border-gray-300 shadow-slate-700/[.7]">
            <div class="p-4 overflow-y-auto">
              <div class="w-full bg-white rounded-md">
                <div class="relative bg-white rounded-lg w-full">
                  <div class="flex items-center justify-between px-4 py-2 border-b border-gray-200">
                    <h5 class="text-lg font-semibold">New Appointment</h5>
                    <button type="button" class="text-gray-600 hover:text-gray-800 focus:outline-none"
                      @click="closeModal" aria-label="Close">
                      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                      </svg>
                    </button>
                  </div>
                  <div class="flex flex-col gap-2 p-4">
                    <div class="mb-2">
                      <div class="flex items-center border border-gray-300 rounded-lg">
                        <div class="p-2 bg-gray-200 rounded-l-lg">
                          <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                          </svg>
                        </div>
                        <input type="text" class="w-full py-2 px-4 focus:outline-none" v-model="event.title"
                          placeholder="Add title ..." ref="eventTitle" autofocus>
                      </div>
                    </div>
                    <div class="mb-2 flex items-center">
                      <svg class="h-6 w-6 text-gray-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                      </svg>
                      {{ formatDate(date.start) }}
                    </div>
                    <div v-if="users.length > 0" class="mb-2">
                      <div class="flex items-center border-main border-2 rounded-lg">
                        <div class="p-2 bg-gray-200 rounded-l-lg">
                          <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                          </svg>
                        </div>
                        <select class="focus:outline-none focus:border-none border-none w-full"
                          v-model="event.assignee">
                          <option disabled selected value="0">Assign to:</option>
                          <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="mb-2">
                      <textarea class="w-full py-2 px-4 focus:ring-main-dark rounded-lg border-main border-2"
                        id="appointmentNote" rows="3" v-model="event.description"
                        placeholder="Description ..."></textarea>
                    </div>
                  </div>

                  <div class="flex items-center gap-2 justify-end px-4 py-2 border-t border-gray-200">
                    <DangerButton @click="closeModal">Close</DangerButton>
                    <PrimaryButton @click="saveEvent" :disabled="!validEventData">Create</PrimaryButton>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>

  </Teleport>
</template>

<script setup>
import { reactive } from 'vue'
import moment from 'moment'
import { router } from '@inertiajs/vue3';

const props = defineProps({
  show: {
    type: Boolean,
    required: false
  },
  date: {
    type: Object,
    required: true
  },
  users: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['close', 'event-created'])

const closeModal = () => {
  emit('close');
}

const event = reactive({
  title: null,
  assignee: 0,
  description: null
})

const formatDate = (date, format = 'DD/MM/YY HH:mm') => {
  return moment(date).format(format)
}

const saveEvent = () => {
  let newEventData = {
    start: props.date.start,
    end: props.date.end,
    title: event.title,
    assignee: event.assignee,
    description: event.description
  }

  router.post('/appointments/new', newEventData, {
    onSuccess: () => {
      emit('event-created')
    }
  })
}

const validEventData = () => {
  return true
}
</script>

<style>
.backdrop {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.75);
  z-index: 60;
}
</style>
