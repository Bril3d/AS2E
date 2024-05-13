<script setup>
import { Head } from '@inertiajs/vue3';
import LatestProjects from '@/Components/LatestProjects.vue';
import Hero from '../Components/Hero.vue';
import Features from '@/Components/Features.vue';
import Services from '@/Components/Services.vue'
import Faq from '@/Components/Faq.vue';
import Footer from '@/Components/Footer.vue'
import Stats from '@/Components/Stats.vue'
import SideNavigator from '@/Components/SideNavigator.vue';
import HomeNavBar from '@/Components/HomeNavbar.vue'
import { onMounted } from 'vue';

const sections = ['Hero', 'Features', 'Services', 'Projects','Stats', 'Faq']

defineProps({
    carousel: Array,
    projects: Array,
});

onMounted(() => {
    window.HSStaticMethods.autoInit()
});
</script>

<template>
    <Head>
        <title>Welcome</title>
        <meta name="description" content="You Partner For Smart Automation You Partner For Smart Automation">
    </Head>

    <div>
        <HomeNavBar />
        <SideNavigator :sections="sections" />
        <Hero :carousel="carousel" id="Hero" />
        <Features id="Features" />
        <Services id="Services" />
        <LatestProjects id="Projects" :projects="projects" />
        <Stats id="Stats" />
        <Faq id="Faq" />
        <Footer />
    </div>
</template>
