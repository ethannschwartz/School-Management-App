<template>
    <header class="fixed w-full z-30 text-slate-600 bg-white shadow-md">
        <nav class="flex justify-between duration-150 items-center px-4 px-12 lg:px-16 h-[49px] lg:h-[80px]">

            <div class="flex-grow basis-1/4">
                <h1 class="text-xl lg:text-3xl font-semibold hidden lg:block">AroundU High</h1>
                <h1 class="block lg:hidden">Menu</h1>
            </div>

            <div>
                <h1 class="text-xl lg:text-3xl font-semibold block lg:hidden">AroundU High</h1>
                <ul class="hidden lg:flex gap-8 items-center">
                    <Link v-for="navLink in navLinks"
                          :href="route(navLink.route)"
                          class="duration-200 hover:text-slate-800"
                          :class="navLink.title === $inertia.page.component ? 'text-teal-600 underline underline-offset-4 font-bold hover:text-teal-600': null">
                        {{ navLink.title }}
                    </Link>
                </ul>
            </div>

            <div class="flex gap-8 items-center justify-end relative flex-grow basis-1/4">
                <h2 class="flex justify-end items-center  cursor-pointer" v-if="user" @click="profileDropdownSeen =! profileDropdownSeen">
                    <BaseSvg name="icon-profile" class="scale-[35%] lg:scale-50 fill-slate-600" />
                    {{ user[0].name }}
                </h2>
                <transition name="fade">
                    <form v-if="profileDropdownSeen" class="absolute -bottom-10 shadow-xl border-[1px] bg-gray-100 hover:bg-gray-200 rounded-md" action="/login">
                        <Link method="post" as="button" :href="route('logout')" class="text-slate-600 rounded-md py-2 px-4">Logout</Link>
                    </form>
                </transition>

            </div>
        </nav>
    </header>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import BaseSvg from "@/Components/BaseSvg";
import {ref} from "vue";
const props = defineProps(['user']);

const navLinks = [
    {
        id: 1,
        title: 'Courses',
        route: 'courses.index',
    },
    {
        id: 2,
        title: 'Groups',
        route: 'groups.index',
    },
    {
        id: 3,
        title: 'Schedule',
        route: 'groups.index',
    },
    {
        id: 4,
        title: 'Events',
        route: 'groups.index',
    },
    {
        id: 5,
        title: 'Gradebook',
        route: 'groups.index',
    },
];

let currentPage = ref(navLinks[0]);

const profileDropdownSeen = ref(false);





</script>
