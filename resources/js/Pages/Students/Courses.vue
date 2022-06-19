<template>

    <section class="pt-16 bg-teal-100">
        <div class="px-8 lg:px-16 py-8 lg:py-16">
            <div class="h-[600px] flex bg-white shadow-lg">

                <CourseBank :courses="courses" >

                    <div class="border-t !w-full border-gray-200 absolute bottom-0 text-center">

                        <button @click="modalSeen='joinCourseModal'"
                                class="w-full font-medium p-2 text-slate-600 hover:bg-teal-600 hover:text-white active:bg-teal-900 active:text-white">
                            Join Course
                        </button>

                    </div>

                </CourseBank>

                <section class="w-full h-full">

                    <header v-if="course" class="w-full bg-gray-200 p-4">
                        <h1 class="text-3xl capitalize">{{ course?.title }} <span class="text-slate-500 text-2xl">({{ course?.section }})</span></h1>
                        <h2 class="text-xl">{{ course?.user?.prefix }} {{ course?.user?.name?.split(" ")[1] }}</h2>
                    </header>


                    <div class="flex gap-8 p-8 w-full">

                        <FileCard v-for="file in course?.files" :file="file" />

                    </div>

                </section>


            </div>
        </div>
    </section>

    <transition name="fade">

        <JoinCourseModal v-if="modalSeen==='joinCourseModal'" />

    </transition>

</template>

<script setup>
import {ref} from "vue";
import {FileCard, CourseBank, JoinCourseModal} from "@/Components";

const props = defineProps(['user', 'course', 'courses']);
const modalSeen = ref(false);

</script>

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
