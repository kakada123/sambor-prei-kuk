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
                prop="category"
            >
                <el-tree-select
                    v-model="form.category"
                    :data="dataCategoryTree"
                    :filter-method="filterMethod"
                    :render-after-expand="false"
                    :placeholder="$t('app.select_category')"
                    check-strictly
                    class="w-full"
                    filterable
                />
            </el-form-item>
            <el-form-item :label="$t('app.thumbnail')">
                <el-upload
                    ref="upload"
                    class="upload-demo"
                    :auto-upload="false"
                    :limit="1"
                    :on-exceed="handleExceed"
                    v-model:file-list="thumbnail"
                    list-type="picture"
                >
                    <template #trigger>
                        <el-button type="primary">{{
                            $t("app.select_thumbnail")
                        }}</el-button>
                    </template>

                    <template #tip>
                        <div class="el-upload__tip">
                            {{ $t("app.upload_file_help_text") }}
                        </div>
                    </template>
                </el-upload>
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
                                    'undo redo | code | forecolor backcolor | styleselect | fontselect | fontsizeselect| bold italic | alignleft aligncenter alignright alignjustify | outdent indent fullscreen image',
                                image_title: true,
                                automatic_uploads: true,
                                images_upload_url: '/articles/upload-image',
                                content_style: `@import url('https://fonts.googleapis.com/css2?family=Hanuman&family=Kantumruy:wght@300;400;700&family=Koulen&family=Moul&family=Roboto:ital,wght@0,400;1,700&display=swap');body { font-family: ; 'Hanuman'}`,
                                font_formats:
                                    'ហនុមាន=Hanuman;Roboto=Roboto;ម៉ូល=Moul;គូលេន=Koulen',
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
                v-if="isCreateForm"
                type="success"
                plain
                class="me-2"
                @click="submitForm(articleForm)"
                >{{ $t("app.save") }}</el-button
            >
            <el-button
                v-if="isUpdateForm"
                type="success"
                plain
                class="me-2"
                @click="updateForm(articleForm)"
                >{{ $t("app.update") }}</el-button
            >
        </el-row>
    </el-tabs>
</template>
<script lang="ts" setup>
import { genFileId } from "element-plus";
import type { UploadInstance, UploadProps, UploadRawFile } from "element-plus";
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
import { wTrans } from "laravel-vue-i18n";
// computed
const langs = computed(() => usePage().props.value.langs);
const article = computed(() => usePage().props.value.article);
const currentRoute = route().current();
const isUpdateForm = computed(() => {
    if (currentRoute === "article.edit") {
        return true;
    }
    return false;
});
const isCreateForm = computed(() => {
    if (currentRoute === "article.create") {
        return true;
    }
    return false;
});
let theThumbnail = [];
if (isUpdateForm.value) {
    console.log(article.value.thumbnail);
    if (article.value.thumbnail) {
        theThumbnail = [
            {
                name: article.value.file_name,
                url: article.value.thumbnail,
            },
        ];
    }
}
const thumbnail = ref<UploadUserFile[]>(theThumbnail);
const upload = ref<UploadInstance>();

const handleExceed: UploadProps["onExceed"] = (files) => {
    upload.value!.clearFiles();
    const file = files[0] as UploadRawFile;
    file.uid = genFileId();
    upload.value!.handleStart(file);
};
defineProps({
    categories: Object,
    status: Number,
});
// Data
const categories = usePage().props.value.categories;
const dataCategoryTree = ref(categories);

const filterMethod = (value) => {
    dataCategoryTree.value = [...categories].filter((item) =>
        item.label.includes(value)
    );
};
const defaultLang = "en";
const activeName = ref(defaultLang);
const store = useStore();
const labelPosition = ref("top");
const articleForm = ref<FormInstance>();
let formObject = {
    category: "",
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
if (isUpdateForm.value) {
    formObject = useForm(article.value);
}
const form = useForm(formObject);
const requiredMessage = wTrans("app.please_input_article_name");
const rules = reactive<FormRules>({
    category: [
        {
            required: true,
            message: wTrans("app.please_select_category"),
            trigger: "change",
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
        title: wTrans("app.success"),
        message: wTrans("app.create_article_success"),
        type: "success",
    });
};
const failSubmit = () => {
    ElNotification({
        title: wTrans("app.fail"),
        message: wTrans("app.create_article_fail"),
        type: "error",
    });
};
const submitForm = async (formEl: FormInstance | undefined) => {
    if (!formEl) return;
    await formEl.validate((valid, fields) => {
        if (valid) {
            Inertia.post(
                route("article.store"),
                {
                    _method: "post",
                    forceFormData: true,
                    form: form,
                    thumbnail: thumbnail.value[0]
                        ? thumbnail.value[0].raw
                        : null,
                    preserveScroll: true,
                },
                {
                    onSuccess: successSubmit(),
                }
            );
        } else {
            console.log("error submit!", fields);
        }
    });
};
const updateForm = async (formEl: FormInstance | undefined) => {
    if (!formEl) return;
    await formEl.validate((valid, fields) => {
        if (valid) {
            Inertia.post(
                route("article.update", { article: article.value.id }),
                {
                    _method: "post",
                    forceFormData: true,
                    form: form,
                    thumbnail: thumbnail.value[0]
                        ? thumbnail.value[0].raw
                        : null,
                    preserveScroll: true,
                },
                {
                    onSuccess: successSubmit(),
                }
            );
        } else {
            console.log("error submit!", fields);
        }
    });
};
const IsRequired = (active: string) => {
    if (defaultLang === active) {
        return true;
    }
    return false;
};
</script>
