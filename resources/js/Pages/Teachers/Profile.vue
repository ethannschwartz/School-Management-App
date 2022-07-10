<template>

    <section class="bg-teal-100">
        <div class="px-8 lg:px-16 py-8 lg:py-16">
            <div class="h-[600px] flex bg-white shadow-lg w-full">

                <form @submit.prevent="storeProfileDetails" class="block m-12 w-full">

                    <label for="profile_image">
                        <BaseSvg name="icon-profile" class="cursor-pointer mb-4 fill-slate-600 hover:fill-slate-800 active:fill-slate-900" />
                        <input @input="profileDetails.profile_image = $event.target.files[0]"
                               hidden
                               type="file"
                               id="profile_image"
                               name="profile_image"
                               formenctype="multipart/form-data"
                        />
                    </label>

                    <div v-if="profile.institution && edit !== 'institution'" class="flex items-center justify-between mb-4">
                        {{ profile.institution }}
                        <button class="underline underline-offset-4 hover:text-black text-teal-600" @click.prevent="edit === 'institution' ? edit=false: edit = 'institution'">Edit</button>
                    </div>

                    <input v-else type="text" placeholder="Institution" v-model="profileDetails.institution" class="block mb-4"  />

                    <div v-if="profile.institution && edit !== 'subject'" class="flex items-center justify-between mb-4">
                        {{ profile.subject }}
                        <button class="underline underline-offset-4 hover:text-black text-teal-600" @click.prevent="edit === 'subject' ? edit=false: edit = 'subject'">Edit</button>
                    </div>

                    <input v-else type="text" placeholder="Subject" v-model="profileDetails.subject" class="block mb-4"  />

                    <button type="submit" class="w-full rounded-sm p-2 uppercase text-white tracking-wider bg-teal-600 hover:bg-teal-700 active:bg-teal-900">Submit</button>
                </form>

            </div>
        </div>
    </section>

</template>

<script setup>
import {ref} from "vue";
import {BaseSvg} from "@/Components";
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps(['user', 'profile']);
const modalSeen = ref(false);

const edit = ref(false);

const profileDetails = useForm({
    profile_image: null,
    institution: null,
    subject: null,
});

const storeProfileDetails = () => {
    profileDetails.post(route('profile.profile.store', props.user.id), {
        onSuccess: () => {
            console.log('Profile store successful!');
            profileDetails.reset();
        },
    });
};


</script>

