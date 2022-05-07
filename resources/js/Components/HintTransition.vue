<template>
    <div class="flex justify-start items-center relative w-1/2">
        <transition :name="name">
            <span v-show="hintSeen" class="rounded-sm whitespace-nowrap bg-[#383838] cursor-default text-white shadow-md text-xs p-2 left-[0.8em] w-fit my-0 absolute z-10">

                <slot />

                <span class="w-[4px] rotate-[45deg] p-2 bg-[#383838] absolute -left-1 top-[9px] -z-10"></span>

            </span>
        </transition>
    </div>
</template>

<script>

export default {
    props: {
        name: {
            type: String,
            required: true,
        },
        hintSeen: {
            type: Boolean,
            required: true,
        },
    },
};

</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.25s ease-out;
}

.fade-enter-from,
.fade-leave-to {
    transform: translateX(-1em);
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
