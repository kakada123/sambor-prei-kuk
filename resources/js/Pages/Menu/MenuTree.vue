<template>
    <Head :title="$t('app.edit') + ' ' + menu_type_name"></Head>
    <BreadcrumbVue>
        <el-breadcrumb-item :to="{ path: '/' }">{{
            $t("app.edit") + " " + menu_type_name
        }}</el-breadcrumb-item>
    </BreadcrumbVue>
    <el-card class="box-card mt-4 custom-card">
        <template #header>
            <div class="card-header">
                <span>{{ $t("app.edit") + " " + menu_type_name }}</span>
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
                    <el-button @click="createRootMenu"> Root </el-button>
                    <el-button @click="createSubCategory" v-if="menuId">
                        Sub
                    </el-button>
                </div>
                <el-tree
                    :data="dataTree"
                    @node-click="menuClick"
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
            menuId: null,
            dataTree: null,
            expandedId: null,
        };
    },
    props: ["menus", "menu_type_name", "menuType", "menu_id"],
    mounted() {
        this.menuId = this.menu_id;
        this.dataTree = this.menus;
        this.expandedId = this.menu_id;
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
        menuClick(Tree) {
            this.menuId = Tree.id;
            this.expandedId = null;
            Inertia.visit(
                route("menu.edit", {
                    menu: this.menuId,
                    menuType: this.menuType,
                })
            );
        },
        createRootMenu() {
            this.collapseAll();
            this.menuId = null;
            this.createTheMenu();
        },
        createTheMenu() {
            Inertia.visit(route("menu.create", { menuType: this.menuType }), {
                method: "get",
            });
        },
        createSubCategory() {
            Inertia.visit(
                route("menu.create", {
                    menuType: this.menuType,
                    menu: this.menuId,
                }),
                {
                    method: "get",
                }
            );
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
import BreadcrumbVue from "@/Layouts/Breadcrumb.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>
