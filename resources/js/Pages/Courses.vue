<template>

    <section class="pt-[4em] bg-purple-600">
        <div class="px-[30px] lg:px-[60px] py-[30px] lg:py-[60px]">
            <div class="h-[600px] flex bg-white shadow-lg">

                <aside class="h-full w-[250px] border-r-[1px] border-gray-200 relative">

                    <header class="flex justify-between items-center border-b-[1px] border-gray-200">
                        <h2 class="font-medium text-slate-700 p-2 text-xl text-center">Courses</h2>
                    </header>

                    <ul class="w-[250px]">
                        <li v-for="course in coursesArray" class="relative">
                            <Link :only="['course']"
                                  @click="currentCourse = course"
                                  preserve-state
                                  :class="currentCourse?.id === course?.id ? 'text-white bg-teal-600 hover:!bg-teal-600' : 'text-slate-600' "
                                  class="w-full capitalize flex justify-between items-center p-2 border-b-[1px] border-gray-200 hover:bg-slate-100 hover:cursor-pointer"
                                  :href="route('courses.show', course?.id)"
                            >
                                {{ course?.title }} {{ course?.section}}
                                <button v-if="currentCourse === course" @click="settingsOpen = !settingsOpen">•••</button>
                            </Link>

                            <transition name="fade">
                                <ul v-if="currentCourse === course && settingsOpen" class="absolute -right-[140px] top-0 bg-slate-700 shadow-md">
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
                                class="w-full font-medium p-2 text-slate-600 hover:bg-teal-600 hover:text-white active:bg-teal-900 active:text-white">Join Course
                        </button>
                    </div>
                </aside>

                <section class="w-full h-full">
                    <header class="w-full bg-gray-200 p-4">
                        <h1 class="text-3xl capitalize">{{ currentCourse?.title }} <span class="text-slate-500 text-2xl">({{ currentCourse?.section }})</span></h1>
                        <h2 class="text-xl">{{ currentCourse?.admin_prefix }} {{ currentCourse?.admin_name.split(" ")[1] }}</h2>

                        <div class="flex whitespace-nowrap w-fit">
                            <div class="flex w-fit whitespace-nowrap" @mouseover="copyHintSeen=true" @mouseleave="copyHintSeen=false">
                                <button @click="copyText" class="w-fit whitespace-nowrap flex items-center text-md text-slate-500 select-all cursor-pointer hover:text-blue-600 hover:underline underline-offset-4">{{ currentCourse?.keycode }}</button>
                                <BaseSvg name="icon-clipboard-copy" class="ml-2 opacity-50 scale-75" />
                            </div>
                            <HintTransition :hint-seen="copyHintSeen" name="fade">Click to Copy</HintTransition>
                        </div>
                    </header>

                    <div class="flex justify-between m-6">
                        <article class="w-[400px] h-[400px]">
                            <header class="flex items-center justify-between px-[8px]">
                                <h2 class="text-xl tracking-wider text-slate-600">Announcements</h2>
                                <button class="text-slate-500" @click="announcementModalSeen = !announcementModalSeen">
                                    <BaseSvg name="icon-add-box" class="opacity-75 hover:opacity-100 fill-slate-700" />
                                </button>
                            </header>

                            <ul class="z-0 h-full overflow-y-scroll p-2">
                                <AnnouncementCard v-if="course[0]"
                                                  v-for="announcement in course[0].announcements"
                                                  :announcement="announcement"
                                                  :user="user"
                                                  :course="course"
                                />
                            </ul>
                        </article>

                        <article class="block w-1/2 text-right">

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

            <textarea type="text" :placeholder="`Announce to ${currentCourse.title} (${currentCourse.section})`" rows="6" class="p-2 border border-gray-200 rounded-md resize-none" v-model="announcementForm.body"></textarea>

        </Modal>
    </transition>

    <transition name="fade">
        <Modal v-if="joinCourseModalOpen" :open="joinCourseModalOpen" @close="joinCourseModalOpen = !joinCourseModalOpen" submit-label="Join Course" header="Join Course" :submit-function="joinCourse">

            <input type="text" placeholder="Keycode" class="p-2 border border-gray-200 rounded-md" v-model="keycode">

        </Modal>
    </transition>

</template>

<script setup>
import {debounce} from "lodash";
import {ref, watch} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
import BaseSvg from "@/Components/BaseSvg";
import HintTransition from "@/Components/HintTransition";
import Modal from "@/Components/Modals/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import AnnouncementCard from "@/Components/AnnouncementCard";

const props = defineProps(['course', 'user']);
const accountType = props.user[0].account_type;
const coursesArray = props.user[0]?.courses;

let currentCourse = ref(coursesArray[0]);

const copyHintSeen = ref(false);
const settingsOpen = ref(false);

const createCourseForm = useForm({
    title: null,
    code: null,
    section: null,
    description: null,
});

let createCourseModalOpen = ref(false);
let joinCourseModalOpen = ref(false);
let announcementModalSeen = ref(false);

const copyText = (event) => navigator.clipboard.writeText(event.target.textContent);

const announcementForm = useForm({
    body: null,
});

const createCourse = () => {
    createCourseForm.post(route('courses.store'), {
        onSuccess: () => {
            console.log('Course created successfully!');
            createCourseModalOpen = false;
        },
    });
};

const postAnnouncement = () => {
    announcementForm.post(route('courses.announcements.store', props.course[0].id), {
        onSuccess: () => {
            console.log('Announcement posted successfully!');
            announcementModalSeen = false;
        },
    });
};

const joinCourse = () => {

};

let keycode = ref('');
watch(keycode, value => {
    debounce(() => {
        Inertia.post(`/courses`, {  keycode: value }, {
            preserveState: true,
        });
    }, 800);
});

</script>
