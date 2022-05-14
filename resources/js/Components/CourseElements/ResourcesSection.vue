<template>
    <div class="bg-slate-100 h-full w-full p-8 mt-[1em] rounded-md">
        <div @click="isSeen===assignment.title? isSeen=false: isSeen=assignment.title" v-for="assignment in assignments" class="flex items-center text-slate-600 border-slate-400 border-[1px] border-b-0 last-of-type:border-b-[1px] p-2">

            <div>
                <h1>{{ assignment.title }}</h1>
                <transition name="expand" >
                    <div class="text-left" v-if="isSeen===assignment.title">{{ assignment.body }}</div>
                </transition>
            </div>
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

const props = defineProps(['course', 'user']);

const isSeen = ref(false);

const assignments = [
    {
        title:'Study Guide 1',
        body:'Blah blah blah',
    },
    {
        title:'Linear equations how-to link',
        body:`Blah blah blah`,
    },
];

</script>
