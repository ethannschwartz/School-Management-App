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

                <section class="relative w-full overflow-hidden">

                    <SectionHeader v-if="courses.length!==0" :course="course" />

                    <div class="flex flex-wrap gap-8 p-8 pb-32 w-full h-full overflow-y-scroll">

                        <FileCard v-for="file in course?.files" :file="file" />

                    </div>

                </section>


            </div>
        </div>
    </section>

</template>

<script setup>
import {ref} from "vue";
import {FileCard, CourseBank, SectionHeader} from "@/Components";

const props = defineProps(['course', 'courses']);
const modalSeen = ref(false);
</script>
