<template>
    <MenuForm></MenuForm>
</template>
<script setup>
import MenuTreeVue from "./MenuTree.vue";
import MenuForm from "./MenuForm.vue";
defineProps({
    menus: Object,
});
</script>
<script>
import Master from "@/Layouts/Main/Master.vue";
export default {
    layout: [Master, MenuTreeVue],
};
</script>
