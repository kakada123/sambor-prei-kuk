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
            <template #cell(Thumbnail)="{ item: article }">
                <img :src="article.thumbnail" class="w-10" />
            </template>
            <template #cell(actions)="{ item: user }">
                <a :href="`/users/${user.id}/edit`"> Edit </a>
            </template>
        </Table>
    </el-card>
</template>
<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import BreadcrumbVue from "@/Layouts/Breadcrumb.vue";
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
defineProps(["articles"]);
</script>
