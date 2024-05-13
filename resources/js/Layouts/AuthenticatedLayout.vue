<script setup>
import { onMounted } from 'vue';
import { Link, usePage, Head } from '@inertiajs/vue3';
import { AnOutlinedDashboard, AnOutlinedUser, ClUsers, BxPackage, BxLogOut, AkCalendar, CgUserAdd, CgUserList, CaSettings, IcMediaImageFolder, ByFeed, FaRegComments, CgFeed, CaSaveModel, PhArticleNyTimes } from "@kalimahapps/vue-icons";
import ApplicationLogo from "../Components/ApplicationLogo.vue";
import DarkModeSwitcher from "@/Components/DarkModeSwitcher.vue";
import { usePermission } from '@/Composables/permissions';

const { hasRole, hasRoles } = usePermission();

function onPage(component) {
    return usePage().component === component
}

const props = defineProps({
    title: String
})

const appName = usePage().props.settings.app_name;

onMounted(() => {
    window.HSStaticMethods.autoInit()
});

</script>

<template>

    <Head>
        <meta name="description" content="Admin Dashboard to access and analyze all data around the as2e website">
    </Head>
    <div class="bg-gray-50 dark:bg-slate-900">
        <!-- ========== HEADER ========== -->
        <header
            class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-[48] w-full bg-white border-b text-sm py-2.5 sm:py-4 lg:ps-64 dark:bg-gray-800 dark:border-gray-700">
            <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6 md:px-8" aria-label="Global">
                <div class="me-5 lg:me-0 lg:hidden">
                    <Link class="flex-none text-xl font-semibold dark:text-white" href="/" aria-label="AS2E">{{ appName
                    }}</Link>
                </div>

                <div class="w-full flex items-center justify-end ms-auto sm:gap-x-3 sm:order-3">


                    <div class="flex flex-row items-center justify-end gap-2">
                        <DarkModeSwitcher />
                        <button type="button"
                            class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                            </svg>
                        </button>
                        <button type="button"
                            class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            data-hs-offcanvas="#hs-offcanvas-right">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                            </svg>
                        </button>

                        <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                            <button id="hs-dropdown-with-header" type="button"
                                class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                <img class="inline-block size-[38px] rounded-full ring-2 ring-white dark:ring-gray-800 object-cover"
                                    :src="$page.props.auth.user.avatar" alt="My Avatar">
                            </button>

                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 dark:bg-gray-800 dark:border dark:border-gray-700"
                                aria-labelledby="hs-dropdown-with-header">
                                <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg dark:bg-gray-700">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Signed in as</p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-300">{{
                                        $page.props.auth.user.name }}</p>
                                </div>
                                <div class="mt-2 py-2 first:pt-0 last:pb-0">
                                    <Link
                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        :href="route('feed.list')">
                                    <CgFeed />
                                    Feed
                                    </Link>
                                    <Link
                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        :href="route('posts.saved')">
                                    <CaSaveModel />
                                    Saved Posts
                                    </Link>
                                    <Link
                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        :href="route('profile.edit')">
                                    <AnOutlinedUser />
                                    Profile
                                    </Link>
                                    <Link
                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 w-full"
                                        :href="route('logout')" method="post" as="button">
                                    <BxLogOut class="size-4" />
                                    Logout
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <!-- ========== END HEADER ========== -->

        <!-- ========== MAIN CONTENT ========== -->
        <!-- Sidebar Toggle -->
        <div
            class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 md:px-8 lg:hidden dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center py-4">
                <!-- Navigation Toggle -->
                <button type="button" class="text-gray-500 hover:text-gray-600" data-hs-overlay="#application-sidebar"
                    aria-controls="application-sidebar" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle Navigation</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>
                </button>
                <!-- End Navigation Toggle -->

                <!-- Breadcrumb -->
                <ol class="ms-3 flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                    <li class="flex items-center text-sm text-gray-800 dark:text-gray-400">
                        Dashboard
                        <svg class="flex-shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-gray-600"
                            width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </li>
                    <li class="text-sm font-semibold text-gray-800 truncate dark:text-gray-400" aria-current="page">
                        {{ $page.component }}
                    </li>
                </ol>
                <!-- End Breadcrumb -->
            </div>
        </div>
        <!-- End Sidebar Toggle -->

        <!-- Sidebar -->
        <div id="application-sidebar"
            class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden fixed top-0 start-0 bottom-0 z-[60] w-64 bg-white border-e border-gray-200 pt-7 pb-10 overflow-y-auto lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-6">
                <Link
                    class="flex-none text-xl font-semibold dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="/" aria-label="AS2E">
                <ApplicationLogo class="mx-auto" />
                </Link>
            </div>

            <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                <ul class="space-y-1.5">
                    <li>
                        <Link
                            :class="onPage('Dashboard/Leaders') ? 'bg-gray-100  dark:hover:bg-gray-600 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600' : 'hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'"
                            class="w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg text-slate-700 "
                            :href="route('dashboard.index')">
                        <AnOutlinedDashboard class="w-4 h-4" />
                        Dashboard
                        </Link>
                    </li>

                    <li v-if="hasRole('admin')">
                        <Link as="button" :href="route('users.index')"
                            :class="onPage('Users/Users') ? 'bg-gray-100  dark:hover:bg-gray-600 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600' : 'hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'"
                            class="w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg text-slate-700 ">
                        <ClUsers class="w-4 h-4" />
                        Users
                        </Link>
                    </li>
                    <li v-if="hasRole('admin')">
                        <Link as="button" :href="route('roles.index')"
                            :class="onPage('Roles/Roles') ? 'bg-gray-100  dark:hover:bg-gray-600 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600' : 'hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'"
                            class="w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg text-slate-700 ">
                        <CgUserAdd class="w-4 h-4" />
                        Roles
                        </Link>
                    </li>
                    <li v-if="hasRole('admin')">
                        <Link as="button" :href="route('permissions.index')"
                            :class="onPage('Permissions/Permissions') ? 'bg-gray-100  dark:hover:bg-gray-600 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600' : 'hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'"
                            class="w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg text-slate-700 ">
                        <CgUserList class="w-4 h-4" />
                        Permissions
                        </Link>
                    </li>
                    <li>
                        <Link as="button" :href="route('posts.index')"
                            :class="onPage('Posts/Posts') ? 'bg-gray-100  dark:hover:bg-gray-600 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600' : 'hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'"
                            class="w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg text-slate-700 ">
                        <ByFeed class="w-4 h-4" />
                        Posts
                        </Link>
                    </li>
                    <li>
                        <Link as="button" :href="route('comments.index')"
                            :class="onPage('Comments/Comments') ? 'bg-gray-100  dark:hover:bg-gray-600 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600' : 'hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'"
                            class="w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg text-slate-700 ">
                        <FaRegComments class="w-4 h-4" />
                        Comments
                        </Link>
                    </li>
                    <li v-if="hasRoles(['admin', 'moderator'])">
                        <Link as="button" :href="route('expertises.index')"
                            :class="onPage('Expertises/Index') ? 'bg-gray-100  dark:hover:bg-gray-600 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600' : 'hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'"
                            class="w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg text-slate-700 ">
                        <PhArticleNyTimes class="w-4 h-4" />
                        Expertises
                        </Link>
                    </li>
                    <li v-if="hasRoles(['admin', 'moderator'])">
                        <Link as="button" :href="route('projects.index')"
                            :class="onPage('Projects/Index') ? 'bg-gray-100  dark:hover:bg-gray-600 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600' : 'hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'"
                            class="w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg text-slate-700 ">
                        <BxPackage class="w-4 h-4" />
                        Projects
                        </Link>
                    </li>
                    <li v-if="hasRoles(['admin', 'moderator'])">
                        <Link as="button" :href="route('appointments.index')"
                            :class="onPage('Appointments/Appointments') ? 'bg-gray-100  dark:hover:bg-gray-600 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600' : 'hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'"
                            class="w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg text-slate-700 ">
                        <AkCalendar class="w-4 h-4" />
                        Calendar
                        </Link>
                    </li>
                    <li v-if="hasRole('admin')">
                        <Link as="button" :href="route('files.index')"
                            :class="onPage('FileExplorer') ? 'bg-gray-100  dark:hover:bg-gray-600 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600' : 'hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'"
                            class="w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg text-slate-700 ">
                        <IcMediaImageFolder class="w-4 h-4" />
                        File Explorer
                        </Link>
                    </li>
                    <li v-if="hasRole('admin')">
                        <Link as="button" :href="route('settings.index')"
                            :class="onPage('Settings') ? 'bg-gray-100  dark:hover:bg-gray-600 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600' : 'hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'"
                            class="w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg text-slate-700 ">
                        <CaSettings class="w-4 h-4" />
                        Settings
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- End Sidebar -->

        <!-- Content -->
        <div class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:ps-72">
            <!-- Page Heading -->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <transition name="route" mode="out-in" appear>
                        <div :key="$page.url" class="bg-white dark:bg-slate-700 shadow-sm sm:rounded-lg">
                            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                                <div :class="{ 'max-w-2xl mx-auto text-center mb-10 lg:mb-14': title }">
                                    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">{{
                                        title }}
                                    </h2>
                                </div>
                                <slot />
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
            <!-- End Page Heading -->
        </div>
        <!-- End Content -->
        <!-- ========== END MAIN CONTENT ========== -->
    </div>
</template>
