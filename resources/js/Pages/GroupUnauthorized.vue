<template>
    <div class="text-center w-screen h-screen flex items-center justify-center bg-slate-800 text-white text-[35px]">
        <div class="w-2/3 h-2/3 border-[1px] border-white rounded-md">
            <header class="h-[49px] p-4 text-left">
                You are not subscribed to <strong>{{ group.title }}</strong>
                <p class="text-[18px]">If you would like to join, please email admin {{ group.user.name }} at {{ group.user.email }}</p>
            </header>
        </div>
    </div>
</template>

<script setup>
import {defineProps} from "vue";

const props = defineProps(['user', 'group']);
</script>
