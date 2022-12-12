<template>
    <Head :title="$t('app.Edit article')"></Head>
    <BreadcrumbVue>
        <el-breadcrumb-item :to="{ path: '/article' }">{{
            $t("app.Articles")
        }}</el-breadcrumb-item>
        <el-breadcrumb-item :to="{ path: '/' }">{{
            $t("app.Edit article")
        }}</el-breadcrumb-item>
    </BreadcrumbVue>
    <el-card class="box-card mt-4 custom-card">
        <template #header>
            <div class="card-header">
                <span>{{ $t("app.Edit article") }}</span>
            </div>
        </template>
        <ArticleForm :categories="categories" :article="article"></ArticleForm>
    </el-card>
</template>
<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import BreadcrumbVue from "@/Layouts/Breadcrumb.vue";
import ArticleForm from "./ArticleForm.vue";
defineProps({
    categories: Object,
    article: Object,
});
</script>
