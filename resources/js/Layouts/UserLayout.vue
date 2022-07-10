<template>

    <Navbar :user="user" />

    <main class="pt-10 lg:pt-14 relative">
        <slot></slot>
    </main>

    <footer class="absolute lg:relative bottom-0 w-screen h-24 lg:h-14 bg-teal-200 text-teal-600 flex justify-center items-center">
        Developed by Publify | 2022
    </footer>

</template>

<script setup>
import {Navbar} from "@/Components";
import {InertiaProgress} from "@inertiajs/progress";
const props = defineProps(['user']);

InertiaProgress.init({
    delay: 250,
    color: '#48c499',
    includeCSS: true,
    showSpinner: false,
})
</script>


<style>
/*Slide*/
.slide-enter-from,
.slide-leave-to {
    overflow: hidden;
    transform: translateY(-100%);
}

.slide-enter-to,
.slide-leave-from {
    transform: translateY(0);
}

.slide-enter-active,
.slide-leave-active {
    transition: all 0.4s ease-in;
}

.slide-enter-active {
    position: relative;
}

/*List*/
.list-move,
.list-enter-active,
.list-leave-active {
    transition: all 0.3s ease;
    overflow: hidden;
}

.list-enter-from,
.list-leave-to {
    transform: translateY(-100%);
    overflow: hidden;
}

.list-leave-active {
    position: absolute;
    overflow: hidden;
}

/*Modal*/
.modal-enter-active {
    transition: all 0.3s ease;
}

.modal-leave-active {
    transition: all 0.3s;
}

.modal-enter-from,
.modal-leave-to {
    transform: scale(1);
    opacity: 0;
}

</style>
