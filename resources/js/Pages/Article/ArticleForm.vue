<template>
    <el-tabs
        v-model="activeName"
        class="category-tabs"
        @tab-click="handleClick"
    >
        <el-form
            :model="form"
            :label-position="labelPosition"
            :rules="rules"
            ref="articleForm"
            label-width="120px"
            require-asterisk-position="right"
        >
            <el-form-item
                :label="$t('app.select_category')"
                :required="true"
                :prop="category"
            >
                <el-tree-select
                    v-model="form.category"
                    :data="categories"
                    :filter-method="filterMethod"
                    filterable
                    check-strictly
                    :render-after-expand="false"
                    class="w-full"
                />
            </el-form-item>
            <el-form-item
                :label="$t('app.parent')"
                v-if="isCreateForm && parentName"
            >
                <el-input v-model="parentName" :disabled="true" />
            </el-form-item>
            <div v-for="lang in langs">
                <el-tab-pane :label="lang.name" :name="lang.locale">
                    <el-form-item
                        :label="$t('app.name_' + lang.locale)"
                        :required="IsRequired(lang.locale)"
                        :prop="'name_' + lang.locale"
                    >
                        <el-input v-model="form['name_' + lang.locale]" />
                    </el-form-item>
                    <el-form-item :label="$t('app.content_' + lang.locale)">
                        <editor
                            :id="'content_' + lang.locale"
                            v-model="form['content_' + lang.locale]"
                            api-key="x619dz9pzucdv88t6igpqjx22aaalqx2z9znr1y6tzlof0bp"
                            :init="{
                                plugins:
                                    'lists link image table code help wordcount fullscreen',
                                min_height: 500,
                                width: '100%',
                                toolbar:
                                    'redo undo image align code fullscreen',
                                image_title: true,
                                automatic_uploads: true,
                                images_upload_url: '/articles/upload-image',
                            }"
                        />
                    </el-form-item>
                </el-tab-pane>
            </div>
        </el-form>
        <el-row class="justify-end">
            <el-switch
                v-model="form.is_active"
                active-text="Active"
                inactive-text="InActive"
                class="mr-2"
            />
            <el-button
                type="success"
                plain
                class="me-2"
                @click="submitForm(articleForm)"
                >{{ $t("app.save") }}</el-button
            >
        </el-row>
    </el-tabs>
</template>
<script lang="ts" setup>
import Editor from "@tinymce/tinymce-vue";
import { ref, reactive } from "vue";
import React from "react";
import type { TabsPaneContext } from "element-plus";
import type { FormInstance, FormRules } from "element-plus";
import { computed } from "vue";
import { usePage, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { useStore } from "vuex";
import { ElNotification } from "element-plus";
import { ElMessage, ElMessageBox } from "element-plus";
import { trans } from "laravel-vue-i18n";
// computed
const langs = computed(() => usePage().props.value.langs);
const category = computed(() => usePage().props.value.category);
const categoryId = computed(() => store.getters["category/parent"]);
const parentName = computed(() => store.getters["category/categoryName"]);
defineProps({
    categories: Object,
});
// Data
const categories = usePage().props.value.categories;
const data = ref(categories);

const filterMethod = (value) => {
    data.value = [...categories].filter((item) => item.label.includes(value));
};
const defaultLang = "en";
const activeName = ref(defaultLang);
const store = useStore();
const currentRoute = route().current();
const labelPosition = ref("top");
const articleForm = ref<FormInstance>();
let formObject = {
    category: null,
    is_active: true,
};
langs.value.forEach((lang) => {
    let name = "name_" + lang.locale;
    let description = "description_" + lang.locale;
    let content = "content_" + lang.locale;
    formObject[name] = "";
    formObject[description] = "";
    formObject[content] = "";
});
// Method
const handleClick = (tab: TabsPaneContext, event: Event) => {
    console.log(tab, event);
};
const isUpdateForm = computed(() => {
    if (currentRoute === "category.edit") {
        return true;
    }
    return false;
});
const isCreateForm = computed(() => {
    if (currentRoute === "category.create") {
        return true;
    }
    return false;
});
if (isUpdateForm.value) {
    formObject = useForm(category.value);
}
const form = useForm(formObject);
const requiredMessage = trans("app.please_input_article_name");
const rules = reactive<FormRules>({
    category: [
        {
            required: true,
            message: trans("app.please_select_category"),
            trigger: "blur",
        },
    ],
    name_en: [
        {
            required: true,
            message: requiredMessage,
            trigger: "blur",
        },
    ],
    name_km: [
        {
            required: true,
            message: requiredMessage,
            trigger: "blur",
        },
    ],
});
const successSubmit = () => {
    ElNotification({
        title: trans("app.success"),
        message: trans("app.create_category_success"),
        type: "success",
    });
};
const submitForm = async (formEl: FormInstance | undefined) => {
    if (!formEl) return;
    await formEl.validate((valid, fields) => {
        if (valid) {
            form.post(route("article.store"), {
                onFinish: successSubmit(),
            });
        } else {
            console.log("error submit!", fields);
        }
    });
};
const successUpdate = () => {
    ElNotification({
        title: trans("app.success"),
        message: trans("app.update_category_success"),
        type: "success",
    });
};
const IsRequired = (active: string) => {
    if (defaultLang === active) {
        return true;
    }
    return false;
};
</script>
