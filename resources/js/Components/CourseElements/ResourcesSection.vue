<template>
    <div class="bg-slate-100 border-[1px] shadow-md h-full w-full p-8 mt-[1em] rounded-md z-50">
        <div @click="isFocused===Resource.title? isFocused=false: isFocused=Resource.title" v-for="Resource in course[0]?.resources" class="z-50 text-slate-600 border-slate-400 border-[1px] border-b-0 last-of-type:border-b-[1px] p-2 hover:bg-slate-200 active:bg-slate-300 text-opacity-60 hover:text-opacity-100">
            <button class="flex items-center justify-between w-full z-50">
                <span>{{ Resource.title }}</span>
                <BaseSvg name="icon-chevron-up" class="fill-slate-600 duration-200" :class="isFocused===Resource.title? '-rotate-180': null " />
            </button>
            <transition name="expand" class="overflow-hidden" >
                <div v-if="isFocused===Resource.title" class="z-20 overflow-hidden">
                    <div class="w-full text-left text-slate-500 z-20">{{ Resource.description }}</div>
                    <div class="w-full text-left text-slate-400 text-right text-xs z-20">{{ DateTime.fromISO(Resource?.created_at).toFormat('FF') }}</div>
                    <div class="w-full text-left text-slate-400 text-xs z-20">{{ Resource.points }} points</div>
                </div>
            </transition>
        </div>
        <div class="text-slate-600 border-slate-400 border-[1px] border-b-0 last-of-type:border-b-[1px]">
            <button @click="resourceModalSeen = !resourceModalSeen" class="flex items-center justify-center gap-1 w-full h-full opacity-60 hover:opacity-100 hover:bg-slate-200 active:bg-slate-300 p-2">
                <span>Create Resource</span>
                <BaseSvg name="icon-plus-sign" class="fill-slate-600 duration-200" />
            </button>
        </div>

        <transition name="fade">
            <Modal v-if="resourceModalSeen" :open="resourceModalSeen" @close="resourceModalSeen=!resourceModalSeen" submit-label="Create Exam" header="Create Exam" :submit-function="createResource">
                <input type="text" placeholder="Title" class="p-2 border border-gray-200 rounded-md" v-model="resourceForm.title">

                <input type="number" placeholder="Points" class="p-2 border border-gray-200 rounded-md w-full lg:w-1/2" v-model="resourceForm.points">

                <textarea type="text" placeholder="Description" rows="6" class="p-2 border border-gray-200 rounded-md resize-none" v-model="resourceForm.description"></textarea>
            </Modal>
        </transition>

    </div>
</template>

<style scoped>
.expand-enter-from, .expand-leave-to {
    opacity:0;
    transform: translateY(-40px) ;
    transform-origin: top;
}

.expand-enter-to, .expand-leave-from {
    opacity:1;
    transform: translateY(0);
    transform-origin: top;
}

.expand-enter-active, .expand-leave-active {
    transition: all 0.2s ease-in;
}
</style>

<script setup>
import {defineProps, ref} from "vue";
import BaseSvg from "@/Components/BaseSvg";
import Modal from "@/Components/Modals/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import {DateTime} from "luxon";

const props = defineProps(['course', 'user']);

const isFocused = ref(false);

let resourceModalSeen = ref(false);

const resourceForm = useForm({
    title: null,
    description: null,
    date: null,
    time: null,
    points: null,
});

const createResource = () => {
    resourceForm.post(route('courses.resources.store', props.course[0].id), {
        onSuccess: () => {
            console.log('Resource posted successfully!');
            resourceForm.reset();
            resourceModalSeen.value = false;
        }
    });
};

</script>
