<template>
    <div class="editor-container">
        <label for="details" class="form-label mb-0">Details</label>
        <div ref="editor" class="editor"></div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import Quill from 'quill';

export default {
    name: 'DoctorCreate',
    setup() {
        const editor = ref(null);

        onMounted(() => {
            const quill = new Quill(editor.value, {
                theme: 'snow',
                placeholder: 'Write something...',
                modules: {
                    toolbar: [
                        [{ header: '1' }, { header: '2' }, { font: [] }],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['bold', 'italic', 'underline'],
                        [{ align: [] }],
                        ['link', 'image'],
                        ['blockquote', 'code-block'],
                        [{ script: 'sub' }, { script: 'super' }],
                        [{ color: [] }, { background: [] }],
                        ['clean']
                    ],
                },
            });
        });

        return {
            editor,
        };
    },
};
</script>

<style scoped>
.editor-container {
    max-width: 800px;
    margin: 0 auto;
}

.editor {
    height: 40px;
}

.ql-editor {
    color: black !important;
}

.ql-toolbar.ql-snow {
    border: 1px solid #ccc;
}
body .ql-editor {
    font-family: 'Arial', sans-serif !important;
    font-size: 14px;
    color: black !important;
}

.ql-toolbar {
    border: 1px solid #ccc;
}

.ql-toolbar {
    color: black !important;
}

.ql-snow .ql-picker.ql-expanded {
    display: block !important;
}
</style>
