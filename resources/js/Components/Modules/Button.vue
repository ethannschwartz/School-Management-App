<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
        <slot />
    </button>

</template>

<script setup>
const props = defineProps(['type', 'color']);
let classes = `bg-${props.color}-600 hover:bg-${props.color}-700 active:bg-${props.color}-900 focus:border-${props.color}-900`;

</script>
