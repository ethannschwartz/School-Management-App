<template>

    <section class="bg-teal-100">
        <div class="px-8 lg:px-16 py-8 lg:py-16">
            <div class="h-[600px] flex bg-white shadow-lg">

                <section class="text-gray-600 w-full h-full">

                    <div class="flex gap-8 p-8">

                        <div>

                            <div>Subscribers</div>
                            <button class="text-4xl text-teal-600 underline-offset-4 hover:underline hover:text-black">{{ subscriberCount }}</button>

                        </div>

                        <div>

                            <div>Change</div>
                            <button class="text-4xl text-teal-600 underline-offset-4 hover:underline hover:text-black">120.2%</button>

                        </div>

                        <div>

                            <div>Monthly Est.</div>
                            <button class="text-4xl text-teal-600 underline-offset-4 hover:underline hover:text-black">
                                ${{ estimatedProfit.toFixed(2) }}
                            </button>

                        </div>

                    </div>

                    <div class="flex gap-12 p-8">

                        <div>

                            <h2 class="text-base text-gray-500">Courses</h2>

                            <ul class="text-3xl text-gray-600">
                                <li class="text-teal-600" v-for="course in courses">{{ course.title }} {{ course.section }}</li>
                            </ul>

                        </div>

                        <div>

                            <h2 class="text-base text-gray-500">Texts</h2>

                            <ul class="text-3xl text-gray-600">
                                <li v-for="file in files" class="capitalize text-teal-600">{{ file.title }}</li>
                            </ul>

                        </div>

                    </div>

                </section>

            </div>
        </div>
    </section>

</template>

<script setup>
import {ref} from "vue";
const props = defineProps(['courses', 'subscribers', 'files']);
const modalSeen = ref(false);

const subscriberCount = ref(252)
const estimatedProfit = ref(subscriberCount.value * 4);

</script>

