<template>
    <aside class="h-full w-64 border-r border-gray-200 relative">

        <header class="flex justify-between items-center border-b border-gray-200">
            <h2 class="font-medium text-slate-700 p-2 text-xl text-center">{{ title }}</h2>
        </header>

        <ul class="w-64">

            <li v-for="course in courses" class="relative">
                <Link :only="['course']"
                      preserve-state
                      :class="course?.id === $page.props.course.id ? 'text-white bg-teal-600 hover:!bg-teal-600' : 'text-slate-600' "
                      class="w-full capitalize flex justify-between items-center p-2 border-b border-gray-200 hover:bg-slate-100 hover:cursor-pointer"
                      :href="route('courses.show', course?.id)"
                >
                    <span>
                        {{ course?.title }} <span v-if="course?.section">({{ course?.section }})</span>
                    </span>
                    <button class="px-2 hover:bg-teal-700 rounded-md" v-if="$page.props.course.id === course?.id">•••</button>
                </Link>
            </li>

        </ul>

        <slot />

    </aside>

</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import {ref} from "vue";

const modalSeen = ref(false);
const props = defineProps(['courses', 'title']);

</script>
