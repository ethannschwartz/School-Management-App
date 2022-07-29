<template>
    <a :href="route('courses.files.show', file)"
       :title="file.title"
       class="w-48 h-72 bg-white border-gray-400 hover:border-black border relative"
    >
        <div class="relative mx-auto text-center h-56 w-full flex justify-center items-center font-serif overflow-hidden capitalize">
            {{ file.title }}
        </div>
        <div class="whitespace-nowrap truncate text-white bg-slate-600 absolute bottom-0 w-full p-3 text-center capitalize">
            {{ file.title }}
        </div>
    </a>
</template>

<script setup>
import {defineProps} from "vue";
const props = defineProps(['file']);

</script>
