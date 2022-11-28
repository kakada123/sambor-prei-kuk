<template>
    <el-menu
        :default-active="activeIndex"
        class="el-menu-demo"
        mode="horizontal"
        :ellipsis="false"
        @select="handleSelect"
    >
        <el-menu-item index="0">
            <img
                src="http://backend-website.test/assets/images/logo-dark.png"
                class="logo"
            />
        </el-menu-item>
        <div class="flex-grow" />
        <el-dropdown trigger="click">
            <span class="el-dropdown-link">
                Dropdown List<el-icon class="el-icon--right"
                    ><arrow-down
                /></el-icon>
            </span>
            <template #dropdown>
                <el-dropdown-menu>
                    <el-dropdown-item :icon="Plus">Action 1</el-dropdown-item>
                    <el-dropdown-item :icon="CirclePlusFilled">
                        Action 2
                    </el-dropdown-item>
                </el-dropdown-menu>
            </template>
        </el-dropdown>
    </el-menu>
</template>

<script lang="ts" setup>
import { ref } from "vue";
import {
    Plus,
    CirclePlusFilled
} from "@element-plus/icons-vue";

const activeIndex = ref("1");
const handleSelect = (key: string, keyPath: string[]) => {
    console.log(key, keyPath);
};
</script>

<style>
.flex-grow {
    flex-grow: 1;
}
.logo {
    height: 50px;
    width: auto;
}
ul.el-menu.el-menu--vertical.el-menu-vertical-demo {
    min-height: calc(100vh - 50px);
}
</style>
