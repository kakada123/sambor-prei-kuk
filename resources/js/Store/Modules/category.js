export default {
    namespaced: true,
    state() {
        return {
            id: null,
            name: null,
            description: null,
        };
    },
    mutations: {
        clickOnCategory(state, payLoad) {
            const categoryData = payLoad.category;
            state.id = categoryData.id;
            state.name = categoryData.name;
            state.description = categoryData.description;
        },
    },
    actions: {
        clickOnCategory(context, payLoad) {
            context.commit("clickOnCategory", payLoad);
        },
    },
    getters: {
        parent(state) {
            return state.id;
        },
        categoryName(state) {
            return state.name;
        },
    },
};
