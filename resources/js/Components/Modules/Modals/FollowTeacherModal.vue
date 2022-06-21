<template>

    <Modal submit-label="Subscribe for only $8 a month" @close="$emit('close')" header="Subscribe" :submit-function="null">

        <div class="flex items-center justify-between">
            <div>Teacher</div>
            <div>{{ teacher.name }}</div>
        </div>

        <div class="flex items-center justify-between">
            <div>Teacher</div>
            <div>{{ teacher.name }}</div>
        </div>

        <div class="flex items-center justify-between">
            <div>Teacher</div>
            <div>{{ teacher.name }}</div>
        </div>
    </Modal>

</template>

<script setup>
import {defineProps} from "vue";
import {Modal} from "@/Components";
const props = defineProps(['teacher']);

</script>
