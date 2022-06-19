<template>
    <Link @mouseover="isHovered=true"
          @mouseleave="isHovered=false"
          :href="route('courses.file.show', file.id)"
          class="w-48 h-72 bg-white border-gray-400 hover:border-black border relative"
    >
        <span v-if="isHovered" class="absolute right-0 top-0 float-right m-3 border border-black rounded-full">
            <BaseSvg name="icon-plus-sign" />
        </span>
        <div class="mx-auto text-center h-56 w-full flex justify-center items-center font-serif overflow-hidden">{{ file.filename }}</div>
        <div class="text-white bg-gray-900/30 absolute bottom-0 w-full p-3 text-center">{{ file.filename }}</div>
    </Link>
</template>

<script setup>
import {defineProps, ref} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
import BaseSvg from "@/Components/Modules/BaseSvg";

const props = defineProps(['file']);
let isHovered = ref(false);

</script>
