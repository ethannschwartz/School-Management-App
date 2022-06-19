<template>
    <transition
        appear
        name="fade"
        @after-enter="afterEnter"
        @after-leave="afterLeave"
    >
        <div v-if="visible" class="fixed inset-0"  :class="'z-' + zindex" inert>
            <div class="bg-overlay-gradient w-full h-full"></div>
        </div>
    </transition>
</template>

<style>
.fade-enter-active {
    transition: all 0.5s ease-in;
}

.fade-leave-active {
    transition: all 0.3s ease-out;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.bg-overlay-gradient{
background: linear-gradient(180deg,rgba(0,0,0,.55),rgba(0,0,0,.11))
}
</style>

<script setup>
import { useOverlay } from "@/Composables";
const { visible, zindex } = useOverlay();

const afterLeave = ()=> document.body.classList.remove('h-screen','overflow-hidden');
const afterEnter = ()=> document.body.classList.add('h-screen','overflow-hidden');
</script>
