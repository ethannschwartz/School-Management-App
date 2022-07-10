<template>

    <Modal submit-label="Subscribe for only $8 a month" @close="$emit('close')" header="Subscribe" :submit-function="null">

        <div class="flex items-center justify-between">
            <div>{{ teacher?.name }}</div>
        </div>

        <ul class="ml-4 text-slate-400">
            <li v-for="course in teacher?.courses">{{ course?.title }}</li>
        </ul>

        <form class="w-full space-y-3">

            <input class="w-full rounded-md border-gray-400" placeholder="Cardholder Name" type="text" v-model="creditCardForm.cardholder_name">
            <div class="flex gap-3">
                <input class="w-full rounded-md border-gray-400" placeholder="Card Number" type="text" v-model="creditCardForm.card_number">
                <input class="w-full rounded-md border-gray-400" placeholder="Exp Date" type="text" v-model="creditCardForm.expiration_date">
            </div>
            <input class="w-full rounded-md border-gray-400" placeholder="Security Code" type="text" v-model="creditCardForm.security_code">

        </form>

    </Modal>

</template>

<script setup>
import {defineProps} from "vue";
import {Modal} from "@/Components";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
const props = defineProps(['teacher']);

const creditCardForm = useForm({
    cardholder_name: null,
    card_number: null,
    expiration_date: null,
    security_code: null,
});

const submitPayment = () => {

};

</script>
