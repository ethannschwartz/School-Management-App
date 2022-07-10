<template>

    <header v-if="course" class="flex items-start justify-between w-full bg-gray-100 p-4">
        <div>
            <h1 class="text-3xl capitalize">{{ course?.title }} <span class="text-slate-500 text-2xl">({{ course?.section }})</span></h1>
            <Link as="button"
                  :href="route('teachers.get_info', course.user_id)"
                  class="text-xl text-teal-600 hover:text-black underline underline-offset-4"
            >
                {{ course?.user?.prefix }} {{ course?.user?.name?.split(" ")[1] }}
            </Link>
        </div>
    </header>

</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import {defineProps} from "vue";

const props = defineProps(['course', 'user']);

</script>
