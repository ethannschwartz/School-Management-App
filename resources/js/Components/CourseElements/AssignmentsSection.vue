<template>
    <div class="bg-slate-100 border-[1px] shadow-md h-full w-full p-8 mt-[1em] rounded-md">
        <div @click="isFocused===assignment.title? isFocused=false: isFocused=assignment.title" v-for="assignment in assignments" class="text-slate-600 border-slate-400 border-[1px] border-b-0 last-of-type:border-b-[1px] p-2 hover:bg-slate-200 active:bg-slate-300 text-opacity-60 hover:text-opacity-100">
            <button class="flex items-center justify-between w-full">
                <span>{{ assignment.title }}</span>
                <BaseSvg name="icon-chevron-up" class="fill-slate-600 duration-200" :class="isFocused===assignment.title? '-rotate-180': null " />
            </button>
            <transition name="expand" >
                <div class="w-full text-left text-slate-500" v-if="isFocused===assignment.title">{{ assignment.body }}</div>
            </transition>
        </div>
    </div>
</template>

<style scoped>
.expand-enter-from, .expand-leave-to {
    opacity:0;
    transform: scaleY(0.5) ;
    transform-origin: top;
}

.expand-enter-to, .expand-leave-from {
    opacity:1;
    transform: scaleY(1);
    transform-origin: top;
}

.expand-enter-active, .expand-leave-active {
    transition: all 0.2s ease-in;
}
</style>

<script setup>
import {defineProps, ref} from "vue";
import BaseSvg from "@/Components/BaseSvg";

const props = defineProps(['course', 'user']);

const isFocused = ref(false);

const assignments = [
    {
        title:'Homework 1',
        body: 'This is the details for Homework 1',
    },
    {
        title:'Homework 2',
        body: 'This is the details for Homework 2',
    },
    {
        title:'Homework 3',
        body: 'This is the details for Homework 3',
    },
    {
        title:'Homework 4',
        body: 'This is the details for Homework 4',
    },
];

</script>
