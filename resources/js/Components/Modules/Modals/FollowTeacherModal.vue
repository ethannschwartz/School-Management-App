<template>

    <Modal submit-label="Subscribe for only $8 a month" @close="$emit('close')" header="Subscribe" :submit-function="null">

        <div class="flex items-center justify-between">
            <h2>Teacher</h2>
            <div>{{ teacher.name }}</div>
        </div>

        <div>
            <h2>Courses:</h2>
            <ul class="ml-4 text-slate-400">
                <li v-for="course in teacher.courses">{{ course.title }}</li>
            </ul>
        </div>

    </Modal>

</template>

<script setup>
import {defineProps} from "vue";
import {Modal} from "@/Components";
const props = defineProps(['teacher']);

</script>
