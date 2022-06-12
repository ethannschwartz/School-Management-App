<template>
    <Link @mouseover="isHovered=true"
          @mouseleave="isHovered=false"
          :href="route(link)"
          class="w-48 h-72 bg-white border-gray-400 hover:border-black border relative"
    >
        <span v-if="isHovered" class="absolute right-0 top-0 float-right m-3 border border-black rounded-full">
            <BaseSvg name="icon-plus-sign" />
        </span>
        <span class="mx-auto text-center h-56 w-full flex items-center font-serif">{{ title }}</span>
        <span class="text-white bg-gray-900/30 absolute bottom-0 w-full p-3 text-center">{{ title }}</span>
    </Link>
</template>

<script setup>
import {defineProps, ref} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
import BaseSvg from "@/Components/BaseSvg";
const props = defineProps(['title', 'link']);

const isHovered = ref(false);

</script>
