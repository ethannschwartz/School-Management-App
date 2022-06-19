<template>
    <aside class="h-full w-[250px] border-r border-gray-200 relative">

        <header class="flex justify-between items-center border-b border-gray-200">
            <h2 class="font-medium text-slate-700 p-2 text-xl text-center">Courses</h2>
        </header>

        <ul class="w-[250px]">
            <li v-for="course in courses" class="relative">
                <Link :only="['course']"
                      preserve-state
                      :class="course?.id === $page.props.course.id ? 'text-white bg-teal-600 hover:!bg-teal-600' : 'text-slate-600' "
                      class="w-full capitalize flex justify-between items-center p-2 border-b border-gray-200 hover:bg-slate-100 hover:cursor-pointer"
                      :href="route('courses.show', course?.id)"
                >
                    {{ course?.title }} ({{ course?.section }})

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

const props = defineProps(['courses', 'user']);

</script>
