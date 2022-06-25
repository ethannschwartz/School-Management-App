<script setup>
// import BreezeApplicationLogo from '@/Components/Modules/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-800">
        <div>
            <Link href="/">
                <h1 class="text-gray-400 text-4xl lg:text-6xl">Publify</h1>
<!--                <BreezeApplicationLogo class="w-20 h-20 fill-current text-gray-500" />-->
            </Link>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-md">
            <slot />
        </div>
    </div>
</template>
