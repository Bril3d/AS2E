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
    homeSettings: Object,
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
        <Hero :data="homeSettings.home_hero" :carousel="homeSettings.home_carousel" id="Hero" />
        <Features :data="homeSettings.home_features" id="Features" />
        <Services :data="homeSettings.home_services" id="Services" />
        <LatestProjects id="Projects" :projects="projects" />
        <Stats :data="homeSettings.home_stats" id="Stats" />
        <Faq :data="homeSettings.home_faq" id="Faq" />
        <Footer />
    </div>
</template>
