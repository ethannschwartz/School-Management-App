<template>
    <li @mouseover="exactTimeSeen = true" @mouseleave="exactTimeSeen = false"  class="hover:scale-[102%] mb-4 p-4 bg-slate-100 border-[1px] rounded-lg shadow-md w-full duration-150 z-10 overflow-visible">
        <div class="flex gap-2 items-start">
            <img draggable="false" src="https://i.pravatar.cc/150?img=18" alt="pro-pic" class="w-[40px] rounded-full shadow-md">
            <div>
                <h2 class="font-bold">{{ announcement.prefix }} {{ announcement.name.split(" ")[1] }}</h2>
                <p class="mb-2">{{ announcement.announcement_content }}</p>
            </div>
        </div>
        <div class="text-right text-slate-500 text-xs">
            <div v-if="exactTimeSeen">{{ DateTime.fromISO(announcement.created_at).toFormat('FF') }}</div>
            <div v-else>{{ dayjs(announcement.created_at).fromNow() }}</div>
        </div>

    </li>
</template>

<script setup>
import { DateTime } from 'luxon';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import {ref} from "vue";
dayjs.extend(relativeTime);

const exactTimeSeen = ref(false);
const props = defineProps(['announcement']);


</script>
