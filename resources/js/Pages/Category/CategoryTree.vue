<template>
    <Head :title="$t('Categories')"></Head>
    <BreadcrumbVue>
        <el-breadcrumb-item :to="{ path: '/' }">{{
            $t("Categories")
        }}</el-breadcrumb-item>
    </BreadcrumbVue>
    <el-card class="box-card mt-4 custom-card">
        <template #header>
            <div class="card-header">
                <span>{{ $t("Categories") }}</span>
            </div>
        </template>
        <el-row>
            <el-col :span="6">
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
                    :default-expanded-keys="[expandedId]"
                    :highlight-current="highlightCurrent"
                    :current-node-key="expandedId"
                    accordion
                    node-key="id"
                />
            </el-col>
            <el-col :span="18">
                <slot></slot>
            </el-col>
        </el-row>
    </el-card>
</template>
<script lang="ts">
export default {
    data() {
        return {
            categoryTreeKey: 1,
            isExpandAll: false,
            highlightCurrent: true,
            categoryId: null,
            dataTree: null,
            expandedId: null,
        };
    },
    props: ["categories"],
    mounted() {
        this.categoryId = this.parent;
        this.dataTree = this.categories;
        this.expandedId = this.parent;
    },
    methods: {
        collapseAll() {
            this.expandedId = null;
            this.isExpandAll = false;
            this.categoryTreeKey += 1;
        },
        expandAll() {
            this.expandedId = null;
            this.isExpandAll = true;
            this.categoryTreeKey += 1;
        },
        createMainCategory() {
            alert("create main category");
        },
        categoryClick(Tree) {
            this.categoryId = Tree.id;
            this.expandedId = null;
            Inertia.visit(
                route("category.edit", { category: this.categoryId })
            );
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
            this.collapseAll();
            this.categoryId = null;
            this.$store.dispatch({
                type: "category/clickOnCategory",
                category: {
                    id: null,
                    name: null,
                    description: null,
                },
            });
            this.createTheCategory();
        },
        createTheCategory() {
            Inertia.visit(route("category.create"), { method: "get" });
        },
        CreateSubCategory() {
            this.categoryId = this.$store.getters["category/parent"];
            this.createTheCategory();
        },
    },
    computed: {
        parent() {
            return this.$store.getters["category/parent"];
        },
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
import BreadcrumbVue from "@/Layouts/Breadcrumb.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>
