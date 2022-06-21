<template>
    <header class="fixed w-full z-30 text-slate-600 bg-white shadow-md">
        <nav class="flex justify-between duration-150 items-center px-4 px-12 lg:px-16 h-[49px] lg:h-[80px]">

            <div class="flex-grow basis-1/4">
                <h1 class="text-xl lg:text-3xl font-semibold hidden lg:block">Publify</h1>
                <h1 class="block lg:hidden">Menu</h1>
            </div>

            <div>
                <h1 class="text-xl lg:text-3xl font-semibold block lg:hidden">Publify</h1>
                <ul class="hidden lg:flex gap-8 items-center">
                    <Link v-if="user?.account_type ==='teacher'"
                          v-for="navLink in teacherLinks"
                          :href="route(navLink.route)"
                          class="duration-200 hover:text-slate-800"
                          :class="$page.url.startsWith(`/${navLink.title.toLowerCase()}`) ? 'text-teal-600 underline underline-offset-4 font-bold hover:text-teal-600' : null"
                    >
                        {{ navLink.title }}
                    </Link>

                    <Link v-else
                          v-for="navLink in studentLinks"
                          :href="route(navLink.route)"
                          class="duration-200 hover:text-slate-800"
                          :class="$page.url.startsWith(`/${navLink.title.toLowerCase()}`) ? 'text-teal-600 underline underline-offset-4 font-bold hover:text-teal-600' : null"
                    >
                        {{ navLink.title }}
                    </Link>
                </ul>
            </div>

            <div class="flex gap-8 items-center justify-end relative flex-grow basis-1/4">
                <h2 class="flex justify-end items-center  cursor-pointer" v-if="user" @click="profileDropdownSeen =! profileDropdownSeen">
                    <BaseSvg name="icon-profile" class="scale-[35%] lg:scale-50 fill-slate-600" />
                    {{ user.name }}
                </h2>

                <transition name="slide-down">
                    <form v-if="profileDropdownSeen" class="absolute -bottom-10 shadow-xl border-[1px] bg-gray-100 hover:bg-gray-200 rounded-md" action="/login">
                        <Link method="post" as="button" :href="route('logout')" class="text-slate-600 rounded-md py-2 px-4">Logout</Link>
                    </form>
                </transition>

            </div>
        </nav>
    </header>
</template>

<style scoped>
.slide-down-enter-from, .slide-down-leave-to {
    opacity:0;
    transform: translateY(-50%);
    transform-origin: top;
}

.slide-down-enter-to, .slide-down-leave-from {
    opacity:1;
    transform: translateY(0%);
    transform-origin: top;
}

.slide-down-enter-active, .slide-down-leave-active {
    transition: all 0.15s ease-in;
}

</style>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import {BaseSvg} from "@/Components";
import {ref} from "vue";

const props = defineProps(['user']);
const profileDropdownSeen = ref(false);

const teacherLinks = [
    {
        title: 'Courses',
        route: 'courses.index',
    },
    {
        title: 'Analytics',
        route: 'courses.index',
    },
];


const studentLinks = [
    {
        title: 'Courses',
        route: 'courses.index',
    },
    {
        title: 'Teachers',
        route: 'users.teachers.index',
    },
];

</script>
