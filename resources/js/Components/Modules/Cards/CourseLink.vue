<template>
    <ul class="w-full">
        <Link class="flex items-center justify-between w-full font-medium p-2 text-white bg-slate-600 hover:bg-slate-700 active:bg-slate-900 border-b border-t first-of-type:border-t-0 border-t-slate-500 border-slate-700"
              :href="route('teachers.show', course)"
              preserve-state
              preserve-scroll
              :only="['course']"
              v-for="course in teacher?.courses"
        >
            <span class="flex items-center gap-2">
                <span v-if="$page.props.course?.id===course?.id" class="p-0.5 rounded-full bg-white"></span>
                <span>{{ course?.title }}</span>
            </span>
            <span class="text-slate-300">{{ course?.section }}</span>
        </Link>
    </ul>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import {defineProps} from "vue";
const props = defineProps(['isSeen', 'teacher'])

</script>
