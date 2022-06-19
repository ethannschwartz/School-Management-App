<template>
    <Navbar :user="user" />

    <main>
        <slot></slot>
    </main>

    <footer class="w-screen h-[49px] bg-teal-200 text-teal-600 flex justify-center items-center">
        Developed by Publify | 2022
    </footer>
</template>
<script setup>
import Navbar from "@/Components/Modules/Navbar";

const props = defineProps(['user']);


</script>
