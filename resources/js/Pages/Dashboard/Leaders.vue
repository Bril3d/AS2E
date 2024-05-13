<script setup>
import { Head } from '@inertiajs/vue3';
import { ClUsers, BxPackage, BsPostcardHeart, AkCalendar } from "@kalimahapps/vue-icons";
import StatsCard from '@/Components/StatsCard.vue';
import BarChart from '@/Components/BarChart.vue';
import LineChart from '@/Components/LineChart.vue';
import PieChart from '@/Components/PieChart.vue';

const props = defineProps({
    stats: {
        type: Object,
        required: true,
    },
    charts: {
        type: Object,
        required: true,
    },
})
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout title="Stats">
        <div class="space-y-7">
            <!-- Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <!-- Card -->
                <StatsCard header="Total Users" tooltip="The number of daily users" :number="stats.users">
                    <ClUsers class="text-gray-600 dark:text-gray-400 size-5" />
                </StatsCard>
                <!-- End Card -->

                <!-- Card -->
                <StatsCard header="Total Projects" tooltip="The number of projects" :number="stats.projects">
                    <BxPackage class="text-gray-600 dark:text-gray-400 size-5" />
                </StatsCard>
                <!-- End Card -->

                <!-- Card -->
                <StatsCard header="Total Posts" tooltip="The number of posts" :number="stats.posts">
                    <BsPostcardHeart class="text-gray-600 dark:text-gray-400 size-5" />
                </StatsCard>
                <!-- End Card -->

                <!-- Card -->
                <StatsCard header="Upcoming Dates" tooltip="The number of upcoming dates" :number="stats.dates">
                    <AkCalendar class="text-gray-600 dark:text-gray-400 size-5" />
                </StatsCard>
                <!-- End Card -->
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-3">
                    <h1 class="text-black font-semibold text-center text-2xl font-outline-1 dark:text-white">Total
                        Incomers
                        Per Month</h1>
                    <BarChart class="h-64" :chartData="charts.usersByMonth" />
                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-3">
                    <h1 class="text-black font-semibold text-center text-2xl font-outline-1 dark:text-white">
                        Appointments</h1>
                    <PieChart class="h-64" :chartData="charts.appointments" />
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-3">
                    <h1 class="text-black font-semibold text-center text-2xl font-outline-1 dark:text-white">Total
                        Posts
                        Per Month</h1>
                    <BarChart class="h-64" :chartData="charts.posts" />
                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-3">
                    <h1 class="text-black font-semibold text-center text-2xl font-outline-1 dark:text-white">New Likes
                        Per
                        Month
                    </h1>
                    <LineChart class="h-64" :chartData="charts.likes" />
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-3">
                <h1 class="text-black font-semibold text-center text-2xl font-outline-1 dark:text-white">Expertises
                    Per
                    Month
                </h1>
                <BarChart class="h-64" :chartData="charts.expertises" />
            </div>
        </div>
        <!-- End Grid -->
    </AuthenticatedLayout>
</template>
