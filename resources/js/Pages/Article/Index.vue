<template>
    <Head :title="$t('app.Articles')"></Head>
    <BreadcrumbVue>
        <el-breadcrumb-item :to="{ path: '/article' }">{{
            $t("app.Articles")
        }}</el-breadcrumb-item>
        <el-breadcrumb-item :to="{ path: '/' }">{{
            $t("app.Articles")
        }}</el-breadcrumb-item>
    </BreadcrumbVue>
    <el-card class="box-card mt-4 custom-card">
        <template #header>
            <div class="card-header">
                <span>{{ $t("app.Articles") }}</span>
            </div>
        </template>
        <Table :resource="articles">
            <template #cell(No)="{ item: article }">
                {{ articles.data.findIndex((x) => x.id === article.id) + 1 }}
            </template>
            <template #cell(Thumbnail)="{ item: article }">
                <img
                    :src="article.thumbnail ?? '/assets/image/no-image.jpg'"
                    class="w-10"
                />
            </template>
            <template #cell(actions)="{ item: article }">
                <a :href="`/articles/edit/${article.id}`"> Edit </a> |
                <a
                    @click="deleteArticle(article.id)"
                    href="javascript:void(0);"
                >
                    Delete
                </a>
            </template>
        </Table>
    </el-card>
</template>
<script setup>
import { Head, usePage } from "@inertiajs/inertia-vue3";
import BreadcrumbVue from "@/Layouts/Breadcrumb.vue";
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import { ElMessage, ElMessageBox } from "element-plus";
import { trans } from "laravel-vue-i18n";
import { Inertia } from "@inertiajs/inertia";
defineProps(["articles"]);
const deleteArticle = (articleId) => {
    ElMessageBox.confirm(trans("app.confirm_delete_message"), "Warning", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        type: "warning",
    })
        .then(() => {
            Inertia.visit(route("article.destroy", { article: articleId }));
            ElMessage({
                type: "success",
                message: "Delete completed",
            });
        })
        .catch(() => {
            ElMessage({
                type: "info",
                message: "Delete canceled",
            });
        });
};
</script>
