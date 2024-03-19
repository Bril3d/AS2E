<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import StatsCard from '@/Components/StatsCard.vue';
import { ClUsers, BxPackage, BsPostcardHeart, AkCalendar } from "@kalimahapps/vue-icons";
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    users: {
        type: Number,
        required: true,
    }
})
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Card Section -->
                    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
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
                            <StatsCard header="Upcoming Dates" tooltip="The number of upcoming dates" :number="5">
                                <AkCalendar class="text-gray-600 dark:text-gray-400 size-5" />
                            </StatsCard>
                            <!-- End Card -->
                        </div>
                        <!-- End Grid -->
                    </div>
                    <!-- End Card Section -->
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
