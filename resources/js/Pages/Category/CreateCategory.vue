<template>
    <Head :title="$t('Categories')"></Head>
    <BreadcrumbVue>
        <el-breadcrumb-item :to="{ path: '/categories' }">{{
            $t("Categories")
        }}</el-breadcrumb-item>
        <el-breadcrumb-item :to="{ path: '/' }">{{
            $t("Create Category")
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
                <CategoryTreeVue :categories="categories"></CategoryTreeVue>
            </el-col>
            <el-col :span="18">
                <CategoryForm></CategoryForm>
            </el-col>
        </el-row>
    </el-card>
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
    layout: Master,
};
</script>
