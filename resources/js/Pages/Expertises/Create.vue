<template>

  <Head title="Expertise Creation" />
  <AuthenticatedLayout>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
          <div class="p-6 bg-white border-b dark:border-b-0 dark:bg-gray-800">
            <form @submit.prevent="submit">
              <div class="grid gap-3 mb-3">
                <!-- TITLE -->
                <div class="w-full col-span-2 mb-3">
                  <InputLabel for="title" value="Title" class="text-base text-gray-700 dark:text-gray-200" />
                  <TextInput id="title" type="text"
                    class="block w-full mt-1 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-800" :class="'ring-red-500' +
                      (form.errors.title ? ' ring-2' : '')
                      " v-model="form.title" placeholder="Title" autofocus required />
                  <InputError class="mt-2" :message="form.errors.title" />
                </div>
                <!-- DESCRIPTION -->
                <div class="w-full col-span-2 mb-3">
                  <InputLabel for="description" value="Description"
                    class="text-base text-gray-700 dark:text-gray-200" />
                  <textarea id="description" v-model="form.description" placeholder="Description"
                    class="w-full dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                    required></textarea>
                  <InputError class="mt-2" :message="form.errors.description" />
                </div>
                <!-- PROJECTS -->
                <div class="w-full col-span-2 mb-3">
                  <div v-if="projects.length > 0" class="mb-2">
                    <InputLabel value="Projects" for="Projects" />
                    <VueMultiselect class="dark:bg-slate-600" id="Projects" v-model="form.projects" :searchable="true"
                      mode="tags" :options="projects" :multiple="true" :close-on-select="true"
                      placeholder="Select Projects" label="title" track-by="title" />
                  </div>
                </div>

                <!-- IMAGE -->
                <div class="w-full col-span-2 mb-3 md:col-span-1">
                  <InputLabel for="image" value="Image" class="text-base text-gray-700 dark:text-gray-200" />
                  <div class="flex items-center gap-2">
                    <label class="w-full">
                      <span class="sr-only">
                        Choose image
                      </span>
                      <input @change="imageField().onChange" id="imageInput" type="file"
                        class="block w-full text-sm border border-gray-100 rounded-full dark:border-gray-700 text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 dark:text-gray-200 hover:file:bg-violet-100 focus:ring-2 focus:ring-indigo-500 focus:outline-none focus:rounded-full" />
                    </label>
                    <button v-show="urlImage" @click="imageField().onRemove" type="button"
                      class="p-1 transition duration-200 ease-in rounded-full hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                  <transition enterActiveClass="transition ease-out duration-300"
                    enterClass="opacity-0 transform scale-90" enterToClass="opacity-100 transform scale-100"
                    leaveActiveClass="transition ease-in duration-200" leaveClass="opacity-100 transform scale-100"
                    leaveToClass="opacity-0 transform scale-90">
                    <img v-show="urlImage" :src="urlImage" class="w-full object-cover mt-4 h-80" />
                  </transition>
                  <div v-if="form.errors.image" class="mt-1 text-sm text-red-500">
                    {{ form.errors.image }}
                  </div>
                </div>

                <!-- BODY -->
                <div class="w-full col-span-2 mb-2">
                  <InputLabel value="Body" class="text-base text-gray-700 dark:text-gray-200" />
                  <ckeditor :editor="textEditor.editor" v-model="form.body" :config="textEditor.editorConfig">
                  </ckeditor>

                  <div v-if="form.errors.body" class="mt-1 text-sm text-red-500">
                    {{ form.errors.body }}
                  </div>
                </div>
              </div>

              <PrimaryButton :disabled="form.processing" :class="form.processing
                ? 'flex items-center justify-center'
                : ''
                ">
                {{
                  form.processing
                    ? "Processing..."
                    : "Create expertise"
                }}
              </PrimaryButton>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
<script setup>
import { Head } from "@inertiajs/vue3";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import { ref, shallowRef } from "vue";
import { useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import VueMultiselect from 'vue-multiselect';

const props = defineProps({
  'projects': Object
})



const textEditor = shallowRef({
  editor: ClassicEditor,
  editorConfig: {
    extraPlugins: [uploadAdapterPlugin],
    toolbar: {
      items: [
        "heading",
        "|",
        "bold",
        "italic",
        "link",
        "bulletedList",
        "numberedList",
        "|",
        "outdent",
        "indent",
        "|",
        "imageUpload",
        "blockQuote",
        "insertTable",
        "mediaEmbed",
        "|",
        "undo",
        "redo",
      ],
    },
    language: "en",
    table: {
      contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"],
    },
  },
});

const form = useForm({
  title: "",
  description: "",
  image: "",
  body: "",
  projects: []
});

const urlImage = ref(null);
function imageField() {
  return {
    onChange: (event) => {
      const file = event.target.files[0];
      const reader = new FileReader();
      form.image = file;
      reader.onload = (event) => {
        urlImage.value = event.target.result;
      };
      reader.readAsDataURL(file);
    },
    onRemove: () => {
      document.querySelector("#imageInput").value = "";
      form.reset("image");
      urlImage.value = null;
    },
  };
}
function uploadAdapterPlugin(editor) {
  editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
    return {
      upload: async () => {
        try {
          const file = await loader.file;

          const formData = new FormData();
          formData.append('image', file);

          const response = await axios.post('/upload-image', formData);

          const imageUrl = response.data;

          return {
            default: imageUrl
          };
        } catch (error) {
          console.error('Upload error:', error);
          throw error;
        }
      },
    };
  };
}

function submit() {
  form.post(route("expertise.store"), {
    onSuccess: () => {
      form.reset();
      urlImage.value = null;
    },
  });
}

</script>