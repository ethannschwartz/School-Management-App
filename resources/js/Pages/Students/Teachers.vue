<template>

    <section class="bg-teal-100">
        <div class="px-8 lg:px-16 py-8 lg:py-16">
            <div class="h-[600px] flex bg-white shadow-lg">

                <aside class="relative z-40 h-full w-64 border-r border-gray-200 relative">

                    <header class="relative z-40 bg-white flex justify-between items-center border-b border-gray-200">
                        <h2 class="relative font-medium text-slate-700 p-2 text-xl text-center">Teachers</h2>
                    </header>

                    <ul class="duration-150 w-full relative z-30">

                        <li v-for="teacher in teachers" class="relative z-30">
                            <button @click.prevent="isSeen===teacher.id? isSeen=false : isSeen=teacher.id"
                                    class="duration-150 relative z-30 flex items-center justify-between w-full font-medium p-2 text-slate-600 hover:bg-slate-100 active:bg-slate-200 active:text-black border-b"
                            >
                                {{ teacher.name }}
                                <BaseSvg name="icon-chevron-left" class="duration-150 fill-slate-600" :class="isSeen===teacher.id? '-rotate-90' : null" />
                            </button>
                            <transition name="slide">
                                <ul v-if="isSeen===teacher?.id" class="relative z-10">
                                    <Link class="block w-full font-medium p-2 text-white bg-slate-600 hover:bg-slate-800 active:bg-slate-900 border-b border-t first-of-type:border-t-0 border-t-slate-500 border-slate-700"
                                        :class="isSeen===teacher?.id ? 'hover:!bg-slate-700' : 'bg-slate-600' "
                                        v-for="course in teacher.courses">
                                        {{ course.title }}
                                    </Link>
                                </ul>
                            </transition>
                        </li>

                    </ul>

                </aside>

                <section class="w-full h-full">

                    <SectionHeader v-if="teachers.length!==0" :course="teachers" />

                    <div class="flex gap-8 p-8 w-full">

                        <FileCard v-for="file in teachers.course?.files" :file="file" />

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
import {ref, defineProps} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
import {BaseSvg, FileCard, JoinCourseModal, SectionHeader} from "@/Components";

const props = defineProps(['teachers']);
const modalSeen = ref(false);
const isSeen = ref(false);

</script>
