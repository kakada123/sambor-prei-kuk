<template>
    <CategoryTree :categories="categories"></CategoryTree>
</template>
<script setup>
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
};
</script>
