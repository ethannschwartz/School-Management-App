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
                                  :class="course?.id === isCourse.id ? 'text-white bg-teal-600 hover:!bg-teal-600' : 'text-slate-600' "
                                  class="w-full capitalize flex justify-between items-center p-2 border-b-[1px] border-gray-200 hover:bg-slate-100 hover:cursor-pointer"
                                  :href="route('courses.show', course?.id)"
                            >
                                {{ course?.title }} ({{ course?.section }})
                                <button class="hover:bg-teal-700 px-2 rounded-md" v-if="course?.id === props.course?.id && user.id === props.course?.user_id" @click="settingsOpen = !settingsOpen">•••</button>
                            </Link>

                            <transition name="expand">
                                <ul v-if="props.course === course && settingsOpen" class="absolute -right-[140px] top-0 bg-slate-700 shadow-md">
                                    <li>
                                        <Link class="flex justify-between items-center w-[140px] text-white capitalize block p-2 bg-slate-700 hover:bg-slate-800 hover:cursor-pointer">
                                            Edit
                                            <BaseSvg name="icon-edit" class="fill-slate-100 scale-75" />
                                        </Link>
                                    </li>
                                    <li>
                                        <Link class="flex justify-between items-center w-[140px] text-white capitalize block p-2 bg-slate-700 hover:bg-slate-800 hover:cursor-pointer">
                                            Delete
                                            <BaseSvg name="icon-delete" class="fill-slate-100 scale-75" />
                                        </Link>
                                    </li>
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
                        <h2 class="text-xl">{{ course?.user?.prefix }} {{ course?.user?.name?.split(" ")[1] }}</h2>
                    </header>


                    <div class="p-8 w-full">
                        <h2 class="mb-4 text-gray-600">{{ course?.user.name }}'s Content</h2>
                        <div class="flex gap-8">

                            <FileCard v-for="file in files" :file="file" />

                            <button @click="uploadFileModalOpen = true" class="flex justify-center items-center h-full text-gray-200 text-center w-48 h-72 bg-slate-600 border-slate-500 border rounded-sm relative duration-200 hover:-translate-y-1">
                                <span class="text-7xl">+</span>
                                <span class="absolute left-0 bottom-0 w-full p-3">Create New</span>
                            </button>

                        </div>
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
        <Modal v-if="joinCourseModalOpen" :open="joinCourseModalOpen" @close="joinCourseModalOpen = !joinCourseModalOpen" submit-label="Join Course" header="Join Course" :submit-function="joinCourse">
            <input type="text" placeholder="Keycode" class="p-2 border border-gray-200 rounded-md" v-model="joinCourseForm.keycode">
        </Modal>
    </transition>

    <transition name="fade">
        <Modal v-if="uploadFileModalOpen" :open="uploadFileModalOpen" @close="uploadFileModalOpen = !uploadFileModalOpen" submit-label="Upload File" header="Upload File" :submit-function="uploadFile">
            <input type="text" placeholder="Title" class="p-2 border border-gray-200 rounded-md" v-model="uploadFileForm.filename">
            <input type="file" placeholder="File" name="file" @input="uploadFileForm.file = $event.target.files[0]">
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
import Modal from "@/Components/Modals/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import FileCard from "@/Components/Cards/FileCard";

const props = defineProps(['user', 'course', 'courses', 'files']);
const isCourse = ref(props.courses[0]);
const accountType = props.user.account_type;
const copyHintSeen = ref(false);
const settingsOpen = ref(false);
let createCourseModalOpen = ref(false);
let joinCourseModalOpen = ref(false);
let uploadFileModalOpen = ref(false);

const createCourseForm = useForm({
    title: null,
    code: null,
    section: null,
    description: null,
});

const joinCourseForm = useForm({
    keycode: null,
});

const uploadFileForm = useForm({
    filename: 'First Chemistry File Upload',
    file: null,
});

const createCourse = () => {
    createCourseForm.post(route('courses.store'), {
        onSuccess: () => {
            console.log('Course created successfully!');
            createCourseForm.reset();
            createCourseModalOpen.value = false;
        },
    });
};

const joinCourse = () => {
    joinCourseForm.post(route('courses.course_follower.store', joinCourseForm.keycode), {
        onSuccess: () => {
            console.log('course follow successful!');
            joinCourseForm.reset();
            joinCourseModalOpen.value = false;
        },
    });
};

const uploadFile = () => {
    uploadFileForm.post(route('courses.file.store'), {
        onSuccess: () => {
            console.log('File upload successful!');
            uploadFileModalOpen.value = false;
        }
    });
};

const copyText = (event) => navigator.clipboard.writeText(event.target.textContent);

const files = [
    {
        title:'Principles of Organic Chemistry',
        link: 'courses.file.show',
        key: 2,
    },
    {
        title:'Advanced Quantum Chemistry Theory',
        link: 'courses.file.show',
        key: 3,
    },
];

</script>
