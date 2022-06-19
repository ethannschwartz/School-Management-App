<template>
    <transition
        appear
        name="pop"
        v-bind="$attrs"
    >
        <div v-if="visible" class="fixed inset-0 flex justify-center items-center h-screen w-screen z-40 overflow-y-auto overflow-x-hidden" :class="'z-'+zindex">
            <slot></slot>
        </div>
    </transition>
</template>
<style>
.pop-enter-active {
    transition: all 0.5s cubic-bezier(.4,0,.2,1);
}

.pop-leave-active {
    transition: all 0.3s cubic-bezier(.4,0,.2,1);
}

.pop-enter-from,
.pop-leave-to {
    transform: scale(0);
}
</style>
<script>
export default {
    name: 'modal-transition-component-component',
    inheritAttrs: false,
    props:{
        component:{
            type: Object,
            required:false,
        },
        visible:{
            type: Boolean,
            required:true,
        },
        zindex:{
            type: Number,
            required:true,
        },
    },
};
</script>
