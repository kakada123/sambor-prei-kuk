import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import ElementPlus from "element-plus";
import { i18nVue } from "laravel-vue-i18n";
import contextmenu from "v-contextmenu";
import "v-contextmenu/dist/themes/default.css";
import "element-plus/dist/index.css";
import FloatingLabel from "vue-simple-floating-labels";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";
const cleanApp = () => {
    document.getElementById("app").removeAttribute("data-page");
};

document.addEventListener("inertia:finish", cleanApp);

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ElementPlus)
            .mixin({ methods: { appRoute: window.route } })
            .use(FloatingLabel)
            .use(i18nVue, {
                lang: "pt",
                resolve: (lang) => {
                    const langs = import.meta.globEager("../../lang/*.json");
                    return langs[`../../lang/${lang}.json`].default;
                },
            })
            .use(contextmenu)
            .mount(el);
    },
}).then(cleanApp);

InertiaProgress.init({ color: "#4B5563" });
