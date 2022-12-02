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
                <CategoryTreeVue :categories="categories"></CategoryTreeVue>
            </el-col>
        </el-row>
    </el-card>
</template>
<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import BreadcrumbVue from "@/Layouts/Breadcrumb.vue";
import CategoryTreeVue from "./CategoryTree.vue";
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
