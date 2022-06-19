<template>
    <div class="absolute left-0 right-0 top-0 flex flex-col justify-center w-screen h-screen absolute top-0 left-0 bg-gray-900/30 backdrop-blur-sm z-[100]">
        <div class="bg-white rounded-md rounded-lg h-fit max-w-[730px] w-[500px] py-4 mx-auto">
            <div class="text-right text-gray-200">
                <button class="mr-4 opacity-25 hover:opacity-100" type="button" @click="$emit('close')">
                    <BaseSvg name="icon-closing-x" />
                </button>
            </div>
            <header class="w-3/4 mx-auto p-4">
                <h1 class="text-3xl text-slate-600 font-bold">{{ header }}</h1>
            </header>
            <form :action="action" enctype="multipart/form-data" :method="method" @submit.prevent="submitFunction" class="w-3/4 mx-auto flex flex-col justify-evenly gap-4">

                <slot />

                <Button type="submit" class="flex justify-center bg-teal-600 hover:bg-teal-700 active:bg-teal-900">{{ submitLabel }}</Button>
                <Button type="button" class="w-full mb-4 flex justify-center" @click="$emit('close')">Close</Button>
            </form>
        </div>
    </div>
</template>

<script>
import Button from "../../../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Button";
import BaseSvg from "@/Components/Modules/BaseSvg";
export default {
    components: {BaseSvg, Button},
    props: {
        open: {
            type: Boolean,
            required: false,
        },
        header: {
            type: String,
            required: true,
        },
        submitFunction: {
            type: Function,
            required: false,
        },
        submitLabel: {
            type: String,
            required: false,
        },
        action: {
            type: String,
            required: false,
        },
        method: {
            type: String,
            required: false,
        },
    },
};

</script>
