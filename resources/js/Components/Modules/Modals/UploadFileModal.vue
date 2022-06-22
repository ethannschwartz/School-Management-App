<template>

    <Modal @close="$emit('close')" submit-label="Upload File" header="Upload File" :submit-function="uploadFile" :form="uploadFileForm">
        <input type="text" placeholder="Title" class="p-2 border border-gray-200 rounded-md" v-model="uploadFileForm.title">
        <input type="file" placeholder="File" name="file" @input="uploadFileForm.file = $event.target.files[0]">
    </Modal>

</template>

<script setup>
import {Modal} from "@/Components";
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps(['course']);

const uploadFileForm = useForm({
    title: null,
    file: null,
});

const uploadFile = () => {
    uploadFileForm.post(route('courses.file.store', props.course.id), {
        onSuccess: () => {
            console.log('File upload successful!');
            uploadFileForm.reset();
        },
    });
};

</script>
