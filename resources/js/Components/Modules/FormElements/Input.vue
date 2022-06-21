<template>
    <div class="mb-3">
        <input :type="type"
               :placeholder="placeholder"
               class="p-2 border border-gray-200 rounded-md"
               v-model="modelValue"
        />
    </div>
</template>

<script setup>
import {defineProps} from "vue";
const props = defineProps(['type', 'modelValue', 'placeholder']);
</script>
