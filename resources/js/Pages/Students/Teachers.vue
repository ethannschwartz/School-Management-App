<template>

    <section class="bg-teal-100 block px-8 lg:px-16 py-8 lg:py-16">

        <div class="h-[600px] flex bg-white shadow-lg">

            <aside class="relative h-full overflow-hidden w-72 border-r border-gray-200 relative">

                <TransitionGroup name="list" >

                    <header key="header" class="text-left relative z-40 bg-white block border-gray-200">

                        <div class="flex justify-between items-center relative z-50 bg-white border-b">
                            <h2 class="font-medium text-slate-700 p-2 text-xl relative z-50">Teachers</h2>
                            <button @click.prevent="isSeen==='search'?isSeen=false:isSeen='search'" >
                                <BaseSvg :name="isSeen==='search'?'icon-closing-x':'icon-search'" class="scale-75 duration-150 fill-slate-400 mx-2 hover:fill-slate-800"/>
                            </button>
                        </div>

                        <Transition name="list">
                            <div v-if="isSeen==='search'" class="relative z-0 flex items-center bg-slate-800 text-slate-200 w-full overflow-hidden">
                                <BaseSvg name="icon-search" class="fill-slate-200 mx-2" />
                                <input type="text" v-model="search " placeholder="Search" class="bg-slate-800 py-2 px-0 w-full border-0 focus:outline-none focus:ring-0" >
                            </div>
                        </Transition>

                    </header>


                    <ul key="courses" class="duration-150 bg-white h-full relative z-40 overflow-hidden">

                        <TransitionGroup name="list">

                            <li v-if="isSeen==='search'"
                                :key="teacher.name"
                                v-for="teacher in teacher_search?.data"
                                class="flex items-center justify-between w-full font-medium p-2 text-white bg-slate-800 hover:bg-slate-900 border-b border-t first-of-type:border-t-0 border-t-slate-500 border-slate-700 hover:border-white"
                            >
                                <Link as="button" :href="route('teachers.get_info', teacher)" class="block text-left w-full">
                                    <span class="block">
                                        <span class="font-medium">{{ teacher?.name }}</span>
                                        <span class="block text-slate-400 text-xs" v-for="course in teacher?.courses">{{ course.title }}</span>
                                    </span>
                                    <span class="text-slate-300">{{ teacher?.section }}</span>
                                </Link>
                            </li>

                            <li v-for="teacher in teachers" class="block bg-white relative" :key="teacher">

                                <TeacherLink :is-seen="isSeen" :teacher="teacher" @click.prevent="isSeen===teacher?.id? isSeen=false : isSeen=teacher?.id" />

                                <Transition name="list">

                                    <CourseLink v-if="isSeen===teacher?.id" :is-seen="isSeen" :teacher="teacher" :key="teacher" />

                                </Transition>

                            </li>

                        </TransitionGroup>

                    </ul>

                </TransitionGroup>

            </aside>

            <section class="relative w-full overflow-hidden">

                <SectionHeader v-if="teachers.length!==0" :course="course" />

                <div class="flex flex-wrap gap-8 p-8 pb-32 w-full h-full overflow-y-scroll">

                    <FileCard v-for="file in course?.files" :file="file" />

                </div>

            </section>


        </div>
    </section>

</template>

<script setup>
import {ref, watch, defineProps} from "vue";
import {FileCard, SectionHeader, CourseLink, TeacherLink, BaseSvg} from "@/Components";
import {Inertia} from "@inertiajs/inertia";
import {Link} from "@inertiajs/inertia-vue3";
import {debounce} from "lodash";

const props = defineProps(['teachers', 'teacher_search' , 'course']);
const modalSeen = ref(false);
const isSeen = ref(props.course?.user?.id);

let search = ref('');

watch(search, debounce((value) => {
    Inertia.get(route('teachers.index'), { search : value }, {
        preserveState: true,
        preserveScroll: true,
    });
}, 200));

</script>
