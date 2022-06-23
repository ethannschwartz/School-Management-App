<template>
    <button class="bg-white duration-150 relative z-50 flex items-center justify-between w-full font-medium p-2 text-slate-600 hover:bg-slate-100 active:bg-slate-200 active:text-black border-b"
    >
        {{ teacher?.name }}
        <BaseSvg name="icon-chevron-left" class="duration-150 fill-slate-500" :class="isSeen===teacher?.id? '-rotate-90' : null" />
    </button>
</template>

<script setup>
import {defineProps} from "vue";
import {BaseSvg} from "@/Components";
const props = defineProps(['isSeen', 'teacher']);

</script>
