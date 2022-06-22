<template>
    <a @mouseover="isHovered=true"
       @mouseleave="isHovered=false"
       :href="route('courses.files.show', file)"
       class="w-48 h-72 bg-white border-gray-400 hover:border-black border relative"
    >
        <div class="mx-auto text-center h-56 w-full flex justify-center items-center font-serif overflow-hidden">{{ file.title }}</div>
        <div class="text-white bg-gray-900/30 absolute bottom-0 w-full p-3 text-center">{{ file.title }}</div>
    </a>
</template>

<script setup>
import {defineProps, ref} from "vue";
const props = defineProps(['file']);
let isHovered = ref(false);

</script>
