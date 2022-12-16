<template>
    <MenuForm :categories="categories"></MenuForm>
</template>
<script setup>
import MenuTreeVue from "./MenuTree.vue";
import MenuForm from "./MenuForm.vue";
import { usePage } from "@inertiajs/inertia-vue3";
defineProps({
    menus: Object,
    categories: Object,
});
const categories = usePage().props.value;
</script>
<script>
import Master from "@/Layouts/Main/Master.vue";
export default {
    layout: [Master, MenuTreeVue],
};
</script>
