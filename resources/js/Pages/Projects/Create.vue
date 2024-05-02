<template>
  <AuthenticatedLayout>
    <ckeditor :editor="textEditor.editor" ></ckeditor>
  </AuthenticatedLayout>
</template>
<script setup>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic"
import { ref, shallowRef } from "vue";

const textEditor = shallowRef({
    editor: ClassicEditor,
    editorConfig: {
        toolbar: {
            items: [
                "heading",
                "|",
                "bold",
                "italic",
                "strikethrough",
                "underline",
                "link",
                "bulletedList",
                "numberedList",
                "|",
                "alignment",
                "outdent",
                "indent",
                "|",
                "htmlEmbed",
                "imageUpload",
                "blockQuote",
                "insertTable",
                "mediaEmbed",
                "|",
                "removeFormat",
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

</script>