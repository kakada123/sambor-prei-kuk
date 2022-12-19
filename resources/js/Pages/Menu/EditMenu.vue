<template>
    <MenuForm
        :categories="categories"
        :menuType="menuType"
        :menu_id="menu_id"
    ></MenuForm>
</template>
<script setup>
import MenuTreeVue from "./MenuTree.vue";
import MenuForm from "./MenuForm.vue";
import { usePage } from "@inertiajs/inertia-vue3";
defineProps({
    menus: Object,
    categories: Object,
    menuType: String,
    menu_id: Number,
});
const categories = usePage().props.value;
const menuType = usePage().props.value;
const menu_id = usePage().props.menu_id;
</script>
<script>
import Master from "@/Layouts/Main/Master.vue";
export default {
    layout: [Master, MenuTreeVue],
};
</script>
