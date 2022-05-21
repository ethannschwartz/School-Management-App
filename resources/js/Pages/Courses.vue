<template>

    <section class="pt-[4em] bg-teal-100">
        <div class="px-[30px] lg:px-[60px] py-[30px] lg:py-[60px]">
            <div class="h-[600px] flex bg-white shadow-lg">

                <aside class="h-full w-[250px] border-r-[1px] border-gray-200 relative">

                    <header class="flex justify-between items-center border-b-[1px] border-gray-200">
                        <h2 class="font-medium text-slate-700 p-2 text-xl text-center">Courses</h2>
                    </header>

                    <ul class="w-[250px]">
                        <li v-for="course in courses" class="relative">
                            <Link :only="['course']"
                                  @click="isCourse = course"
                                  preserve-state
                                  :class="isCourse?.id === course?.id ? 'text-white bg-teal-600 hover:!bg-teal-600' : 'text-slate-600' "
                                  class="w-full capitalize flex justify-between items-center p-2 border-b-[1px] border-gray-200 hover:bg-slate-100 hover:cursor-pointer"
                                  :href="route('courses.show', course?.id)"
                            >
                                {{ course?.title }} ({{ course?.section }})
                                <button class="hover:bg-teal-700 px-2 rounded-md" v-if="isCourse.id === course?.id && user.id === course?.user_id" @click="settingsOpen = !settingsOpen">•••</button>
                            </Link>

                            <transition name="expand">
                                <ul v-if="isCourse === course && settingsOpen" class="absolute -right-[140px] top-0 bg-slate-700 shadow-md">
                                    <Link class="flex justify-between items-center w-[140px] text-white capitalize block p-2 bg-slate-700 hover:bg-slate-800 hover:cursor-pointer">
                                        Edit
                                        <BaseSvg name="icon-edit" class="fill-slate-100 scale-75" />
                                    </Link>
                                    <Link class="flex justify-between items-center w-[140px] text-white capitalize block p-2 bg-slate-700 hover:bg-slate-800 hover:cursor-pointer">
                                        Delete
                                        <BaseSvg name="icon-delete" class="fill-slate-100 scale-75" />
                                    </Link>
                                </ul>
                            </transition>
                        </li>
                    </ul>

                    <div v-if="accountType === 'teacher'" class="border-t-[1px] !w-full border-gray-200 absolute bottom-0 text-center">
                        <button @click="createCourseModalOpen = !createCourseModalOpen"
                                class="w-full font-medium p-2 text-slate-600 hover:bg-teal-600 hover:text-white active:bg-teal-900 active:text-white">
                            Create Course
                        </button>
                    </div>

                    <div v-else class="border-t-[1px] !w-full border-gray-200 absolute bottom-0 text-center">
                        <button @click="joinCourseModalOpen = !joinCourseModalOpen"
                                class="w-full font-medium p-2 text-slate-600 hover:bg-teal-600 hover:text-white active:bg-teal-900 active:text-white">
                            Join Course
                        </button>
                    </div>
                </aside>

                <section class="w-full h-full">
                    <header class="w-full bg-gray-200 p-4">
                        <h1 class="text-3xl capitalize">{{ course?.title }} <span class="text-slate-500 text-2xl">({{ course?.section }})</span></h1>
                        <h2 class="text-xl">{{ course?.admin_prefix }} {{ course?.admin_name?.split(" ")[1] }}</h2>

                        <div class="flex whitespace-nowrap w-fit">
                            <div class="hidden xl:flex w-fit whitespace-nowrap" @mouseover="copyHintSeen=true" @mouseleave="copyHintSeen=false">
                                <button @click="copyText" class="w-fit whitespace-nowrap flex items-center text-md text-slate-500 select-all cursor-pointer hover:text-blue-600 hover:underline underline-offset-4">{{ course?.keycode }}</button>
                                <BaseSvg name="icon-clipboard-copy" class="ml-2 opacity-50 scale-75" />
                            </div>
                            <HintTransition :hint-seen="copyHintSeen" name="fade">Click to Copy</HintTransition>
                        </div>
                    </header>

                    <div class="flex justify-between gap-[16px] m-6">
                        <article class="w-1/2 pr-4 h-[400px] border-r-[1px]">
                            <header class="flex items-center justify-between px-[8px]">
                                <h2 class="text-xl tracking-wider text-slate-600">Announcements</h2>
                                <button class="text-slate-500" @click="announcementModalSeen = !announcementModalSeen">
                                    <BaseSvg name="icon-add-box" class="opacity-75 hover:opacity-100 fill-slate-700" />
                                </button>
                            </header>

                            <ul class="z-0 h-full overflow-y-scroll p-2">
                                <li v-if="course?.announcements?.length !== 0">
                                    <AnnouncementCard v-for="announcement in course?.announcements" :announcement="announcement" :user="user" :course="course" />
                                </li>

                                <li v-else class="h-full flex items-center justify-center text-center text-slate-600 text-[18px] w-full">
                                    <div class="bg-slate-100 border-[1px] shadow-md rounded-lg px-6 py-2">You don't have any announcements</div>
                                </li>
                            </ul>
                        </article>

                        <article class="block w-1/2 px-4 overflow-hidden">
                            <header>
                                <ul class="flex gap-4 flex-wrap">
                                    <li @click="currentElement=courseElement" :class="currentElement === courseElement ? 'bg-pink-600 !text-white hover:!bg-pink-600' : 'bg-pink-200'" class="text-pink-600 px-4 rounded-full tracking-wider whitespace-nowrap hover:bg-pink-300" v-for="courseElement in courseElements">
                                        <button>{{ courseElement }}</button>
                                    </li>
                                </ul>
                            </header>

                                <div>
                                    <header class="text-slate-600 mt-[1em] text-left text-[23px]">
                                        <h1>{{ currentElement }}</h1>
                                    </header>
                                    <div class="flex overflow-visible">
                                        <transition name="slide">
                                            <AssignmentsSection v-if="currentElement==='Assignments'" :course="course" :user="user" />
                                        </transition>
                                        <transition name="slide">
                                            <ResourcesSection v-if="currentElement==='Resources'" :course="course" :user="user" />
                                        </transition>
                                        <transition name="slide">
                                            <ExamsSection v-if="currentElement==='Exams'" :course="course" :user="user" />
                                        </transition>
                                        <transition name="slide">
                                            <HoursSection v-if="currentElement==='Office Hours'" :course="course" :user="user" />
                                        </transition>
                                    </div>
                                </div>


                        </article>
                    </div>
                </section>


            </div>
        </div>
    </section>

    <transition name="fade">
        <Modal v-if="createCourseModalOpen" :open="createCourseModalOpen" @close="createCourseModalOpen = !createCourseModalOpen" submit-label="Create Course" header="Create Course" :submit-function="createCourse">
            <input type="text" placeholder="Title" class="p-2 border border-gray-200 rounded-md" v-model="createCourseForm.title">
            <input type="text" placeholder="Code" class="p-2 border border-gray-200 rounded-md" v-model="createCourseForm.code">
            <input type="text" placeholder="Section" class="p-2 border border-gray-200 rounded-md" v-model="createCourseForm.section">
            <textarea type="text" placeholder="Description" rows="6" class="p-2 border border-gray-200 rounded-md resize-none" v-model="createCourseForm.description"></textarea>
        </Modal>
    </transition>

    <transition name="fade">
        <Modal v-if="announcementModalSeen" :open="announcementModalSeen" @close="announcementModalSeen = !announcementModalSeen" submit-label="Post Announcement" header="Post Announcement" :submit-function="postAnnouncement">
            <textarea type="text" :placeholder="`Announce to ${course.title} (${course.section})`" rows="6" class="p-2 border border-gray-200 rounded-md resize-none" v-model="announcementForm.body"></textarea>
        </Modal>
    </transition>

    <transition name="fade">
        <Modal v-if="joinCourseModalOpen" :open="joinCourseModalOpen" @close="joinCourseModalOpen = !joinCourseModalOpen" submit-label="Join Course" header="Join Course" :submit-function="joinCourse">
            <input type="text" placeholder="Keycode" class="p-2 border border-gray-200 rounded-md" v-model="joinCourseForm.keycode">
        </Modal>
    </transition>

</template>

<style scoped>
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
import {ref} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
import BaseSvg from "@/Components/BaseSvg";
import HintTransition from "@/Components/HintTransition";
import Modal from "@/Components/Modals/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import AnnouncementCard from "@/Components/AnnouncementCard";
import AssignmentsSection from "@/Components/CourseElements/AssignmentsSection";
import ResourcesSection from "@/Components/CourseElements/ResourcesSection";
import ExamsSection from "@/Components/CourseElements/ExamsSection";
import HoursSection from "@/Components/CourseElements/HoursSection";

const props = defineProps(['user', 'course', 'courses']);
const accountType = props.user.account_type;

const isCourse = ref(props.course);

const courseElements = ['Assignments', 'Resources', 'Exams', 'Office Hours'];

let currentElement = ref(courseElements[0]);

const copyHintSeen = ref(false);
const settingsOpen = ref(false);

const createCourseForm = useForm({
    title: null,
    code: null,
    section: null,
    description: null,
});

const joinCourseForm = useForm({
    keycode: null,
});

const announcementForm = useForm({
    body: null,
});

let createCourseModalOpen = ref(false);
let joinCourseModalOpen = ref(false);
let announcementModalSeen = ref(false);

const createCourse = () => {
    createCourseForm.post(route('courses.store'), {
        onSuccess: () => {
            console.log('Course created successfully!');
            createCourseForm.reset();
            createCourseModalOpen.value = false;
        },
    });
};

const postAnnouncement = () => {
    announcementForm.post(route('courses.announcements.store', props.course.id), {
        onSuccess: () => {
            console.log('Announcement posted successfully!');
            announcementForm.reset();
            announcementModalSeen.value = false;
        },
    });
};

const joinCourse = () => {
    joinCourseForm.post(route('courses.follower.store', joinCourseForm.keycode), {
        onSuccess: () => {
            console.log('course follow successful!');
            // joinCourseForm.reset();
            joinCourseModalOpen.value = false;
        },
    });
};

const copyText = (event) => navigator.clipboard.writeText(event.target.textContent);

</script>

<!--KZzBQBpo0bjV2I5CDkJr-->
