<template>
  <div class="fixed bottom-0 z-30 w-full">
    <div class="absolute bottom-0 items-center hidden mt-auto ml-auto text-white right-8 md:flex md:flex-col">
      <button v-for="(section, index) in sections" :key="index" @click="scrollToSection(section)"
        class="w-5 h-5 mb-4"><svg v-if="section === activeSection"
          class="rounded-sm transform  transition duration-500 ease-in-out hover:rotate-45 hover:scale-110 rotate-45 scale-110"
          data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path
            class="fill-black dark:fill-white origin-center transform transition duration-200 ease-in-out dark:text-white text-mid rotate-90"
            d="M5.64 5.64h12.73v12.73H5.64z"></path>
          <path
            class="fill-cyan-400 origin-center transform transition duration-500 ease-in-out dark:text-white text-dark rotate-45 opacity-100"
            d="M12 22.41L1.59 12 12 1.59 22.41 12zM4.41 12L12 19.59 19.59 12 12 4.41z"></path>
        </svg>
        <svg v-else
          class="rounded-sm transform  transition duration-500 ease-in-out hover:rotate-45 hover:scale-110 rotate-0 scale-100"
          data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path class="origin-center transform transition duration-200 ease-in-out text-light rotate-0"
            d="M5.64 5.64h12.73v12.73H5.64z"></path>
          <path
            class="fill-gray-400 origin-center transform transition duration-500 ease-in-out dark:text-white text-light rotate-45"
            d="M12 22.41L1.59 12 12 1.59 22.41 12zM4.41 12L12 19.59 19.59 12 12 4.41z"></path>
        </svg>
      </button>
      <div class="w-0.5 dark:bg-white bg-black h-36 opacity-20 mt-2 z-30"></div>
    </div>
  </div>
</template>


<script lang="ts">
import { defineComponent, ref, onMounted, onBeforeUnmount } from 'vue';

interface Props {
  sections: string[];
}

export default defineComponent({
  props: {
    sections: {
      type: Array as () => string[],
      required: true
    }
  },
  setup(props: Props) {
    const activeSection = ref<string | null>(null);
    let sectionOffsets: { id: string; offsetTop: number; offsetBottom: number }[] = [];

    let scrollTimeout: ReturnType<typeof setTimeout> | null = null;

    const scrollToSection = (section: string) => {
      if (scrollTimeout !== null) {
        clearTimeout(scrollTimeout);
      }

      const el = document.getElementById(section);
      if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
        scrollTimeout = setTimeout(() => {
          activeSection.value = section;
          scrollTimeout = null;
        }, 500);
      }
    };

    const cacheSectionOffsets = () => {
      sectionOffsets = props.sections.map(section => {
        const el = document.getElementById(section);
        return el ? {
          id: section,
          offsetTop: el.offsetTop,
          offsetBottom: el.offsetTop + el.offsetHeight
        } : { id: '', offsetTop: 0, offsetBottom: 0 };
      }).filter(section => section.id);
    };

    const handleScroll = () => {
      const scrollPosition = window.scrollY;

      for (const section of sectionOffsets) {
        if (scrollPosition >= section.offsetTop && scrollPosition < section.offsetBottom) {
          activeSection.value = section.id;
          return;
        }
      }
    };

    onMounted(() => {
      cacheSectionOffsets();
      window.addEventListener('scroll', handleScroll);
    });

    onBeforeUnmount(() => {
      window.removeEventListener('scroll', handleScroll);
    });


    return {
      activeSection,
      scrollToSection
    };
  }
});
</script>
