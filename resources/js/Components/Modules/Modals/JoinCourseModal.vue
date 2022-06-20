<template>
    <Modal  @close="$emit('close')" submit-label="Join Course" header="Join Course" :submit-function="joinCourse">
        <input type="text" placeholder="Search" class="p-2 border border-gray-200 rounded-md" v-model="search">
    </Modal>
</template>

<script setup>
import {Modal} from "@/Components";
import {useForm} from "@inertiajs/inertia-vue3";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";

let search = ref('');

watch(search, value => {
    Inertia.get(route('courses.search', search.value), { search: value }, {
        preserveState: true,
    });
}, 500);

const joinCourseForm = useForm({
    course: null,
});

const joinCourse = () => {

};

</script>
