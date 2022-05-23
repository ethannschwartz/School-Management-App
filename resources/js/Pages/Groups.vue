<template>

    <section class="pt-[4em] bg-teal-100">
        <div class="px-[30px] lg:px-[60px] py-[30px] lg:py-[60px]">
            <div class="h-[600px] flex bg-white shadow-lg">

                <aside class="h-full w-[250px] border-r-[1px] border-gray-200 relative">

                    <header class="flex justify-between items-center border-b-[1px] border-gray-200">
                        <h2 class="font-medium text-slate-700 p-2 text-xl text-center">Groups</h2>
                    </header>

                    <ul class="w-[250px]">
                        <li v-for="group in followings" class="relative">
                            <Link :only="['group']"
                                  @click="isGroup = group"
                                  preserve-state
                                  :class="isGroup?.id === group?.id ? 'text-white bg-teal-600 hover:!bg-teal-600' : 'text-slate-600' "
                                  class="w-full capitalize flex justify-between items-center p-2 border-b-[1px] border-gray-200 hover:bg-slate-100 hover:cursor-pointer"
                                  :href="route('groups.show', group?.id)"
                            >
                                {{ group?.title }}
                                <button class="hover:bg-teal-700 px-2 rounded-md" v-if="isGroup.id === group?.id && user.id === group?.user_id" @click="isSeen = 'settings'">•••</button>
                            </Link>

                            <transition name="expand">
                                <ul v-if="isGroup === group && isSeen==='settings'" class="absolute -right-[140px] top-0 bg-slate-700 shadow-md">
                                    <Link class="flex justify-between items-center w-[140px] text-white capitalize block p-2 bg-slate-700 hover:bg-slate-800 hover:cursor-pointer">
                                        Edit
                                        <BaseSvg name="icon-edit" class="fill-slate-100 scale-75" />
                                    </Link>
                                    <Link class="flex justify-between items-center w-[140px] text-white capitalize block p-2 bg-slate-700 hover:bg-slate-800 hover:cursor-pointer">
                                        Delete
                                        <BaseSvg name="icon-delete" class="fill-slate-100 scale-75" />
                                    </Link>
                                </ul>
                            </transition>
                        </li>
                    </ul>

                    <div class="absolute bottom-0 w-full">
                        <div class="border-t-[1px] !w-full border-gray-200 text-center">
                            <button @click="isSeen = 'createGroupModal'"
                                    class="w-full font-medium p-2 text-slate-600 hover:bg-teal-600 hover:text-white active:bg-teal-900 active:text-white">
                                Create Group
                            </button>
                        </div>

                        <div class="border-t-[1px] !w-full border-gray-200  text-center">
                            <button @click="isSeen = 'joinGroupModal'"
                                    class="w-full font-medium p-2 text-slate-600 hover:bg-teal-600 hover:text-white active:bg-teal-900 active:text-white">
                                Join Group
                            </button>
                        </div>
                    </div>
                </aside>

                <section class="w-full h-full">
                    <header class="w-full bg-gray-200 p-4">
                        <h1 class="text-3xl capitalize">{{ group?.title }}</h1>
                        <h2 class="text-xl">{{ group?.user?.name }}</h2>

                        <div class="flex whitespace-nowrap w-fit">
                            <div class="hidden xl:flex w-fit whitespace-nowrap" @mouseover="copyHintSeen=true" @mouseleave="copyHintSeen=false">
                                <button @click="copyText" class="w-fit whitespace-nowrap flex items-center text-md text-slate-500 select-all cursor-pointer hover:text-blue-600 hover:underline underline-offset-4">{{ group?.keycode }}</button>
                                <BaseSvg name="icon-clipboard-copy" class="ml-2 opacity-50 scale-75" />
                            </div>
                            <HintTransition :hint-seen="copyHintSeen" name="fade">Click to Copy</HintTransition>
                        </div>
                    </header>

                    <div class="flex justify-between gap-[16px] m-6">
                        <article class="w-1/2 pr-4 h-[400px] border-r-[1px]">
                            <header class="flex items-center justify-between px-[8px]">
                                <h2 class="text-xl tracking-wider text-slate-600">Announcements</h2>
                                <button class="text-slate-500" @click="isSeen = 'announcementModal'">
                                    <BaseSvg name="icon-add-box" class="opacity-75 hover:opacity-100 fill-slate-700" />
                                </button>
                            </header>

                            <ul class="z-0 h-full overflow-y-scroll p-2">
                                <li v-if="group?.announcements?.length !== 0">
                                    <AnnouncementCard v-for="announcement in group?.announcements" :announcement="announcement" :user="user" :group="group" />
                                </li>

                                <li v-else class="h-full flex items-center justify-center text-center text-slate-600 text-[18px] w-full">
                                    <div class="bg-slate-100 border-[1px] shadow-md rounded-lg px-6 py-2">You don't have any announcements</div>
                                </li>
                            </ul>
                        </article>

                        <article class="block w-1/2 px-4 overflow-hidden">
                            <header>
                                <ul class="flex gap-4 flex-wrap">

                                </ul>
                            </header>

                            <div>

                            </div>


                        </article>
                    </div>
                </section>


            </div>
        </div>
    </section>

    <transition name="fade">
        <Modal v-if="isSeen==='createGroupModal'" :open="isSeen === 'createGroupModal' " @close="isSeen = false" submit-label="Create Course" header="Create Course" :submit-function="createGroup">
            <input type="text" placeholder="Title" class="p-2 border border-gray-200 rounded-md" v-model="createGroupForm.title">
            <textarea type="text" placeholder="Description" rows="6" class="p-2 border border-gray-200 rounded-md resize-none" v-model="createGroupForm.description"></textarea>
        </Modal>
    </transition>

    <transition name="fade">
        <Modal v-if="isSeen==='announcementModal'" :open="isSeen==='announcementModal'" @close="isSeen = false" submit-label="Post Announcement" header="Post Announcement" :submit-function="postAnnouncement">
            <textarea type="text" :placeholder="`Announce to ${group?.title}`" rows="6" class="p-2 border border-gray-200 rounded-md resize-none" v-model="announcementForm.body"></textarea>
        </Modal>
    </transition>

    <transition name="fade">
        <Modal v-if="isSeen ==='joinGroupModal'" :open="isSeen==='joinGroupModal'" @close="isSeen = false" submit-label="Join Group" header="Join Group" :submit-function="joinGroup">
            <input type="text" placeholder="Keycode" class="p-2 border border-gray-200 rounded-md" v-model="joinGroupForm.keycode">
        </Modal>
    </transition>

</template>

<style scoped>
.expand-enter-from, .expand-leave-to {
    opacity:0;
    transform: scaleX(0.5) ;
    transform-origin: left;
}

.expand-enter-to, .expand-leave-from {
    opacity:1;
    transform: scaleX(1);
    transform-origin: left;
}

.expand-enter-active, .expand-leave-active {
    transition: all 0.2s ease-in;
}

.slide-enter-from, .slide-leave-to {
    opacity:0;
    transform: translateX(100%) ;
    transform-origin: left;
}

.slide-enter-to, .slide-leave-from {
    opacity:1;
    transform: translateX(0);
    transform-origin: left;
}

.slide-enter-active, .slide-leave-active {
    transition: all 0.15s ease-in;
}
</style>

<script setup>
import {ref} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
import BaseSvg from "@/Components/BaseSvg";
import HintTransition from "@/Components/HintTransition";
import Modal from "@/Components/Modals/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import AnnouncementCard from "@/Components/AnnouncementCard";

const props = defineProps(['user', 'group', 'groups', 'followings']);
const accountType = props.user.account_type;

const isGroup = ref(props.group);

const copyHintSeen = ref(false);

const createGroupForm = useForm({
    title: null,
    description: null,
});

const joinGroupForm = useForm({
    keycode: '1jsmgqzF4oiL1USUbvL9',
});

const announcementForm = useForm({
    body: null,
});

let isSeen = ref(false);

const createGroup = () => {
    createGroupForm.post(route('groups.store'), {
        onSuccess: () => {
            console.log('Group created successfully!');
            createGroupForm.reset();
            isSeen.value = false;
        },
    });
};

const postAnnouncement = () => {
    announcementForm.post(route('group.announcements.store', props.group?.id), {
        onSuccess: () => {
            console.log('Announcement posted successfully!');
            announcementForm.reset();
            isSeen.value = false;
        },
    });
};

const joinGroup = () => {
    joinGroupForm.post(route('groups.group_follower.store', joinGroupForm.keycode), {
        onSuccess: () => {
            console.log('follow created');
            isSeen.value = false;
        }
    })
};

const copyText = (event) => navigator.clipboard.writeText(event.target.textContent);

</script>
