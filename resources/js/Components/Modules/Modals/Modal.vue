<template>

    <div class="fixed left-0 right-0 top-0 !bottom-0 flex flex-col justify-center w-screen bg-gray-900/30 backdrop-blur-sm z-[100]">

        <div class="relative bg-white rounded-md h-fit max-w-[730px] w-[500px] mx-auto p-8">

            <header class="flex justify-between items-start">
                <h1 class="text-3xl text-slate-600 font-bold mb-4">{{ header }}</h1>
                <button type="button" @click="$emit('close')" class="absolute right-4 top-4">
                    <BaseSvg name="icon-closing-x" class="duration-150 fill-slate-600 hover:fill-black hover:bg-gray-100 rounded-full p-0.5" />
                </button>
            </header>

            <form :action="action"
                  enctype="multipart/form-data"
                  :method="method"
                  @submit.prevent="submitFunction"
                  class="mx-auto block space-y-4"
            >

                <slot />

<!--                <Button type="submit"-->
<!--                        color="teal"-->
<!--                        class="flex justify-center w-full"-->
<!--                        :class="{ 'opacity-25': form.processing }"-->
<!--                        :disabled="form.processing"-->
<!--                >-->
<!--                    {{ submitLabel }}-->
<!--                </Button>-->
                <Button type="submit" color="teal" class="flex justify-center w-full" >{{ submitLabel }}</Button>

                <Button type="button"
                        color="gray"
                        class="flex justify-center w-full"
                        @click="$emit('close')"
                >
                    Cancel
                </Button>

            </form>

        </div>

    </div>

</template>

<script setup>
import {BaseSvg, Button} from "@/Components";
const props = defineProps(['open', 'form', 'header', 'submitFunction', 'submitLabel', 'action', 'method']);


</script>
