<script setup>
import Menu from "@/Layouts/Main/Menu.vue";
import Header from "@/Layouts/Main/Header.vue";
</script>
<template>
    <el-container>
        <el-header>
            <Header></Header>
        </el-header>
        <el-container>
            <el-aside width="250px">
                <Menu></Menu>
            </el-aside>
            <el-container>
                <el-main>
                    <slot />
                </el-main>
                <el-footer>Footer</el-footer>
            </el-container>
        </el-container>
    </el-container>
</template>
<style>
.aside {
    background-color: #fff;
    color: #000;
    height: calc(100vh - 60px);
}
.el-card.is-always-shadow {
    box-shadow: 0 1px 4px 0 rgb(0 0 0 / 10%);
}
</style>
