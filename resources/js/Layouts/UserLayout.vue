<template>
    <Navbar :user="user" />

    <main>
        <slot></slot>
    </main>

    <footer class="w-screen h-[49px] bg-purple-700 flex justify-center items-center">
        Developed by Ethan Schwartz | 2022
    </footer>
</template>
<script setup>
import Navbar from "@/Components/Navbar";

const props = defineProps(['user']);


</script>
