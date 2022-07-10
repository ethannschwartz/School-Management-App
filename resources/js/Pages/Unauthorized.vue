<template>

    <section class="block items-center justify-center h-screen w-screen bg-teal-100">

        <div class="block bg-white text-gray-500 p-4 text-xl shadow-2xl">
            You are unauthorized to view this page. Please check back soon!
        </div>

        <Link :href="route('courses.index')">Take me to my courses</Link>

    </section>

</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";

</script>
