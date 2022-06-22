<template>
    <Navbar :user="user" />

    <main class="pt-14">
        <slot></slot>
    </main>

    <footer class="w-screen h-14 bg-teal-200 text-teal-600 flex justify-center items-center">
        Developed by Publify | 2022
    </footer>
</template>

<script setup>
import {Navbar} from "@/Components";
const props = defineProps(['user']);

</script>


<style>
.slide-enter-from, .slide-leave-to {
    overflow:hidden;
    transform: translateY(-100%) ;
}

.slide-enter-to, .slide-leave-from {
    transform: translateY(0);
}

.slide-enter-active, .slide-leave-active {
    transition: all 0.15s ease-in;
}
</style>
