<template>
    <section class="flex items-center justify-center bg-slate-800 h-screen w-screen">

        <div class="relative p-8 bg-white border border-slate-200 rounded-md h-96 w-1/2 shadow-2xl">

            <Link :href="route('courses.index')" class="flex items-center gap-1 text-gray-400 hover:text-gray-600 fill fill-gray-400 hover:fill-gray-400 uppercase tracking-widest mb-4">
                <BaseSvg name="icon-chevron-left" class="fill-current" />
                Back
            </Link>

            <header class="pb-4 mb-4 border-b">
<!--                <img :src="teacher.profile?.profile_image" alt="profile_image">-->
                <h1 class="text-gray-600 text-3xl font-medium">{{ teacher.prefix }} {{ teacher.name }}</h1>
                <h2 class="text-gray-600">{{ teacher.profile?.institution }}</h2>
                <h3 class="text-gray-600">{{ teacher.profile?.subject }}</h3>
            </header>

            <div v-if="teacher.courses.length > 0">
                <h2 class="text-gray-600 text-base">Courses</h2>
                <ul class="pl-4 text-gray-600 text-xl">
                    <li v-for="course in teacher.courses">{{ course.title }}</li>
                </ul>
            </div>

            <div class="absolute bottom-4 left-4 right-4 flex justify-center mt-4">
<!--                <Link :href="route('courses.teachers.store', teacher.id)"-->
<!--                      method="post"-->
<!--                      as="button"-->
<!--                      class="text-lg p-2 rounded-md w-full bg-teal-600 text-white hover:bg-teal-700 active:bg-teal-900 whitespace-nowrap"-->
<!--                >-->
<!--                    Subscribe for just $8 monthly-->
<!--                </Link>-->
                <Button v-if="userHasPaymentMethod"
                        color="teal"
                        @click.prevent="modalSeen==='FollowTeacherModal'?modalSeen=false:modalSeen='FollowTeacherModal'"
                >
                    Subscribe for just $8 monthly
                </Button>

                <Link class="inline-flex justify-center w-full items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:shadow-outline-gray transition ease-in-out duration-150 bg-teal-600 hover:bg-teal-700 active:bg-teal-900"
                      v-else
                      as="button"
                      method="get"
                      :href="route('settings.index')"
                >
                    Set Up Payment Method
                </Link>

            </div>

        </div>

    </section>

    <transition name="modal">

        <FollowTeacherModal v-if="modalSeen==='FollowTeacherModal'" @close="modalSeen=false" />

    </transition>
</template>

<script setup>
import {BaseSvg, FollowTeacherModal, Button} from "@/Components";
import {Link} from "@inertiajs/inertia-vue3";
import {ref} from "vue";


const userHasPaymentMethod = ref(false);
const props = defineProps(['teacher']);

const modalSeen = ref(false);

</script>
