<template>

    <section class="pt-[4em] bg-purple-600">
        <div class="px-[30px] lg:px-[60px] py-[30px] lg:py-[60px]">
            <div class="h-[600px] flex bg-white shadow-lg">

                <aside class="h-full w-[250px] border-r-[1px] border-gray-200 relative">

                    <header class="flex justify-between items-center border-b-[1px] border-gray-200">
                        <h2 class="font-medium text-slate-700 p-2 text-xl text-center">Groups</h2>
                    </header>

                    <ul class="w-[250px]">
                        <li v-for="group in groupsArray">
                            <Link :only="['course']"
                                  @click="currentGroup = group"
                                  preserve-state
                                  :class="currentGroup.id === group.id? 'text-white bg-teal-600 hover:bg-teal-600' : 'text-slate-600' "
                                  class="capitalize flex justify-between items-center p-2 border-b-[1px] border-gray-200 hover:bg-slate-100 hover:cursor-pointer"
                                  :href="route('groups.show', group?.id)"
                            >
                                {{ group?.title }}
                            </Link>
                        </li>
                    </ul>

                    <div class="border-t-[1px] !w-full border-gray-200 absolute bottom-0 text-center">
                        <button @click="groupModalOpen = !groupModalOpen"
                                class="w-full font-medium p-2 text-slate-600 hover:bg-teal-600 hover:text-white active:bg-teal-900 active:text-white">Create Group</button>
                    </div>
                </aside>

                <section class="w-full h-full">
                    <header class="w-full bg-gray-200 p-4">
                        <h1 class="text-3xl capitalize">{{ currentGroup?.title }}</h1>
                        <h2 class="text-xl">{{ currentGroup?.admin_name }}</h2>

                        <div class="flex whitespace-nowrap w-fit">
                            <div v-if="currentGroup?.keycode" class="flex w-fit whitespace-nowrap" @mouseover="copyHintSeen=true" @mouseleave="copyHintSeen=false">
                                <button @click="copyText" class="w-fit whitespace-nowrap flex items-center text-md text-slate-500 select-all cursor-pointer hover:text-blue-600 hover:underline underline-offset-4">{{ currentGroup?.keycode }}</button>
                                <BaseSvg name="icon-clipboard-copy" class="ml-2 opacity-50 scale-75" />
                            </div>
                            <HintTransition :hint-seen="copyHintSeen" name="fade">Click to Copy</HintTransition>
                        </div>
                    </header>

                    <div class="flex justify-between m-6">
                        <article class="w-[400px] h-[400px]">

                        </article>

                        <article class="block w-1/2 text-right">

                        </article>
                    </div>
                </section>


            </div>
        </div>
    </section>

    <Modal v-if="groupModalOpen" :open="groupModalOpen" @close="groupModalOpen = !groupModalOpen" submit-label="Create Group" header="Create Group" :submit-function="createGroup">

        <input type="text" placeholder="Title" class="p-2 border border-gray-200 rounded-md" v-model="groupForm.title">
        <textarea type="text" placeholder="Description" rows="6" class="p-2 border border-gray-200 rounded-md resize-none" v-model="groupForm.description"></textarea>

    </Modal>


</template>

<script setup>
import Modal from "@/Components/Modals/Modal";
import Button from "../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Button";
import {onMounted, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import BaseSvg from "@/Components/BaseSvg";
import HintTransition from "@/Components/HintTransition";
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps(['user', 'group']);

const groupsArray = props.user[0].groups;
let currentGroup = ref(groupsArray[0]);

const emailHintSeen = ref(false);
const copyHintSeen = ref(false);

const groupForm = useForm({
    title: null,
    description: null,
});

const groupModalOpen = ref(false);

const createGroup = () => {
    groupForm.post(route('groups.store'), {
        onFinish: () => console.log('Group created successfully!'),
    });
}

const copyText = (event) => navigator.clipboard.writeText(event.target.textContent);

</script>
