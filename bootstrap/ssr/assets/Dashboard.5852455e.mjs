import { ElBreadcrumbItem } from "element-plus/es";
import "element-plus/es/components/breadcrumb-item/style/css";
import { unref, withCtx, createTextVNode, createVNode, useSSRContext } from "vue";
import { ssrRenderComponent } from "vue/server-renderer";
import { B as BreadcrumbVue, _ as _sfc_main$1 } from "./Breadcrumb.0f286a29.mjs";
import { Head } from "@inertiajs/inertia-vue3";
import "element-plus/es/components/footer/style/css";
import "element-plus/es/components/main/style/css";
import "element-plus/es/components/aside/style/css";
import "element-plus/es/components/header/style/css";
import "element-plus/es/components/container/style/css";
import "element-plus/es/components/sub-menu/style/css";
import "element-plus/es/components/icon/style/css";
import "element-plus/es/components/menu-item/style/css";
import "element-plus/es/components/menu/style/css";
import "element-plus/es/components/col/style/css";
import "element-plus/es/components/row/style/css";
import "@element-plus/icons-vue";
import "element-plus/es/components/dropdown-item/style/css";
import "element-plus/es/components/dropdown-menu/style/css";
import "element-plus/es/components/avatar/style/css";
import "element-plus/es/components/dropdown/style/css";
import "element-plus/es/components/breadcrumb/style/css";
import "./_plugin-vue_export-helper.43be4956.mjs";
const __default__ = {
  layout: _sfc_main$1
};
const _sfc_main = /* @__PURE__ */ Object.assign(__default__, {
  __name: "Dashboard",
  __ssrInlineRender: true,
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      const _component_el_breadcrumb_item = ElBreadcrumbItem;
      _push(`<!--[-->`);
      _push(ssrRenderComponent(unref(Head), { title: "Dashboad" }, null, _parent));
      _push(ssrRenderComponent(BreadcrumbVue, null, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(_component_el_breadcrumb_item, { to: { path: "/" } }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(`Dashboad`);
                } else {
                  return [
                    createTextVNode("Dashboad")
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
          } else {
            return [
              createVNode(_component_el_breadcrumb_item, { to: { path: "/" } }, {
                default: withCtx(() => [
                  createTextVNode("Dashboad")
                ]),
                _: 1
              })
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<!--]-->`);
    };
  }
});
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Dashboard.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
