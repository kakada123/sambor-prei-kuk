<template>
    <Head :title="$t('app.Menus')"></Head>
    <BreadcrumbVue>
        <el-breadcrumb-item :to="{ path: '/article' }">{{
            $t("app.Menus")
        }}</el-breadcrumb-item>
        <el-breadcrumb-item :to="{ path: '/' }">{{
            $t("app.Menus")
        }}</el-breadcrumb-item>
    </BreadcrumbVue>
    <el-card class="box-card mt-4 custom-card">
        <template #header>
            <div class="card-header">
                <span>{{ $t("app.Menus") }}</span>
            </div>
        </template>
        <Table :resource="menus">
            <template #cell(id)="{ item: menu }">
                {{ menus.data.findIndex((x) => x.id === menu.id) + 1 }}
            </template>
            <template #cell(actions)="{ item: menu }">
                <a :href="`/menus/show/${menu.slug}`">
                    {{ $t("app.edit") }}
                </a>
                |
                <a @click="deleteArticle(menu.slug)" href="javascript:void(0);">
                    {{ $t("app.delete") }}
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
defineProps(["menus"]);
const deleteArticle = (MenuSlug) => {
    ElMessageBox.confirm(trans("app.confirm_delete_message"), "Warning", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        type: "warning",
    })
        .then(() => {
            Inertia.visit(route("menu.destroy", { menu: MenuSlug }));
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
