<template>

    <section class="bg-teal-100">
        <div class="px-8 lg:px-16 py-8 lg:py-16">
            <div class="h-[600px] flex bg-white shadow-lg">

                <CourseBank :courses="courses" >

                </CourseBank>

                <section class="w-full h-full">

                    <div class="p-8">
                        Roster:

                        <ul>
                            <li v-for="subscriber in subscribers">{{ subscriber.name }}</li>
                        </ul>
                    </div>

                </section>

            </div>
        </div>
    </section>

</template>

<script setup>
import {ref} from "vue";
import {CourseBank} from "@/Components";

const props = defineProps(['user', 'course', 'courses', 'subscribers']);
const modalSeen = ref(false);


</script>

