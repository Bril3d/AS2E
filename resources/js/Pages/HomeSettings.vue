<script setup>
import { ref } from 'vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputError from '@/Components/InputError.vue';
import { AkPlus, AkTrashCan, IcMediaImage } from "@kalimahapps/vue-icons";

const props = defineProps({
    settings: Object,
});

const activeTab = ref('hero');
const tabs = [
    { id: 'hero', name: 'Hero' },
    { id: 'features', name: 'Features' },
    { id: 'services', name: 'Services' },
    { id: 'stats', name: 'Stats' },
    { id: 'faq', name: 'FAQ' },
    { id: 'chatbot', name: 'Chatbot' },
];

// Hero Form
const heroForm = useForm({
    title: props.settings.home_hero.title,
    subtitle: props.settings.home_hero.subtitle,
});

const heroImagesForm = useForm({
    image: null,
});

const uploadHeroImage = () => {
    heroImagesForm.post(route('admin.home.hero.image'), {
        onSuccess: () => {
            heroImagesForm.reset('image');
        },
    });
};

const deleteHeroImage = (index) => {
    if (confirm('Are you sure you want to delete this image?')) {
        useForm({}).delete(route('admin.home.hero.image.delete', index));
    }
};

// Features Form
const featuresForm = useForm({
    section_title: props.settings.home_features.section_title,
    section_caption: props.settings.home_features.section_caption,
    title: props.settings.home_features.title,
    subtitle: props.settings.home_features.subtitle,
    description: props.settings.home_features.description,
    items: [...props.settings.home_features.items],
    image: null,
});

const featureImageUrl = ref(props.settings.home_features.image.startsWith('http') ? props.settings.home_features.image : `/storage/${props.settings.home_features.image}`);

const onFeatureImageChange = (e) => {
    const file = e.target.files[0];
    featuresForm.image = file;
    featureImageUrl.value = URL.createObjectURL(file);
};

// Services Form
const servicesForm = useForm({
    section_title: props.settings.home_services.section_title,
    section_caption: props.settings.home_services.section_caption,
    main_title: props.settings.home_services.main_title,
    description: props.settings.home_services.description,
    items: props.settings.home_services.items.map(i => ({ ...i })),
});

// Stats Form
const statsForm = useForm({
    section_title: props.settings.home_stats.section_title,
    section_caption: props.settings.home_stats.section_caption,
    items: props.settings.home_stats.items.map(i => ({ ...i })),
});

// FAQ Form
const faqForm = useForm({
    section_title: props.settings.home_faq.section_title,
    section_caption: props.settings.home_faq.section_caption,
    title: props.settings.home_faq.title,
    description: props.settings.home_faq.description,
    items: props.settings.home_faq.items.map(i => ({ ...i })),
});

// Chatbot Form
const chatbotForm = useForm({
    bot_name: props.settings.chatbot_settings.bot_name,
    welcome_message: props.settings.chatbot_settings.welcome_message,
    system_prompt: props.settings.chatbot_settings.system_prompt,
    api_key: props.settings.chatbot_settings.api_key,
    model: props.settings.chatbot_settings.model,
});

const submitHero = () => heroForm.post(route('admin.home.hero'));
const submitFeatures = () => featuresForm.post(route('admin.home.features'));
const submitServices = () => servicesForm.post(route('admin.home.services'));
const submitStats = () => statsForm.post(route('admin.home.stats'));
const submitFaq = () => faqForm.post(route('admin.home.faq'));
const submitChatbot = () => chatbotForm.post(route('admin.home.chatbot'));

const addItem = () => {
    if (activeTab.value === 'features') featuresForm.items.push('');
    if (activeTab.value === 'services') servicesForm.items.push({ title: '', description: '', icon: 'Book' });
    if (activeTab.value === 'stats') statsForm.items.push({ title: '', value: '', description: '' });
    if (activeTab.value === 'faq') faqForm.items.push({ question: '', answer: '' });
};

const removeItem = (index) => {
    if (activeTab.value === 'features') featuresForm.items.splice(index, 1);
    if (activeTab.value === 'services') servicesForm.items.splice(index, 1);
    if (activeTab.value === 'stats') statsForm.items.splice(index, 1);
    if (activeTab.value === 'faq') faqForm.items.splice(index, 1);
};
</script>

<template>
    <Head title="Home Page Settings" />

    <AuthenticatedLayout title="Home Page Settings">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Home Page Settings</h2>
        </template>

        <div class="max-w-7xl mx-auto py-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Tabs -->
                <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button v-for="tab in tabs" :key="tab.id" @click="activeTab = tab.id"
                            :class="[activeTab === tab.id ? 'border-main text-main' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200']">
                            {{ tab.name }}
                        </button>
                    </nav>
                </div>

                <!-- Hero Section -->
                <div v-if="activeTab === 'hero'" class="space-y-8">
                    <form @submit.prevent="submitHero" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <InputLabel for="hero_title" value="Hero Title" />
                                <TextInput id="hero_title" v-model="heroForm.title" class="mt-1 block w-full" />
                                <InputError :message="heroForm.errors.title" />
                            </div>
                            <div>
                                <InputLabel for="hero_subtitle" value="Hero Subtitle" />
                                <TextInput id="hero_subtitle" v-model="heroForm.subtitle" class="mt-1 block w-full" />
                                <InputError :message="heroForm.errors.subtitle" />
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <PrimaryButton :disabled="heroForm.processing" type="submit">Save Hero Content</PrimaryButton>
                        </div>
                    </form>

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-8">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Carousel Images</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
                            <div v-for="(img, index) in settings.home_carousel" :key="index" class="relative group">
                                <img :src="img.startsWith('http') ? img : `/storage/${img}`" class="w-full h-32 object-cover rounded-lg border dark:border-gray-700" />
                                <button type="button" @click="deleteHeroImage(index)" class="absolute top-1 right-1 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                    <AkTrashCan class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                        <form @submit.prevent="uploadHeroImage" class="flex items-center space-x-4">
                            <input type="file" @input="heroImagesForm.image = $event.target.files[0]" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            <PrimaryButton :disabled="heroImagesForm.processing || !heroImagesForm.image" type="submit">Upload Image</PrimaryButton>
                        </form>
                    </div>
                </div>

                <!-- Features Section -->
                <div v-if="activeTab === 'features'" class="space-y-6">
                    <form @submit.prevent="submitFeatures" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <InputLabel for="f_sec_title" value="Section Title" />
                                    <TextInput id="f_sec_title" v-model="featuresForm.section_title" class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <InputLabel for="f_sec_caption" value="Section Caption" />
                                    <TextInput id="f_sec_caption" v-model="featuresForm.section_caption" class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <InputLabel for="f_title" value="Main Title" />
                                    <TextInput id="f_title" v-model="featuresForm.title" class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <InputLabel for="f_subtitle" value="Subtitle" />
                                    <TextInput id="f_subtitle" v-model="featuresForm.subtitle" class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <InputLabel for="f_desc" value="Description" />
                                    <TextArea id="f_desc" v-model="featuresForm.description" class="mt-1 block w-full" rows="4" />
                                </div>
                            </div>
                            <div class="space-y-4">
                                <InputLabel value="Feature Image" />
                                <div class="relative h-64 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-lg flex items-center justify-center overflow-hidden cursor-pointer" @click="$refs.featureInput.click()">
                                    <img v-if="featureImageUrl" :src="featureImageUrl" class="w-full h-full object-cover" />
                                    <div v-else class="text-center text-gray-500">
                                        <IcMediaImage class="w-12 h-12 mx-auto mb-2" />
                                        <p>Click to upload image</p>
                                    </div>
                                    <input type="file" ref="featureInput" @change="onFeatureImageChange" class="hidden" />
                                </div>
                                <h4 class="font-medium text-gray-900 dark:text-gray-100">Bullet Points</h4>
                                <div v-for="(item, index) in featuresForm.items" :key="index" class="flex items-center space-x-2">
                                    <TextInput v-model="featuresForm.items[index]" class="flex-1" />
                                    <button type="button" @click.prevent="removeItem(index)" class="text-red-500"><AkTrashCan class="w-4 h-4" /></button>
                                </div>
                                <button type="button" @click.prevent="addItem" class="flex items-center text-sm text-main font-bold mt-2">
                                    <AkPlus class="w-4 h-4 mr-1" /> Add Point
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <PrimaryButton :disabled="featuresForm.processing" type="submit">Save Features Content</PrimaryButton>
                        </div>
                    </form>
                </div>

                <!-- Services Section -->
                <div v-if="activeTab === 'services'" class="space-y-6">
                    <form @submit.prevent="submitServices" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <InputLabel value="Section Title" />
                                <TextInput v-model="servicesForm.section_title" class="mt-1 block w-full" />
                            </div>
                            <div>
                                <InputLabel value="Section Caption" />
                                <TextInput v-model="servicesForm.section_caption" class="mt-1 block w-full" />
                            </div>
                        </div>
                        <div>
                            <InputLabel value="Main Title" />
                            <TextInput v-model="servicesForm.main_title" class="mt-1 block w-full" />
                        </div>
                        <div>
                            <InputLabel value="Description" />
                            <TextArea v-model="servicesForm.description" class="mt-1 block w-full" rows="3" />
                        </div>
                        
                        <h4 class="font-medium text-gray-900 dark:text-gray-100 pt-4 border-t dark:border-gray-700">Services List</h4>
                        <div v-for="(item, index) in servicesForm.items" :key="index" class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg space-y-4 relative">
                            <button type="button" @click.prevent="removeItem(index)" class="absolute top-2 right-2 text-red-500"><AkTrashCan class="w-4 h-4" /></button>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <InputLabel value="Title" />
                                    <TextInput v-model="item.title" class="mt-1 block w-full" />
                                </div>
                                <div>
                                    <InputLabel value="Icon" />
                                    <select v-model="item.icon" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        <option value="Book">Book</option>
                                        <option value="SettingsHorizontal">Settings</option>
                                        <option value="Layers">Layers</option>
                                        <option value="File">Docs</option>
                                        <option value="Modules">Modules</option>
                                        <option value="Tools">Tools</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <InputLabel value="Description" />
                                <TextInput v-model="item.description" class="mt-1 block w-full" />
                            </div>
                        </div>
                        <button type="button" @click.prevent="addItem" class="flex items-center text-sm text-main font-bold mt-2">
                            <AkPlus class="w-4 h-4 mr-1" /> Add Service
                        </button>

                        <div class="flex justify-end">
                            <PrimaryButton :disabled="servicesForm.processing" type="submit">Save Services Content</PrimaryButton>
                        </div>
                    </form>
                </div>

                <!-- Stats Section -->
                <div v-if="activeTab === 'stats'" class="space-y-6">
                    <form @submit.prevent="submitStats" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <InputLabel value="Section Title" />
                                <TextInput v-model="statsForm.section_title" class="mt-1 block w-full" />
                            </div>
                            <div>
                                <InputLabel value="Section Caption" />
                                <TextInput v-model="statsForm.section_caption" class="mt-1 block w-full" />
                            </div>
                        </div>
                        
                        <h4 class="font-medium text-gray-900 dark:text-gray-100 pt-4 border-t dark:border-gray-700">Stats List</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div v-for="(stat, index) in statsForm.items" :key="index" class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg space-y-3 relative">
                                <button type="button" @click.prevent="removeItem(index)" class="absolute top-2 right-2 text-red-500"><AkTrashCan class="w-4 h-4" /></button>
                                <div>
                                    <InputLabel value="Title" />
                                    <TextInput v-model="stat.title" class="mt-1 block w-full text-sm" />
                                </div>
                                <div>
                                    <InputLabel value="Value" />
                                    <TextInput v-model="stat.value" class="mt-1 block w-full text-sm font-bold" />
                                </div>
                                <div>
                                    <InputLabel value="Description" />
                                    <TextInput v-model="stat.description" class="mt-1 block w-full text-sm" />
                                </div>
                            </div>
                        </div>
                        <button type="button" @click.prevent="addItem" class="flex items-center text-sm text-main font-bold mt-2">
                            <AkPlus class="w-4 h-4 mr-1" /> Add Stat
                        </button>

                        <div class="flex justify-end">
                            <PrimaryButton :disabled="statsForm.processing" type="submit">Save Stats Content</PrimaryButton>
                        </div>
                    </form>
                </div>

                <!-- FAQ Section -->
                <div v-if="activeTab === 'faq'" class="space-y-6">
                    <form @submit.prevent="submitFaq" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <InputLabel value="Section Title" />
                                <TextInput v-model="faqForm.section_title" class="mt-1 block w-full" />
                            </div>
                            <div>
                                <InputLabel value="Section Caption" />
                                <TextInput v-model="faqForm.section_caption" class="mt-1 block w-full" />
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <InputLabel value="Sidebar Title" />
                                <TextInput v-model="faqForm.title" class="mt-1 block w-full" />
                            </div>
                            <div>
                                <InputLabel value="Sidebar Description" />
                                <TextInput v-model="faqForm.description" class="mt-1 block w-full" />
                            </div>
                        </div>
                        
                        <h4 class="font-medium text-gray-900 dark:text-gray-100 pt-4 border-t dark:border-gray-700">FAQ Items</h4>
                        <div v-for="(item, index) in faqForm.items" :key="index" class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg space-y-4 relative">
                            <button type="button" @click.prevent="removeItem(index)" class="absolute top-2 right-2 text-red-500"><AkTrashCan class="w-4 h-4" /></button>
                            <div>
                                <InputLabel value="Question" />
                                <TextInput v-model="item.question" class="mt-1 block w-full" />
                            </div>
                            <div>
                                <InputLabel value="Answer" />
                                <TextArea v-model="item.answer" class="mt-1 block w-full" rows="2" />
                            </div>
                        </div>
                        <button type="button" @click.prevent="addItem" class="flex items-center text-sm text-main font-bold mt-2">
                            <AkPlus class="w-4 h-4 mr-1" /> Add Question
                        </button>

                        <div class="flex justify-end">
                            <PrimaryButton :disabled="faqForm.processing" type="submit">Save FAQ Content</PrimaryButton>
                        </div>
                    </form>
                </div>
                <!-- Chatbot Section -->
                <div v-if="activeTab === 'chatbot'" class="space-y-6">
                    <form @submit.prevent="submitChatbot" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <InputLabel for="bot_name" value="Bot Name" />
                                <TextInput id="bot_name" v-model="chatbotForm.bot_name" class="mt-1 block w-full" />
                                <InputError :message="chatbotForm.errors.bot_name" />
                            </div>
                            <div>
                                <InputLabel for="model" value="Model" />
                                <select id="model" v-model="chatbotForm.model"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="gemini-3-flash">Gemini 3 Flash (Fast & Balanced)</option>
                                    <option value="gemini-3.1-pro-preview">Gemini 3.1 Pro Preview (Powerful)</option>
                                    <option value="gemini-3.1-flash-lite-preview">Gemini 3.1 Flash Lite (Low Latency)</option>
                                </select>
                                <InputError :message="chatbotForm.errors.model" />
                            </div>
                        </div>

                        <div>
                            <InputLabel for="api_key" value="Custom API Key (Optional)" />
                            <TextInput id="api_key" v-model="chatbotForm.api_key" type="password" class="mt-1 block w-full"
                                placeholder="Leave empty to use env default" />
                            <InputError :message="chatbotForm.errors.api_key" />
                            <p class="mt-1 text-sm text-gray-500">If provided, this key will override the server environment key.</p>
                        </div>

                        <div>
                            <InputLabel for="welcome_message" value="Welcome Message" />
                            <TextArea id="welcome_message" v-model="chatbotForm.welcome_message" class="mt-1 block w-full" rows="3" />
                            <InputError :message="chatbotForm.errors.welcome_message" />
                        </div>

                        <div>
                            <InputLabel for="system_prompt" value="System Prompt / Personality" />
                            <TextArea id="system_prompt" v-model="chatbotForm.system_prompt" class="mt-1 block w-full" rows="10" />
                            <InputError :message="chatbotForm.errors.system_prompt" />
                        </div>

                        <div class="flex justify-end">
                            <PrimaryButton :disabled="chatbotForm.processing" type="submit">Save Chatbot Settings</PrimaryButton>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
