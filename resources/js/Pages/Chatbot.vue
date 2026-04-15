<template>

  <Head title="Chatbot" />
  <div>
    <HomeNavbar />
    <NavBar>
      <template #links>
        <Link href="/"
          class="font-semibold dark:text-white hover:text-white text-gray-400 dark:hover:text-gray-300 focus:outline dark:font-outline-1">
        Home
        </Link>

        <Link :href="route('login')"
          class="ms-4 font-semibold dark:text-white hover:text-white text-gray-400 dark:hover:text-gray-300 focus:outline dark:font-outline-1">
        Log in
        </Link>

        <Link :href="route('register')"
          class="ms-4 font-semibold dark:text-white hover:text-white text-gray-400 dark:hover:text-gray-300 focus:outline dark:font-outline-1">
        Register
        </Link>
      </template>
      <template #default>
        <div class="py-20 sm:max-w-2xl mx-auto">
          <!-- Content -->
          <div class="relative h-screen">
            <div class="py-10 lg:py-14">
              <!-- Title -->
              <div class="max-w-4xl px-4 sm:px-6 lg:px-8 mx-auto text-center">
                <ApplicationLogo class="w-24 mx-auto my-3" />

                <h1 class="text-3xl font-bold text-gray-800 sm:text-4xl dark:text-white">
                  Welcome to {{ botSettings.bot_name }} AI
                </h1>
                <p class="mt-3 text-gray-600 dark:text-neutral-400">
                  {{ botSettings.bot_name }} AI is your personal AI-powered assistant, designed to help you navigate information and provide
                  assistance in a seamless, user-friendly manner.
                </p>
              </div>
              <!-- End Title -->

              <ul ref="chatContainer" class="mt-16 space-y-5">
                <li v-for="(msg, index) in messages" :key="index"
                  class="max-w-4xl py-2 px-4 sm:px-6 lg:px-8 mx-auto flex gap-x-2 sm:gap-x-4">
                  <div v-if="msg.type === 'user'" class="space-y-3">
                    <div class="flex items-center gap-3">
                      <span
                        class="flex-shrink-0 inline-flex items-center justify-center size-[38px] rounded-full bg-gray-600">
                        <img :src="$page.props.auth.user?.avatar" v-if="$page.props.auth.user?.avatar" />
                        <span v-else class="text-sm font-medium text-white leading-none">AZ</span>
                      </span>
                      <h2 class="font-medium text-gray-800 dark:text-white capitalize">{{ $page.props.auth.user?.name ?
                        $page.props.auth.user?.name : 'User' }}</h2>
                    </div>

                    <div class="space-y-3">
                      <p class="text-gray-800 dark:text-neutral-200">{{ msg.text }}</p>
                    </div>
                  </div>
                  <div v-if="msg.type === 'bot'" class="space-y-3">
                    <div class="flex items-center gap-3">
                      <div class="size-10 rounded-full shadow">
                        <ApplicationLogo class="pt-1" />
                      </div>
                      <h2 class="font-medium text-gray-800 dark:text-white">{{ botSettings.bot_name }}:</h2>
                    </div>
                    <div class="space-y-3">
                      <p class="text-gray-800 dark:text-neutral-200" v-html="msg.text"></p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>

            <!-- Search -->
            <footer
              class="sticky bottom-0 z-10 bg-white border-t border-gray-200 pt-2 pb-3 sm:pt-4 sm:pb-6 dark:bg-neutral-900 dark:border-neutral-700">
              <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Input -->
                <div class="relative">
                  <textarea
                    class="p-4 pb-12 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Ask me anything..." required v-model="message" @keyup.enter="sendMessage"></textarea>
                  <!-- Toolbar -->
                  <div class="p-2 rounded-b-md bg-white dark:bg-neutral-900">
                    <!-- Button Group -->
                    <div class="flex justify-end">
                      <!-- Send Button -->
                      <button type="button" @click="sendMessage"
                        class="inline-flex flex-shrink-0 justify-center items-center size-8 rounded-lg text-white bg-blue-600 hover:bg-blue-500 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                          fill="currentColor" viewBox="0 0 16 16">
                          <path
                            d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                        </svg>
                      </button>
                      <!-- End Send Button -->
                    </div>
                  </div>
                  <!-- End Toolbar -->
                </div>
                <!-- End Input -->
              </div>
            </footer>
            <!-- End Search -->
          </div>
          <!-- End Content -->
        </div>
      </template>
    </NavBar>
  </div>
</template>


<script setup>
import { onMounted, ref, nextTick } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import NavBar from '@/Components/Navbar.vue';
import HomeNavbar from '@/Components/HomeNavbar.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import axios from 'axios';

const props = defineProps({
    botSettings: Object
});

const message = ref('');
const messages = ref([{ type: 'bot', text: props.botSettings.welcome_message.replace(/\n/g, '<br>') }]);


const scrollToBottom = () => {
  window.scrollTo({
    top: document.documentElement.scrollHeight,
    behavior: 'smooth'
  });
};

const sendMessage = () => {
  if (message.value.trim() === '') return;

  messages.value.push({ type: 'user', text: message.value });

  axios.post('/chatbot', { message: message.value }).then((response) => {
    let { data } = response;

    const formattedData = data.replace(/\n/g, '<br>');

    messages.value.push({ type: 'bot', text: formattedData });
    
    nextTick(() => {
      scrollToBottom();
    });
  });

  message.value = '';
}

onMounted(() => {
  window.HSStaticMethods.autoInit();
});
</script>
