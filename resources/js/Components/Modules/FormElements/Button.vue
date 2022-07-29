<template>

    <Link v-if="inertia"
          :href="route(route.name, route.key)"
          :preserve-state="preserve_state"
          :preserve_scroll="preserve_scroll"
          :only="only"
          as="button"
          :class="classes"
          class="inline-flex justify-center w-full items-center px-4 py-2 border border-transparent rounded font-semibold text-xs text-center text-white uppercase tracking-widest focus:outline-none focus:shadow-outline-gray transition ease-in-out duration-150"
    >
        <slot />
    </Link>

    <button v-else
            :type="type"
            :class="classes"
            class="inline-flex justify-center items-center w-full px-4 py-2 border border-transparent rounded font-semibold text-xs text-center text-white uppercase tracking-widest focus:outline-none focus:shadow-outline-gray transition ease-in-out duration-150"
    >
        <slot />
    </button>

</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
const route=  false;
const props = defineProps(['type','color','inertia','href','key','preserve_state','preserve_scroll','only']);

let classes = `bg-${props.color}-600 hover:bg-${props.color}-700 active:bg-${props.color}-900 focus:border-${props.color}-900`;

</script>
