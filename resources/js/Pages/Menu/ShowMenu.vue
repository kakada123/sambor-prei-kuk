<template>
    <MenuTree
        :menus="menus"
        :menu_type_name="menu_type_name"
        :menuType="menuType"
    ></MenuTree>
</template>
<script setup>
import MenuTree from "./MenuTree.vue";
</script>
<script>
export default {
    data() {
        return {
            currentNode: null,
        };
    },
    props: ["menus", "menu_type_name", "menuType"],
};
</script>
