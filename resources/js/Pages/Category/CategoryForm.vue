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
            ref="categoryForm"
            label-width="120px"
            require-asterisk-position="right"
        >
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
                    <el-form-item :label="$t('app.description_' + lang.locale)">
                        <el-input
                            :rows="2"
                            required
                            type="textarea"
                            v-model="form['description_' + lang.locale]"
                        />
                    </el-form-item>
                </el-tab-pane>
            </div>
        </el-form>
        <el-row>
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
                @click="submitForm(categoryForm)"
                >{{ $t("app.save") }}</el-button
            >
            <el-button
                v-if="isUpdateForm"
                type="success"
                plain
                class="me-2"
                @click="updateForm(categoryForm)"
                >{{ $t("app.update") }}</el-button
            >
            <el-button
                type="danger"
                plain
                class="me-2"
                v-if="categoryId != null"
                @click="deleteCategory()"
                >{{ $t("app.delete") }}</el-button
            >
        </el-row>
    </el-tabs>
</template>
<script lang="ts" setup>
import { ref, reactive } from "vue";
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
// Data
const defaultLang = "km";
const activeName = ref(defaultLang);
const store = useStore();
const currentRoute = route().current();
const labelPosition = ref("top");
const categoryForm = ref<FormInstance>();
let formObject = {
    is_active: true,
    parent: categoryId.value,
    parentName: parentName.value,
};
langs.value.forEach((lang) => {
    let name = "name_" + lang.locale;
    let description = "description_" + lang.locale;
    formObject[name] = "";
    formObject[description] = "";
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
const requiredMessage = trans("app.please_input_category_name");
const rules = reactive<FormRules>({
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
            form.post(route("category.store"), {
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
const updateForm = async (formEl: FormInstance | undefined) => {
    if (!formEl) return;
    await formEl.validate((valid, fields) => {
        if (valid) {
            form.post(
                route("category.update", {
                    category: category.value.category_id,
                }),
                {
                    onFinish: successUpdate(),
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
const deleteCategory = () => {
    ElMessageBox.confirm(trans("app.confirm_delete_message"), "Warning", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        type: "warning",
    })
        .then(() => {
            Inertia.visit(
                route("category.destroy", { category: categoryId.value })
            );
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
