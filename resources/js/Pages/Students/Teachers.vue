<template>

    <section class="bg-teal-100 block px-8 lg:px-16 py-8 lg:py-16">

        <div class="h-[600px] flex bg-white shadow-lg">

            <aside class="relative h-full overflow-hidden w-72 border-r border-gray-200 relative">

                <header class="relative z-40 bg-white flex justify-between items-center border-b border-gray-200">
                    <h2 class="font-medium text-slate-700 p-2 text-xl text-center">Teachers</h2>
                </header>


                    <ul class="duration-150 bg-white h-full">

                        <TransitionGroup name="list">

                            <li v-for="teacher in teachers" class="block bg-white relative" :key="teacher">

                                <TeacherLink :is-seen="isSeen" :teacher="teacher" @click.prevent="isSeen===teacher?.id? isSeen=false : isSeen=teacher?.id" />

                                <Transition name="list">

                                    <CourseLink v-if="isSeen===teacher?.id" :is-seen="isSeen" :teacher="teacher" :key="teacher" />

                                </Transition>

                            </li>

                        </TransitionGroup>

                    </ul>

            </aside>

            <section class="relative w-full overflow-hidden">

                <SectionHeader v-if="teachers.length!==0" :course="course" />

                <div class="flex flex-wrap gap-8 p-8 pb-32 w-full h-full overflow-y-scroll">

                    <FileCard v-for="file in course?.files" :file="file" />

                </div>

            </section>


        </div>
    </section>

    <transition name="fade">

        <JoinCourseModal v-if="modalSeen==='joinCourseModal'" @close="modalSeen=false" />

    </transition>

</template>

<script setup>
import {ref, defineProps} from "vue";
import {FileCard, JoinCourseModal, SectionHeader} from "@/Components";
import {CourseLink, TeacherLink} from "@/Components";

const props = defineProps(['teachers', 'course']);
const modalSeen = ref(false);
const isSeen = ref(props.course?.user?.id);

</script>
