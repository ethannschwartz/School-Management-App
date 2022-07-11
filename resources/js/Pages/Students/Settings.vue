<template>

    <section class="w-full flex items-center justify-center h-screen bg-teal-100">

        <div class="w-[500px]">

            <form class="w-full p-8 bg-white space-y-3 shadow-xl">

                <h2 class="text-slate-600 text-xl md:text-2xl lg:text-3xl mb-4">Set Up a Payment Method</h2>

                <input class="w-full rounded-md border-gray-400" placeholder="Cardholder Name" type="text" v-model="creditCardForm.cardholder_name">
                <input class="w-full rounded-md border-gray-400" placeholder="Card Number" type="text" v-model="creditCardForm.card_number">
                <div class="flex gap-3">
                    <input class="w-full rounded-md border-gray-400" placeholder="Exp Date" type="text" v-model="creditCardForm.expiration_date">
                    <input class="rounded-md border-gray-400" placeholder="Security Code" type="text" v-model="creditCardForm.security_code">
                </div>

                <Button color="teal" class="w-full justify-center mt-4" >Continue</Button>

            </form>

        </div>

    </section>

</template>

<script setup>
import {Button} from '@/Components';
import {useForm} from "@inertiajs/inertia-vue3";

const creditCardForm = useForm({
    cardholder_name: null,
    card_number: null,
    expiration_date: null,
    security_code: null,
});

</script>
