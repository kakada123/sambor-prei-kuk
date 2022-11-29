<template>
    <el-row class="top_header">
        <el-aside width="250px" class="logo">
            <img src="/assets/image/logo-white.jpg" class="logo_header" />
        </el-aside>
        <el-container>
            <el-main class="user-side">
                <el-col :span="24">
                    <el-dropdown trigger="click">
                        <span class="el-dropdown-link">
                            <el-avatar
                                src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"
                            />
                        </span>
                        <template #dropdown>
                            <el-dropdown-menu>
                                <Link
                                    :href="appRoute('logout')"
                                    method="post"
                                    as="button"
                                >
                                    <el-dropdown-item>
                                        Log Out
                                    </el-dropdown-item>
                                </Link>
                            </el-dropdown-menu>
                        </template>
                    </el-dropdown>
                </el-col>
            </el-main>
        </el-container>
    </el-row>
</template>
<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>
<style>
.el-header {
    border-bottom: solid 1px var(--el-menu-border-color);
    height: 60px;
    padding: 0px;
}
.el-header .logo {
    height: 60px;
    border-right: solid 1px var(--el-menu-border-color);
}
img.logo_header {
    width: 90%;
    margin: 0 auto;
}
.user-side {
    text-align: right;
    padding: 10px;
}
</style>
