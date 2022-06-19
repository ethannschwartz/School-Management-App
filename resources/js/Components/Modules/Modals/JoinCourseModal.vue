<template>
    <Modal  @close="$emit('close')" submit-label="Join Course" header="Join Course" :submit-function="joinCourse">
        <input @change="searchCourse" type="text" placeholder="Keycode" class="p-2 border border-gray-200 rounded-md" v-model="courseSearch.search">
    </Modal>
</template>

<script setup>
import {Modal} from "@/Components";
import {useForm} from "@inertiajs/inertia-vue3";
import {debounce} from "lodash";

const courseSearch = useForm({search: null});
const joinCourseForm = useForm({course: null});

const searchCourse = debounce(() => {
    joinCourseForm.get(route('courses.search', courseSearch.search), {
        onSuccess: () => console.log('searched'),
    });
}, 500);

const joinCourse = () => {

};

</script>
