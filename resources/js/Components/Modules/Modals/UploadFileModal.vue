<template>

    <Modal @close="$emit('close')" submit-label="Upload File" header="Upload File" :submit-function="uploadFile" :form="uploadFileForm">
        <input type="text"
               placeholder="Title"
               class="p-2 border border-gray-200 rounded-md w-full"
               v-model="uploadFileForm.title"
        />

        <label for="file" class="duration-150 flex items-center justify-center w-full gap-2 bg-white border border-gray-300 hover:border-black rounded-md text-black py-2 px-4 whitespace-nowrap overflow-scroll text-center cursor-pointer">
            <BaseSvg name="icon-cloud-upload" />
            {{ uploadFileForm.file? uploadFileForm.file.name : 'Upload File' }}
        </label>
        <input hidden
               type="file"
               id="file"
               name="file"
               @input="uploadFileForm.file = $event.target.files[0]"
        />
    </Modal>

</template>

<script setup>
import {Modal, BaseSvg} from "@/Components";
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps(['course']);

const uploadFileForm = useForm({
    title: null,
    file: null,
});

const uploadFile = () => {
    uploadFileForm.post(route('courses.file.store', props.course), {
        onSuccess: () => {
            console.log('File upload successful!');
            uploadFileForm.reset();
        },
    });
};

</script>
