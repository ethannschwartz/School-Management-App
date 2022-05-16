<template>
    <section class="pt-[4em] bg-teal-100 text-slate-600">
        <div class="px-[30px] lg:px-[60px] py-[30px] lg:py-[60px]">

            <div class="h-[600px] flex bg-white shadow-lg p-[32px]">
                <div class="w-[400px] border-r-[1px] pr-[32px]">
                    <h1 class="text-slate-600 text-[23px] mb-[0.8em] text-center">{{ user[0]?.prefix }} {{ user[0]?.name }}</h1>

                    <div class="mb-[1em] w-full">
                        <div class="relative w-fit shadow-md border-[1px] mx-auto rounded-lg overflow-hidden"
                             @mouseover="isFocused='profile_picture'"
                             @mouseleave="isFocused=false"
                        >
                            <img src="https://i.pravatar.cc/150?img=18" alt="profile-pic" class="mx-auto">
                            <button @click="editPhotoModal=true" v-if="isFocused==='profile_picture'" class="flex items-center justify-center w-full h-[30px] bg-gray-900/30 text-center text-white absolute bottom-0">Edit</button>
                        </div>
                    </div>

                    <div class="flex justify-between items-center w-full border-b-[1px] py-[0.8em]">
                        <div class="flex gap-4">
                            <div>Email</div>
                            <div>{{ user[0]?.email }}</div>
                        </div>
                        <button class="hover:underline underline-offset-4 text-pink-600 hover:text-black">Edit</button>
                    </div>

                    <div class="flex justify-between items-center w-full border-b-[1px] py-[0.8em]">
                        <div class="flex gap-4">
                            <div>School</div>
                            <div>Newton South High School</div>
                        </div>
                        <button class="hover:underline underline-offset-4 text-pink-600 hover:text-black">Edit</button>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <transition name="fade">
        <Modal v-if="editPhotoModal" :open="editPhotoModal" @close="editPhotoModal = !editPhotoModal" submit-label="Upload Photo" header="Edit Photo" :submit-function="changePhoto">
            <img v-if="photoForm.photo" :src="photoForm.photo" alt="photo_preview">
            <input  type="file" v-model="photoForm.photo" />
            <FilePond name="photo" ref="pond" label-idle="Click to choose photo" server="/profile" />
        </Modal>
    </transition>
</template>

<script setup>
import {defineProps, ref} from "vue";
import Modal from "@/Components/Modals/Modal";
import {useForm} from "@inertiajs/inertia-vue3";
import vueFilePond from 'vue-filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';

import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

const props = defineProps(['user']);

const isFocused = ref(false);

let editPhotoModal = ref(false);

const photoForm = useForm({
    photo: null,
});

const changePhoto = () => {
    photoForm.post(route('profile.store'), {
        onSuccess: () => console.log('Photo uploaded'),
    })
}


</script>
