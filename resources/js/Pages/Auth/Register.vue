<template>
    <BreezeGuestLayout>
        <Head title="Register" />

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">

            <div class="w-full mt-4 flex justify-start gap-4">
                <div v-if="form.account_type === 'teacher'">
                    <BreezeLabel for="prefix" value="Prefix" />
                    <select id="prefix" class="mt-1 block border-gray-300 rounded-md" v-model="form.prefix" required autofocus autocomplete="prefix" >
                        <option v-for="prefix in prefixOptions" :value="prefix">{{ prefix }}</option>
                    </select>
                </div>
                <div class="w-full" >
                    <BreezeLabel for="name" value="Name" />
                    <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                </div>
            </div>
            <div class="mt-4">
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
            </div>
            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>
            <div class="mt-4">
                <BreezeLabel for="password_confirmation" value="Confirm Password" />
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>
            <div class="flex justify-evenly mt-4">
                        <div class="text-center">
                            <BreezeLabel for="account_type" value="Student" />
                            <BreezeInput name="account_type" id="student" value="student" checked type="radio" class="mt-1" v-model="form.account_type" required />
                        </div>
                        <div class="text-center">
                            <BreezeLabel for="account_type" value="Teacher" />
                            <BreezeInput name="account_type" id="teacher" value="teacher" type="radio" class="mt-1" v-model="form.account_type" required />
                        </div>
                    </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <BreezeButton class="ml-4" color="teal" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>

<script setup>
import BreezeButton from '@/Components/Modules/FormElements/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Modules/VueInput.vue';
import BreezeLabel from '@/Components/Modules/Label.vue';
import BreezeValidationErrors from '@/Components/Modules/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const prefixOptions = [
    'Mr.',
    'Ms.',
    'Mrs.',
    'Dr.',
    'Professor',
];

const form = useForm({
    name: null,
    prefix: null,
    email: null,
    account_type:'student',
    password: null,
    password_confirmation: null,
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

</script>
