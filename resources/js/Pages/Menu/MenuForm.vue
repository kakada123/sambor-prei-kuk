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
                v-if="isCreateForm && form.parentName"
            >
                <el-input v-model="form.parentName" :disabled="true" />
            </el-form-item>
            <el-form-item :label="$t('app.select_category')" prop="category">
                <el-tree-select
                    v-model="form.category"
                    :data="dataCategoryTree"
                    :filter-method="filterMethod"
                    :render-after-expand="false"
                    :placeholder="$t('app.select_category')"
                    check-strictly
                    class="w-full"
                    filterable
                    clearable
                    @change="getArticles"
                />
            </el-form-item>
            <el-form-item :label="$t('app.select_article')" prop="article">
                <el-select
                    v-model="form.article"
                    :placeholder="$t('app.select_article')"
                    clearable
                    filterable
                    class="w-full"
                >
                    <el-option
                        v-for="article in articles"
                        :key="article.value"
                        :label="article.label"
                        :value="article.value"
                    />
                </el-select>
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
            <el-form-item :label="$t('app.order')">
                <el-input-number v-model="form.order" :min="1" :max="100" />
            </el-form-item>
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
                    v-if="menu != null"
                    @click="deleteMenu()"
                    >{{ $t("app.delete") }}</el-button
                >
            </el-row>
        </el-form>
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
const menu = computed(() => usePage().props.value.menu);
const menuId = computed(() => usePage().props.value.menu_id);
const menuName = computed(() => usePage().props.value.menu_name);
const theArticles = computed(() => usePage().props.value.articles);
const menuType = computed(() => usePage().props.value.menuType);
// Data
const categories = usePage().props.value.categories;
const dataCategoryTree = ref(categories);

const filterMethod = (value) => {
    dataCategoryTree.value = [...categories].filter((item) =>
        item.label.includes(value)
    );
};
// Data
const defaultLang = "en";
const activeName = ref(defaultLang);
const store = useStore();
const currentRoute = route().current();
const labelPosition = ref("top");
const categoryForm = ref<FormInstance>();
let formObject = {
    is_active: true,
    parent: menuId.value ?? "",
    parentName: menuName.value ?? "",
    article: null,
    menuType: menuType.value ?? "",
    category: null,
    order: 0,
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
    if (currentRoute === "menu.edit") {
        return true;
    }
    return false;
});
const isCreateForm = computed(() => {
    if (currentRoute === "menu.create") {
        return true;
    }
    return false;
});
interface ListItem {
    value: string;
    label: string;
}
const articles = ref<ListItem[]>([]);
if (isUpdateForm.value) {
    formObject = useForm(menu.value);
    articles.value = theArticles.value;
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
        message: trans("app.create_menu_success"),
        type: "success",
    });
};
const submitForm = async (formEl: FormInstance | undefined) => {
    if (!formEl) return;
    await formEl.validate((valid, fields) => {
        if (valid) {
            form.post(route("menu.store"), {
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
        message: trans("app.update_menu_success"),
        type: "success",
    });
};
const updateForm = async (formEl: FormInstance | undefined) => {
    if (!formEl) return;
    await formEl.validate((valid, fields) => {
        if (valid) {
            form.post(
                route("menu.update", {
                    menu: menuId.value,
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
const deleteMenu = () => {
    ElMessageBox.confirm(trans("app.confirm_delete_message"), "Warning", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        type: "warning",
    })
        .then(() => {
            Inertia.visit(route("menu.destroy", { menu: menuId.value }));
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
const getArticles = async () => {
    await axios
        .get(route("article.get_article_by_category", form.category))
        .then((response) => {
            form.article = null;
            articles.value = response.data.articles;
        });
};
</script>
