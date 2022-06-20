<template>

    <header v-if="course" class="w-full bg-gray-200 p-4">
        <h1 class="text-3xl capitalize">{{ course?.title }} <span class="text-slate-500 text-2xl">({{ course?.section }})</span></h1>
        <h2 class="text-xl">{{ course?.user?.prefix }} {{ course?.user?.name?.split(" ")[1] }}</h2>
    </header>

</template>

<script setup>
const props = defineProps(['course']);

</script>
