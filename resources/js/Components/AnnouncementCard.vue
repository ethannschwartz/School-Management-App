<template>
    <li @mouseover="exactTimeSeen=true; announcementButtonsSeen=true" @mouseleave="exactTimeSeen=false; announcementButtonsSeen=false" class="hover:scale-[102%] mb-4 p-4 bg-slate-100 border-[1px] rounded-lg shadow-md w-full duration-150 z-10 overflow-visible">
        <div class="flex items-start justify-between">
            <div class="flex gap-2 items-start">
                <img draggable="false" :src="`https://i.pravatar.cc/150?img=${announcement?.user_id + 17}`" alt="pro-pic" class="w-[40px] rounded-lg shadow-md">
                <div>
                    <h2 class="font-bold text-slate-600">{{ announcement?.prefix }} {{ announcement?.name?.split(' ')[1] }}</h2>

                    <form v-if="isEditing" class="w-full flex items-center gap-2">
                        <input type="text" :value="announcement?.body" autofocus class="rounded-md my-[0.8em] h-[32px]" />
                        <button class="bg-pink-600 text-white rounded-md my-[0.8em] h-[32px] px-[8px] hover:bg-pink-700">Submit</button>
                    </form>

                    <p v-else class="mb-2 text-slate-600">{{ announcement?.body }}</p>
                </div>
            </div>

            <div v-if="announcementButtonsSeen && (user.id === course.user_id )" class="flex">
                <button @click="isEditing = !isEditing">
                    <BaseSvg name="icon-edit" class="opacity-50 hover:opacity-100 scale-75" />
                </button>
                <Link as="button" method="DELETE" :href="route('courses.announcements.delete', announcement)">
                    <BaseSvg name="icon-closing-x-circle" class="opacity-50 hover:opacity-100 scale-75" />
                </link>
            </div>
        </div>
        <div class="text-right text-slate-500 text-xs">
            <div v-if="exactTimeSeen">{{ DateTime.fromISO(announcement?.created_at).toFormat('FF') }}</div>
            <div v-else>{{ dayjs(announcement?.created_at).fromNow() }}</div>
        </div>

    </li>
</template>

<script setup>
import { DateTime } from 'luxon';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import {ref} from "vue";
import BaseSvg from "@/Components/BaseSvg";
import {Link} from "@inertiajs/inertia-vue3";

dayjs.extend(relativeTime);

let exactTimeSeen = ref(false);
const props = defineProps(['user','announcement', 'course']);
const announcementButtonsSeen = ref(false);

const isEditing = ref(false);

</script>
