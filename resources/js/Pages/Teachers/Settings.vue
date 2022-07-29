<template>
    <section class="w-full flex items-center justify-center h-screen">
        <div class="flex w-full bg-white h-[600px] mx-16 shadow-xl">

            <nav class="w-64 text-base h-full space-y-1.5 p-4">
                <h2 class="pt-4 px-4 text-gray-800 text-lg">Settings</h2>

                <button type="button"
                        v-for="setting in config.settings"
                        @click="currentSection=setting.title"
                        :class="currentSection===setting.title?'bg-gray-600 text-white hover:text-white hover:bg-gray-600':'text-gray-500'"
                        class="flex items-center gap-2 text-left w-full capitalize text-lg px-4 py-2 text-gray-500 hover:text-gray-800 hover:bg-gray-100 rounded-md"
                >
                    <BaseSvg :name="setting.svg" :class="currentSection===setting.title? 'fill-white': 'fill-gray-600'" />
                    {{ setting.title }}
                </button>
            </nav>

            <div v-if="currentSection==='Profile'" class="p-8 text-gray-600 w-96">
                <h2 class="text-3xl mb-8 capitalize">{{ user.name }}</h2>
                <div class="m-4">
                    <div class="w-full flex justify-between items-center mb-4">
                        <p class="text-xl">{{ user.email }}</p>
                        <button>
                            <span>
                                <BaseSvg name="icon-edit" class="fill-slate-600 hover:fill-teal-600" />
                            </span>
                        </button>
                    </div>
                    <p class="text-xl capitalize mb-4">{{ user.account_type }}</p>
                    <form class="flex items-center gap-3">
                        <select v-model="schoolAffiliation" class="rounded-sm text-gray-500 border-gray-400">
                            <option value="" class="text-black" disabled>Please Select a School</option>
                            <option v-for="school in config.schools" :value="school">{{ school }}</option>
                        </select>
                        <button v-if="schoolAffiliation" class="duration-150 bg-gray-800 hover:bg-teal-700 p-2 rounded-sm">
                            <BaseSvg name="icon-check" class="fill-white"/>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>
</template>

<script setup>
import config from "@/config";
import {useForm} from "@inertiajs/inertia-vue3";
import {BaseSvg} from "@/Components";
import {ref} from "vue";

const props = defineProps(['user']);
const currentSection = ref(config.settings[0].title);
const schoolAffiliation = ref('');

const creditCardForm = useForm({
    cardholder_name: null,
    card_number: null,
    expiration_date: null,
    security_code: null,
});
</script>
