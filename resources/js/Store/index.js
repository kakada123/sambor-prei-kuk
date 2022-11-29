import { createStore } from "vuex";
import categoryModule from "@/Store/Modules/category.js";
const store = createStore({
    modules: {
        category: categoryModule,
    },
});

export default store;
