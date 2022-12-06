<template>
    <Head :title="$t('app.Create article')"></Head>
    <BreadcrumbVue>
        <el-breadcrumb-item :to="{ path: '/article' }">{{
            $t("app.Articles")
        }}</el-breadcrumb-item>
        <el-breadcrumb-item :to="{ path: '/' }">{{
            $t("app.Create article")
        }}</el-breadcrumb-item>
    </BreadcrumbVue>
    <el-card class="box-card mt-4 custom-card">
        <template #header>
            <div class="card-header">
                <span>{{ $t("app.Create article") }}</span>
            </div>
        </template>
        <ArticleForm :categories="categories"></ArticleForm>
    </el-card>
</template>
<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import BreadcrumbVue from "@/Layouts/Breadcrumb.vue";
import ArticleForm from "./ArticleForm.vue";
defineProps({
    categories: Object,
});
</script>
