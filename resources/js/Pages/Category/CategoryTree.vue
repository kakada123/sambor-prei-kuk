<script lang="ts">
export default {
    data() {
        return {
            categoryTreeKey: 1,
            isExpandAll: true,
            categoryId: null,
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
            this.categoryId = Tree.id;
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
        CreateRootCategory() {
            this.$store.dispatch({
                type: "category/clickOnCategory",
                category: {
                    id: null,
                    name: null,
                    description: null,
                },
            });
            Inertia.visit(route("category.create"), { method: "get" });
        },
        CreateSubCategory() {
            this.categoryId = this.$store.getters["category/parent"];
            Inertia.visit(route("category.create"), { method: "get" });
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
import { Inertia } from "@inertiajs/inertia";
interface Tree {
    label: string;
    children?: Tree[];
    id: number;
}
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
        <el-button @click="CreateRootCategory"> Root </el-button>
        <el-button @click="CreateSubCategory" v-if="categoryId">
            Sub
        </el-button>
    </div>
    <el-tree
        :data="dataTree"
        @node-click="categoryClick"
        :default-expand-all="isExpandAll"
        :key="categoryTreeKey"
        :current-node-key="6"
    />
</template>
