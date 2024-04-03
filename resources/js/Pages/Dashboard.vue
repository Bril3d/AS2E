<script setup>
import StatsCard from '@/Components/StatsCard.vue';
import { ClUsers, BxPackage, BsPostcardHeart, AkCalendar } from "@kalimahapps/vue-icons";
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    users: {
        type: Number,
        required: true,
    },
    dates: {
        type: Number,
        required: true,
    }
})
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout title="Stats">
        <!-- Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Card -->
            <StatsCard header="Total Users" tooltip="The number of daily users" :number="users">
                <ClUsers class="text-gray-600 dark:text-gray-400 size-5" />
            </StatsCard>
            <!-- End Card -->

            <!-- Card -->
            <StatsCard header="Total Projects" tooltip="The number of projects" :number="50">
                <BxPackage class="text-gray-600 dark:text-gray-400 size-5" />
            </StatsCard>
            <!-- End Card -->

            <!-- Card -->
            <StatsCard header="Total Posts" tooltip="The number of posts" :number="5">
                <BsPostcardHeart class="text-gray-600 dark:text-gray-400 size-5" />
            </StatsCard>
            <!-- End Card -->

            <!-- Card -->
            <StatsCard header="Upcoming Dates" tooltip="The number of upcoming dates" :number="dates">
                <AkCalendar class="text-gray-600 dark:text-gray-400 size-5" />
            </StatsCard>
            <!-- End Card -->
        </div>
        <!-- End Grid -->
    </AuthenticatedLayout>
</template>
