<template>
    <div>
        <CategoryForm :category="category"></CategoryForm>
    </div>
</template>
<script setup>
import CategoryTreeVue from "./CategoryTree.vue";
import CategoryForm from "./CategoryForm.vue";
import Master from "@/Layouts/Main/Master.vue";
defineProps({
    categories: Object,
    category: Object,
});
</script>
<script>
export default {
    layout: [Master, CategoryTreeVue],
};
</script>
