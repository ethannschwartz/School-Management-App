<template>

    <section class="bg-teal-100">
        <div class="px-8 lg:px-16 py-8 lg:py-16">
            <div class="h-[600px] flex bg-white shadow-lg">

                <CourseBank :courses="teachers" title="Teachers">

                    <div class="border-t !w-full border-gray-200 absolute bottom-0 text-center">



                    </div>

                </CourseBank>

                <section class="w-full h-full">

                    <SectionHeader v-if="teachers.length!==0" :course="teachers" />

                    <div class="flex gap-8 p-8 w-full">

                        <FileCard v-for="file in teachers.course[0]?.files" :file="file" />

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

const props = defineProps(['teachers']);
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
