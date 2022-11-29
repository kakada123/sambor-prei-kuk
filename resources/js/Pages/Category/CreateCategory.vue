<template>
    <el-tabs v-model="activeName" class="demo-tabs" @tab-click="handleClick">
        <el-form
            :model="form"
            :label-position="labelPosition"
            :rules="rules"
            ref="categoryForm"
            label-width="120px"
            require-asterisk-position="right"
        >
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
                type="success"
                plain
                class="me-2"
                @click="submitForm(categoryForm)"
                >Save</el-button
            >
            <el-button
                type="danger"
                plain
                class="me-2"
                @click="deleteCategory()"
                >Delete</el-button
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
const langs = computed(() => usePage().props.value.langs);
const defaultLang = "en";
const activeName = ref(defaultLang);
import { Inertia } from "@inertiajs/inertia";
import { useStore } from "vuex";
const store = useStore();
const parent = computed(() => store.getters["category/parent"]);
const handleClick = (tab: TabsPaneContext, event: Event) => {
    console.log(tab, event);
};

const labelPosition = ref("top");

let formObject = {
    is_active: true,
    parent: parent,
};
langs.value.forEach((lang) => {
    let name = "name_" + lang.locale;
    let description = "description_" + lang.locale;
    formObject[name] = "";
    formObject[description] = "";
});
const form = useForm(formObject);
const rules = reactive<FormRules>({
    name_en: [
        {
            required: true,
            message: "Please input category name",
            trigger: "blur",
        },
    ],
    name_km: [
        {
            required: true,
            message: "Please input category name",
            trigger: "blur",
        },
    ],
});

const submitForm = async (formEl: FormInstance | undefined) => {
    if (!formEl) return;
    await formEl.validate((valid, fields) => {
        if (valid) {
            form.post(route("category.store"), {
                onFinish: () => Inertia.reload({ only: ["categories"] }),
            });
        } else {
            console.log("error submit!", fields);
        }
    });
};
const categoryForm = ref<FormInstance>();

const IsRequired = (active: string) => {
    if (defaultLang === active) {
        return true;
    }
    return false;
};
const deleteCategory = () => {
    console.log("delete");
};
</script>
<style>
.demo-tabs > .el-tabs__content {
    color: #6b778c;
    font-size: 32px;
    font-weight: 600;
}
</style>
