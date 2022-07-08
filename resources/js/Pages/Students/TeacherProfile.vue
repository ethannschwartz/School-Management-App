<template>
    <section class="flex items-center justify-center bg-teal-300 h-screen w-screen">

        <div class="relative p-8 bg-white border border-slate-200 rounded-md h-96 w-1/2 shadow-2xl">

            <Link :href="route('courses.index')" class="flex items-center gap-1 text-gray-400 hover:text-gray-600 fill fill-gray-400 hover:fill-gray-400 uppercase tracking-widest mb-4">
                <BaseSvg name="icon-chevron-left" class="fill-current" />
                Back
            </Link>

            <header class="pb-4 mb-4 border-b">
                <h1 class="text-gray-600 text-3xl font-medium">{{teacher.prefix}} {{ teacher.name }}</h1>
                <h2 class="text-gray-600">Boston University</h2>
                <h3 class="text-gray-600">Department of Biology</h3>
            </header>

            <div v-if="teacher.courses.length > 0">
                <h2 class="text-gray-600 text-xl">Courses Offered</h2>
                <ul class="pl-4 text-gray-600">
                    <li v-for="course in teacher.courses">{{ course.title }}</li>
                </ul>
            </div>

            <div class="absolute bottom-4 left-4 right-4 flex justify-center mt-4">
                <button class="text-lg p-2 rounded-md w-full bg-teal-600 text-white hover:bg-teal-700 active:bg-teal-900 whitespace-nowrap">Subscribe for just $8 monthly</button>
            </div>

        </div>

    </section>
</template>

<script setup>
import {BaseSvg} from "@/Components";
import {Link} from "@inertiajs/inertia-vue3";
const props = defineProps(['teacher']);
</script>
