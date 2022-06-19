<template>

    <section class="pt-16 bg-teal-100">
        <div class="px-8 lg:px-16 py-8 lg:py-16">
            <div class="h-[600px] flex bg-white shadow-lg">

                <aside class="h-full w-[250px] border-r border-gray-200 relative">

                    <header class="flex justify-between items-center border-b border-gray-200">
                        <h2 class="font-medium text-slate-700 p-2 text-xl text-center">Courses</h2>
                    </header>

                    <ul class="w-[250px]">
                        <li v-for="course in courses" class="relative">
                            <Link :only="['course']"
                                  preserve-state
                                  :class="course?.id === $page.props.course.id ? 'text-white bg-teal-600 hover:!bg-teal-600' : 'text-slate-600' "
                                  class="w-full capitalize flex justify-between items-center p-2 border-b border-gray-200 hover:bg-slate-100 hover:cursor-pointer"
                                  :href="route('courses.show', course?.id)"
                            >
                                {{ course?.title }} ({{ course?.section }})
                                <button class="hover:bg-teal-700 px-2 rounded-md" v-if="course?.id === props.course?.id && user.id === props.course?.user_id" @click="settingsOpen = !settingsOpen">•••</button>
                            </Link>
                        </li>
                    </ul>

                    <div class="border-t !w-full border-gray-200 absolute bottom-0 text-center">
                        <button @click="joinCourseModalOpen = !joinCourseModalOpen"
                                class="w-full font-medium p-2 text-slate-600 hover:bg-teal-600 hover:text-white active:bg-teal-900 active:text-white">
                            Join Course
                        </button>
                    </div>
                </aside>

                <section class="w-full h-full">

                    <header class="w-full bg-gray-200 p-4">
                        <h1 class="text-3xl capitalize">{{ course?.title }} <span class="text-slate-500 text-2xl">({{ course?.section }})</span></h1>
                        <h2 class="text-xl">{{ course?.user?.prefix }} {{ course?.user?.name?.split(" ")[1] }}</h2>
                    </header>


                    <div class="p-8 w-full">
                        <h2 class="mb-4 text-gray-600">{{ course?.user.name }}'s Content</h2>
                        <div class="flex gap-8">

                            <FileCard v-for="file in course.files" :file="file" />

                        </div>
                    </div>

                </section>


            </div>
        </div>
    </section>

    <transition name="fade">
        <Modal v-if="joinCourseModalOpen" :open="joinCourseModalOpen" @close="joinCourseModalOpen = !joinCourseModalOpen" submit-label="Join Course" header="Join Course" :submit-function="joinCourse">
            <input type="text" placeholder="Keycode" class="p-2 border border-gray-200 rounded-md" v-model="joinCourseForm.keycode">
        </Modal>
    </transition>

</template>

<style>
.expand-enter-from, .expand-leave-to {
    opacity:0;
    transform: scaleX(0.5) ;
    transform-origin: left;
}

.expand-enter-to, .expand-leave-from {
    opacity:1;
    transform: scaleX(1);
    transform-origin: left;
}

.expand-enter-active, .expand-leave-active {
    transition: all 0.2s ease-in;
}

.slide-enter-from, .slide-leave-to {
    opacity:0;
    transform: translateX(100%) ;
    transform-origin: left;
}

.slide-enter-to, .slide-leave-from {
    opacity:1;
    transform: translateX(0);
    transform-origin: left;
}

.slide-enter-active, .slide-leave-active {
    transition: all 0.15s ease-in;
}
</style>

<script setup>
import {onMounted, ref} from "vue";
import {Link, useForm} from "@inertiajs/inertia-vue3";
import {FileCard, Modal} from "@/Components";

const props = defineProps(['user', 'course', 'courses']);

const isCourse = ref(props.courses[0]);

const copyHintSeen = ref(false);
const settingsOpen = ref(false);
let createCourseModalOpen = ref(false);
let joinCourseModalOpen = ref(false);
let uploadFileModalOpen = ref(false);

const joinCourseForm = useForm({
    keycode: null,
});

const joinCourse = () => {
    joinCourseForm.post(route('courses.course_follower.store', joinCourseForm.keycode), {
        onSuccess: () => {
            console.log('course follow successful!');
            joinCourseForm.reset();
            joinCourseModalOpen.value = false;
        },
    });
};

</script>
