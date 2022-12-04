<template>
    <CategoryForm></CategoryForm>
</template>
<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import BreadcrumbVue from "@/Layouts/Breadcrumb.vue";
import CategoryTreeVue from "./CategoryTree.vue";
import CategoryForm from "./CategoryForm.vue";
defineProps({
    categories: Object,
});
</script>
<script>
import Master from "@/Layouts/Main/Master.vue";
export default {
    layout: [Master, CategoryTreeVue],
};
</script>
