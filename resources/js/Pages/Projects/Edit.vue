<script setup>
import { ref, reactive } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  project: Object,
});

const form = useForm({
  _method: "PUT",
  title: props.project.title,
  description: props.project.description,
  slug: props.project.slug,
  image: props.project.image,
  body: props.project.body,
});

/**
 * Image Upload
 * onChange: Read the file and set the form image
 * onRemove: Reset the form image and the input file
 */
const urlImage = ref(null);
const imageField = () => {
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
};

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



const texteditor = reactive({
  editor: ClassicEditor,
  editorConfig: {
    extraPlugins: [uploadAdapterPlugin],
    toolbar: {
      items:  [
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

/**
 * Update Form
 */
const updateProject = () => {
  form.post(route("projects.update", props.project.slug), {
    preserveState: true,
  });
};
</script>

<template>

  <Head title="Edit project" />

  <AuthenticatedLayout>
    <template #header>
      <div class="text-xl font-bold leading-tight text-gray-800 cursor-default dark:text-gray-200">
        <Link :href="route('dashboard.projects.index')">projects / </Link>
        <span class="text-indigo-500">{{ props.project.title }}</span>
        <span> / Edit</span>
      </div>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
          <div class="p-6 bg-white border-b dark:border-b-0 dark:bg-gray-800">
            <form @submit.prevent="updateProject">
              <div class="grid grid-cols-2 gap-3 mb-3">
                <!-- TITLE -->
                <div class="w-full col-span-2 mb-3">
                  <InputLabel for="title" value="Title" class="text-base text-gray-700 dark:text-gray-200" />
                  <TextInput id="title" type="text"
                    class="block w-full mt-1 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-800" :class="'ring-red-500' +
                      (form.errors.title ? ' ring-2' : '')
                      " v-model="form.title" placeholder="Title" required />
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

                <!-- IMAGE -->
                <div class="w-full col-span-2 mb-3 md:col-span-1">
                  <InputLabel for="image" value="Image" class="text-base text-gray-700 dark:text-gray-200" />
                  <div class="flex items-center gap-2">
                    <label class="w-full">
                      <span class="sr-only">Choose image</span>
                      <input @change="imageField().onChange" id="imageInput" type="file"
                        class="block w-full text-sm border border-gray-100 rounded-full dark:border-gray-700 text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 dark:text-gray-200 hover:file:bg-violet-100 focus:ring-2 focus:ring-indigo-500 focus:outline-none focus:rounded-full" />
                    </label>
                    <button v-if="urlImage || project.image" @click="imageField().onRemove" type="button"
                      class="p-1 transition duration-200 ease-in rounded-full hover:bg-slate-300">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                  <img v-if="urlImage || project.image" :src="urlImage || project.image
                    " class="w-full mt-4 h-80 object-cover" />
                  <div v-if="form.errors.image" class="mt-1 text-sm text-red-500">
                    {{ form.errors.image }}
                  </div>
                </div>

                <!-- BODY -->
                <div class="w-full col-span-2 mb-3">
                  <InputLabel value="Body" class="text-base text-gray-700 dark:text-gray-200" />
                  <ckeditor :editor="texteditor.editor" v-model="form.body" :config="texteditor.editorConfig">
                  </ckeditor>
                  <div v-if="form.errors.body" class="mt-1 text-sm text-red-500">
                    {{ form.errors.body }}
                  </div>
                </div>
              </div>

              <PrimaryButton :disabled="form.processing" :class="form.processing
                ? 'flex items-center justify-center'
                : null
                "> Update Project
              </PrimaryButton>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style></style>