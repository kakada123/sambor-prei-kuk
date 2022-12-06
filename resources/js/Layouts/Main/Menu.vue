<script setup>
import {
    Menu as IconMenu,
    HomeFilled,
    Tools,
    Box,
    Files,
    ArrowRight,
} from "@element-plus/icons-vue";
import { Link } from '@inertiajs/inertia-vue3';
const active = route().current();
</script>
<template>
    <el-row class="tac the_menu">
        <el-col :span="24">
            <el-menu
                active-text-color="#af150b"
                background-color="#ffffff"
                class="el-menu-vertical"
                :default-active="active"
                text-color="#000000"
                :select="2"
                :unique-opened="true"
            >
            <Link :href="appRoute('dashboard')">
                <el-menu-item index="dashboard">
                    <template #title>
                        <el-icon><HomeFilled /></el-icon>
                        <span>{{ $t("app.Home") }}</span>
                    </template>
                </el-menu-item>
            </link>
                <Link :href="appRoute('category.index')">
                    <el-menu-item index="category.index">
                        <el-icon><box /></el-icon>
                        <span>{{ $t("app.Categories") }}</span>
                    </el-menu-item>
                </Link>
                <el-sub-menu index="3">
                    <template #title>
                        <el-icon><icon-menu /></el-icon>
                        <span>{{ $t("app.Menus") }}</span>
                    </template>
                    <el-menu-item index="3-1">
                        <el-icon><ArrowRight /></el-icon>
                        {{ $t("app.Menus") }}
                    </el-menu-item>
                    <el-menu-item index="3-2">
                        <el-icon><ArrowRight /></el-icon>
                        {{ $t("app.Create menu") }}
                    </el-menu-item>
                </el-sub-menu>
                <el-sub-menu index="4">
                    <template #title>
                        <el-icon><Files /></el-icon>
                        <span>{{ $t("app.Articles") }}</span>
                    </template>
                    <el-menu-item index="4-1">
                        <el-icon><ArrowRight /></el-icon>
                        {{ $t("app.Articles") }}
                    </el-menu-item>
                    <Link :href="appRoute('article.create')">
                        <el-menu-item index="article.create">
                            <el-icon><ArrowRight /></el-icon>
                            {{ $t("app.Create article") }}
                        </el-menu-item>
                    </link>
                </el-sub-menu>
                <el-menu-item index="5">
                    <el-icon><Tools /></el-icon>
                    <span>{{ $t("app.Site Setting") }}</span>
                </el-menu-item>
            </el-menu>
        </el-col>
    </el-row>
</template>
<style>
.el-menu-vertical {
    height: calc(100vh - 60px);
}
</style>
