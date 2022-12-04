<template>
    <CategoryTree :categories="categories"></CategoryTree>
</template>
<script setup>
import Master from "@/Layouts/Main/Master.vue";
import CategoryTree from "./CategoryTree.vue";
</script>
<script>
export default {
    data() {
        return {
            currentNode: null,
        };
    },
    props: ["categories"],
    layout: [Master],
};
</script>
