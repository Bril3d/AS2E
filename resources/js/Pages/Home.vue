<script setup>
import { Head } from '@inertiajs/vue3';
import AnnouncementBanner from '@/Components/AnnouncementBanner.vue';
import Hero from '../Components/Hero.vue';
import Features from '@/Components/Features.vue';
import Services from '@/Components/Services.vue'
import Faq from '@/Components/Faq.vue';
import Footer from '@/Components/Footer.vue'
import Stats from '@/Components/Stats.vue'
import Contact from '@/Components/Contact.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div>
        <AnnouncementBanner content="This website still under development." />
        <Hero :canLogin="canLogin" :canRegister="canRegister" />
        <Features />
        <Services />
        <Stats />
        <Faq />
        <Contact />
        <Footer />
    </div>
</template>

