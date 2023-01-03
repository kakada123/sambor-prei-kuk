import { ElBreadcrumbItem, ElCard, ElRow, ElCol } from "element-plus/es";
import "element-plus/es/components/col/style/css";
import "element-plus/es/components/row/style/css";
import "element-plus/es/components/card/style/css";
import "element-plus/es/components/breadcrumb-item/style/css";
import { unref, withCtx, createTextVNode, toDisplayString, createVNode, useSSRContext } from "vue";
import { ssrRenderComponent, ssrInterpolate } from "vue/server-renderer";
import { B as BreadcrumbVue, _ as _sfc_main$2 } from "./Breadcrumb.0f286a29.mjs";
import { Head } from "@inertiajs/inertia-vue3";
import _sfc_main$1 from "./CategoryTree.3ba94b50.mjs";
import "element-plus/es/components/footer/style/css";
import "element-plus/es/components/main/style/css";
import "element-plus/es/components/aside/style/css";
import "element-plus/es/components/header/style/css";
import "element-plus/es/components/container/style/css";
import "element-plus/es/components/sub-menu/style/css";
import "element-plus/es/components/icon/style/css";
import "element-plus/es/components/menu-item/style/css";
import "element-plus/es/components/menu/style/css";
import "@element-plus/icons-vue";
import "element-plus/es/components/dropdown-item/style/css";
import "element-plus/es/components/dropdown-menu/style/css";
import "element-plus/es/components/avatar/style/css";
import "element-plus/es/components/dropdown/style/css";
import "element-plus/es/components/breadcrumb/style/css";
import "./_plugin-vue_export-helper.43be4956.mjs";
import "element-plus/es/components/tree/style/css";
import "element-plus/es/components/button/style/css";
const Index_vue_vue_type_style_index_0_lang = "";
const __default__ = {
  layout: _sfc_main$2
};
const _sfc_main = /* @__PURE__ */ Object.assign(__default__, {
  __name: "Index",
  __ssrInlineRender: true,
  props: {
    categories: Object
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      const _component_el_breadcrumb_item = ElBreadcrumbItem;
      const _component_el_card = ElCard;
      const _component_el_row = ElRow;
      const _component_el_col = ElCol;
      _push(`<!--[-->`);
      _push(ssrRenderComponent(unref(Head), {
        title: _ctx.$t("Categories")
      }, null, _parent));
      _push(ssrRenderComponent(BreadcrumbVue, null, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(_component_el_breadcrumb_item, { to: { path: "/" } }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(`${ssrInterpolate(_ctx.$t("Categories"))}`);
                } else {
                  return [
                    createTextVNode(toDisplayString(_ctx.$t("Categories")), 1)
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
          } else {
            return [
              createVNode(_component_el_breadcrumb_item, { to: { path: "/" } }, {
                default: withCtx(() => [
                  createTextVNode(toDisplayString(_ctx.$t("Categories")), 1)
                ]),
                _: 1
              })
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(ssrRenderComponent(_component_el_card, { class: "box-card mt-4 custom-card" }, {
        header: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div class="card-header"${_scopeId}><span${_scopeId}>${ssrInterpolate(_ctx.$t("Categories"))}</span></div>`);
          } else {
            return [
              createVNode("div", { class: "card-header" }, [
                createVNode("span", null, toDisplayString(_ctx.$t("Categories")), 1)
              ])
            ];
          }
        }),
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(_component_el_row, null, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(ssrRenderComponent(_component_el_col, { span: 6 }, {
                    default: withCtx((_3, _push4, _parent4, _scopeId3) => {
                      if (_push4) {
                        _push4(ssrRenderComponent(_sfc_main$1, { categories: __props.categories }, null, _parent4, _scopeId3));
                      } else {
                        return [
                          createVNode(_sfc_main$1, { categories: __props.categories }, null, 8, ["categories"])
                        ];
                      }
                    }),
                    _: 1
                  }, _parent3, _scopeId2));
                } else {
                  return [
                    createVNode(_component_el_col, { span: 6 }, {
                      default: withCtx(() => [
                        createVNode(_sfc_main$1, { categories: __props.categories }, null, 8, ["categories"])
                      ]),
                      _: 1
                    })
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
          } else {
            return [
              createVNode(_component_el_row, null, {
                default: withCtx(() => [
                  createVNode(_component_el_col, { span: 6 }, {
                    default: withCtx(() => [
                      createVNode(_sfc_main$1, { categories: __props.categories }, null, 8, ["categories"])
                    ]),
                    _: 1
                  })
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Category/Index.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
