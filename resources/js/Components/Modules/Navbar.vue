<template>
    <header class="fixed w-full z-[70] text-slate-600 bg-white shadow-md">
        <nav class="flex justify-between duration-150 items-center px-4 px-12 lg:px-16 h-[49px] lg:h-[80px]">

            <div class="flex-grow basis-1/4">
                <h1 class="text-xl lg:text-3xl font-semibold hidden lg:block">Publify</h1>
                <h1 class="block lg:hidden">Menu</h1>
            </div>

            <div>
                <h1 class="text-xl lg:text-3xl font-semibold block lg:hidden">Publify</h1>
                <ul class="hidden lg:flex gap-8 items-center">

                    <Link v-if="user?.account_type ==='teacher'"
                          v-for="navLink in config.nav.teacherLinks"
                          :href="route(navLink.route)"
                          class="duration-150 px-3 py-1 rounded border border-white active:bg-slate-200"
                          :class="$page.url.startsWith(`/${navLink.title.toLowerCase()}`) ? 'text-white bg-slate-800' : 'hover:bg-gray-100'"
                    >
                        {{ navLink.title }}
                    </Link>

                    <Link v-else
                          v-for="navLink in config.nav.studentLinks"
                          :href="route(navLink.route)"
                          class="duration-150 px-3 py-1 rounded border border-white"
                          :class="$page.url.startsWith(`/${navLink.title.toLowerCase()}`) ? 'text-white bg-slate-800' : 'hover:bg-gray-400'"
                    >
                        {{ navLink.title }}
                    </Link>

                </ul>
            </div>

            <div class="group flex gap-8 items-center justify-end relative flex-grow basis-1/4">

                <h2 class="flex justify-end gap-2 items-center cursor-pointer text-gray-600 hover:text-gray-800 active:text-black select-none" v-if="user">
                    <button class="flex items-center gap-2" @focusin="profileDropdownSeen=true" @focusout="profileDropdownSeen=false">
                        <BaseSvg name="icon-profile" class="scale-75 md:scale-100 fill-slate-600" />
                        {{ user.name }}
                        <BaseSvg :name="profileDropdownSeen? 'icon-chevron-down' : 'icon-chevron-up'" />
                    </button>
                </h2>

                <transition name="slide-down">
                    <form v-if="profileDropdownSeen" class="absolute -bottom-10 shadow-xl border bg-gray-100 hover:bg-gray-200 rounded" action="/login">
                        <Link method="post"
                              as="button"
                              :href="route('logout')"
                              class="text-slate-600 py-1 px-4"
                        >
                            Logout
                        </Link>
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
import config from "@/config";
import {Link} from "@inertiajs/inertia-vue3";
import {BaseSvg} from "@/Components";
import {ref} from "vue";

const props = defineProps(['user']);
const profileDropdownSeen = ref(false);

</script>
