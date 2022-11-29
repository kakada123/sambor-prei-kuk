<script lang="ts">
export default {
    data() {
        return {
            categoryTreeKey: 1,
            isExpandAll: false,
        };
    },
    methods: {
        collapseAll() {
            this.isExpandAll = false;
            this.categoryTreeKey += 1;
        },
        expandAll() {
            this.isExpandAll = true;
            this.categoryTreeKey += 1;
        },
        createMainCategory() {
            alert("create main category");
        },
        categoryClick(Tree) {
            let category = {
                id: Tree.id,
                name: Tree.label,
                description: Tree.description,
            };
            this.$store.dispatch({
                type: "category/clickOnCategory",
                category: category,
            });
        },
    },
    computed: {
        expanded() {
            if (this.isExpandAll) {
                return true;
            }
            return false;
        },
        category() {
            return this.$store.getters["category/category"];
        },
    },
};
</script>
<script lang="ts" setup>
import { Fold, Expand, CirclePlus } from "@element-plus/icons-vue";
import CreateCategoryVue from "./CreateCategory.vue";
interface Tree {
    label: string;
    children?: Tree[];
    id: number;
}
let categoryId = null;
const props = defineProps(["categories"]);
const dataTree: Tree[] = props.categories;
</script>
<template>
    <div class="mb-2">
        <el-button @click="collapseAll" v-if="expanded">
            <el-icon><Fold /></el-icon>
        </el-button>
        <el-button @click="expandAll" v-if="!expanded">
            <el-icon><Expand /></el-icon>
        </el-button>
        <el-button>
            <el-icon><CirclePlus /></el-icon>
        </el-button>
    </div>
    <el-tree
        :data="dataTree"
        @node-click="categoryClick"
        :default-expand-all="isExpandAll"
        :key="categoryTreeKey"
    />
</template>
