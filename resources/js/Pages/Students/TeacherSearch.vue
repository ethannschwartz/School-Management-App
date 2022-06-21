<template>

    <section class="h-screen bg-teal-100 flex justify-center items-center">

        <div class="w-2/3 bg-white text-slate-600 shadow-xl p-16">

            <input type="text"
                   class="p-2 border-b border-x-0 border-t-0 mb-3 text-3xl w-full focus:outline-none focus:ring-0"
                   v-model="search"
                   placeholder="Search"
            />


            <h1>Teachers:</h1>

            <ul class="p-2">
                <li class="flex items-center justify-between border-t p-2 text-lg" v-for="teacher in teachers">
                    <span>{{ teacher.name }}</span>
                    <Link :href="route('users.store_subscription', teacher)"
                          method="post"
                          as="button"
                          preserve-state
                          preserve-scroll
                          :only="['teacher']"
                          class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:shadow-outline-gray transition ease-in-out duration-150 bg-blue-600 hover:bg-blue-700 active:bg-blue-900"
                    >
                        Subscribe
                    </Link>
                </li>
            </ul>
        </div>

    </section>

    <FollowTeacherModal v-if="follow!==false" @close="follow=false" :teacher="follow" />


</template>

<script setup>
import {defineProps, ref} from "vue";
import {Button, FollowTeacherModal} from "@/Components";
import {Link} from "@inertiajs/inertia-vue3";
const props = defineProps(['teachers', 'user']);

let follow = ref(false);
let search = ref('');

</script>
