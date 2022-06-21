<template>

    <Modal submit-label="Create Course" @close="$emit('close')" header="Create Course" :submit-function="createCourse" :form="createCourseForm">
        <input type="text" placeholder="Title" class="p-2 border border-gray-200 rounded-md" v-model="createCourseForm.title">
        <input type="text" placeholder="Code" class="p-2 border border-gray-200 rounded-md" v-model="createCourseForm.code">
        <input type="text" placeholder="Section" class="p-2 border border-gray-200 rounded-md" v-model="createCourseForm.section">
        <textarea type="text" placeholder="Description" rows="6" class="p-2 border border-gray-200 rounded-md resize-none" v-model="createCourseForm.description"></textarea>
    </Modal>

</template>

<script setup>
import {Modal} from "@/Components";
import {useForm} from "@inertiajs/inertia-vue3";

const createCourseForm = useForm({
    title: null,
    code: null,
    section: null,
    description: null,
});

const createCourse = () => {
    createCourseForm.post(route('courses.store'), {
        onSuccess: () => {
            console.log('Course created successfully!');
            createCourseForm.reset();
        },
    });
};

</script>
