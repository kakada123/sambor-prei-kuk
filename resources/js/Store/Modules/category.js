export default {
    namespaced: true,
    state() {
        return {
            id: null,
            name: null,
            description: null,
            categories: [],
        };
    },
    mutations: {
        clickOnCategory(state, payLoad) {
            const categoryData = payLoad.category;
            state.id = categoryData.id;
            state.name = categoryData.name;
            state.description = categoryData.description;
        },
        saveCategories(state, payLoad) {
            state.categories = payLoad.categories;
        },
    },
    actions: {
        clickOnCategory(context, payLoad) {
            context.commit("clickOnCategory", payLoad);
        },
        saveCategories(context, payLoad) {
            context.commit("saveCategories", payLoad);
        },
    },
    getters: {
        parent(state) {
            return state.id;
        },
        categoryName(state) {
            return state.name;
        },
        categories(state) {
            return state.categories;
        },
    },
};
