<template>

    <section class="pt-16 bg-teal-100">
        <div class="px-8 lg:px-16 py-8 lg:py-16">
            <div class="h-[600px] flex bg-white shadow-lg">

                <CourseBank :courses="courses" >

                    <div class="border-t !w-full border-gray-200 absolute bottom-0 text-center">
                        <button @click="modalSeen='createCourseModal'"
                                class="w-full font-medium p-2 text-slate-600 hover:bg-teal-600 hover:text-white active:bg-teal-900 active:text-white">
                            Create Course
                        </button>
                    </div>

                </CourseBank>

                <section class="w-full h-full">

                    <header v-if="courses.length !== 0" class="w-full bg-gray-200 p-4">
                        <h1 class="text-3xl capitalize">{{ course?.title }} <span class="text-slate-500 text-2xl">({{ course?.section }})</span></h1>
                        <h2 class="text-xl">{{ course?.user?.prefix }} {{ course?.user?.name?.split(" ")[1] }}</h2>
                    </header>

                    <div class="p-8 w-full h-full">

                        <div class="flex gap-8">

                            <FileCard v-for="file in course?.files" :file="file" />

                            <button @click="modalSeen='uploadFileModal'" class="flex justify-center items-center h-full text-gray-200 text-center w-48 h-72 bg-slate-600 border-slate-500 border rounded-sm relative duration-200 hover:-translate-y-1">
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
        <CreateCourseModal v-if="modalSeen==='createCourseModal'" @close="modalSeen=false" />
    </transition>

    <transition name="fade">
        <UploadFileModal v-if="modalSeen==='uploadFileModal'" :course="course" @close="modalSeen=false" />
    </transition>

</template>

<style>
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
import {FileCard, CourseBank, CreateCourseModal, UploadFileModal, Button} from "@/Components";
import BaseSvg from "@/Components/Modules/BaseSvg";

const props = defineProps(['user', 'course', 'courses']);
const modalSeen = ref(false);


</script>
