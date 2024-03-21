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
import SideNavigator from '@/Components/SideNavigator.vue';
import { onMounted } from 'vue';
import { HSCopyMarkup as HSStaticMethods } from "preline";

const sections = ['Hero', 'Features', 'Services', 'Stats', 'Faq', 'Contact']

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

onMounted(() => {
   window.HSStaticMethods.autoInit()
});
</script>

<template>
    <Head title="Welcome" />
    <div>
        <AnnouncementBanner content="This website still under development." />
        <SideNavigator :sections="sections" />
        <Hero :canLogin="canLogin" :canRegister="canRegister" id="Hero" />
        <Features id="Features" />
        <Services id="Services" />
        <Stats id="Stats" />
        <Faq id="Faq" />
        <Contact id="Contact" />
        <Footer />
    </div>
</template>

