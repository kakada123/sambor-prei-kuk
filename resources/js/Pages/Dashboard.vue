<template>
    <Head title="Dashboad"></Head>
    <BreadcrumbVue>
        <el-breadcrumb-item :to="{ path: '/' }">Dashboad</el-breadcrumb-item>
    </BreadcrumbVue>
</template>
<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import BreadcrumbVue from "@/Layouts/Breadcrumb.vue";
</script>
<script>
import Master from "@/Layouts/Main/Master.vue";
export default {
    layout: Master,
};
</script>
