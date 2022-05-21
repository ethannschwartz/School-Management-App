<template>
    <div class="bg-slate-100 border-[1px] shadow-md h-full w-full p-8 mt-[1em] rounded-md z-50">
        <div @click="isFocused===assignment.title? isFocused=false: isFocused=assignment.title" v-for="assignment in course?.assignments" class="z-50 text-slate-600 border-slate-400 border-[1px] border-b-0 last-of-type:border-b-[1px] p-2 hover:bg-slate-200 active:bg-slate-300 text-opacity-60 hover:text-opacity-100">
            <button class="flex items-center justify-between w-full z-50">
                <span>{{ assignment.title }}</span>
                <BaseSvg name="icon-chevron-up" class="fill-slate-600 duration-200" :class="isFocused===assignment.title? '-rotate-180': null " />
            </button>
            <transition name="expand" class="overflow-hidden" >
                <div v-if="isFocused===assignment.title" class="z-20 overflow-hidden">
                    <div class="w-full text-left text-slate-500 z-20">{{ assignment.description }}</div>
                    <div class="w-full text-left text-slate-400 text-right text-xs z-20">{{ DateTime.fromISO(assignment?.created_at).toFormat('FF') }}</div>
                    <div class="w-full text-left text-slate-400 text-xs z-20">{{ assignment.points }} points</div>
                </div>
            </transition>
        </div>
        <div class="text-slate-600 border-slate-400 border-[1px] border-b-0 last-of-type:border-b-[1px]">
            <button @click="assignmentModalSeen = !assignmentModalSeen" class="flex items-center justify-center gap-1 w-full h-full opacity-60 hover:opacity-100 hover:bg-slate-200 active:bg-slate-300 p-2">
                <span>Create Assignment</span>
                <BaseSvg name="icon-plus-sign" class="fill-slate-600 duration-200" />
            </button>
        </div>

        <transition name="fade">
            <Modal v-if="assignmentModalSeen" :open="assignmentModalSeen" @close="assignmentModalSeen=!assignmentModalSeen" submit-label="Create Assignment" header="Create Assignment" :submit-function="createAssignment">
                <input type="text" placeholder="Title" class="p-2 border border-gray-200 rounded-md" v-model="assignmentForm.title">
                <div class="block lg:flex gap-4">
                    <div class="lg:flex lg:gap-4 w-full lg:w-1/2">
                        <input type="date" placeholder="Due Date" class="p-2 border border-gray-200 rounded-md w-full mb-[0.8em] lg:mb-0 lg:w-1/2" v-model="assignmentForm.due_date">
                        <input type="time" placeholder="Time" class="p-2 border border-gray-200 rounded-md w-full mb-[0.8em] lg:mb-0 lg:w-1/2" v-model="assignmentForm.due_time">
                    </div>
                    <input type="number" placeholder="Points" class="p-2 border border-gray-200 rounded-md w-full lg:w-1/2" v-model="assignmentForm.points">
                </div>
                <textarea type="text" placeholder="Description" rows="6" class="p-2 border border-gray-200 rounded-md resize-none" v-model="assignmentForm.description"></textarea>
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

let assignmentModalSeen = ref(false);

const assignmentForm = useForm({
    title: null,
    description: null,
    due_date: null,
    due_time: null,
    points: null,
});

const createAssignment = () => {
    assignmentForm.post(route('courses.assignments.store', props.course[0].id), {
        onSuccess: () => {
            console.log('Assignment posted successfully!');
            assignmentForm.reset();
            assignmentModalSeen.value = false;
        }
    });
};

</script>
