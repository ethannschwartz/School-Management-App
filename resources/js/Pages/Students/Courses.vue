<template>

    <section class="bg-teal-100">
        <div class="px-8 lg:px-16 py-8 lg:py-16">
            <div class="h-[600px] flex bg-white shadow-lg">

                <CourseBank :courses="courses" title="Courses" >

                    <div class="border-t !w-full border-gray-200 absolute bottom-0 text-center">

                        <button @click="modalSeen='joinCourseModal'"
                                class="w-full font-medium p-2 text-slate-600 hover:bg-teal-600 hover:text-white active:bg-teal-900 active:text-white">
                            Join Course
                        </button>

                    </div>

                </CourseBank>

                <section class="w-full h-full">

                    <SectionHeader v-if="courses.length!==0" :course="course" />

                    <div class="flex gap-8 p-8 w-full">

                        <FileCard v-for="file in course?.files" :file="file" />

                    </div>

                </section>


            </div>
        </div>
    </section>

    <transition name="fade">

        <JoinCourseModal v-if="modalSeen==='joinCourseModal'" @close="modalSeen=false" />

    </transition>

</template>

<script setup>
import {ref} from "vue";
import {FileCard, CourseBank, JoinCourseModal, SectionHeader} from "@/Components";

const props = defineProps(['course', 'courses', 'course_search']);
const modalSeen = ref(false);

</script>
