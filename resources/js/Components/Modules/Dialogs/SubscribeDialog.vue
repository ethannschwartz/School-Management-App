<template>

    <Modal @close="$emit('close')" submit-label="Join Course" header="Subscribe to" :submit-function="subscribe">

    </Modal>

</template>

<script setup>
import {Modal} from "@/Components";
import {Link} from "@inertiajs/inertia-vue3";


const subscribe = () => {

};
</script>
