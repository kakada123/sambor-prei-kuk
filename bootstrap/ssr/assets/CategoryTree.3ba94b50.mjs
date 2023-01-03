import { ElButton, ElTree } from "element-plus/es";
import "element-plus/es/components/tree/style/css";
import "element-plus/es/components/button/style/css";
import { defineComponent, withCtx, createTextVNode, unref, useSSRContext } from "vue";
import { ssrRenderComponent } from "vue/server-renderer";
const _sfc_main = /* @__PURE__ */ defineComponent({
  __name: "CategoryTree",
  __ssrInlineRender: true,
  props: ["categories"],
  setup(__props) {
    const props = __props;
    const isExpandAll = true;
    const handleNodeClick = (data2) => {
      console.log(data2);
    };
    const collapseAll = (data2) => {
    };
    const data = props.categories;
    return (_ctx, _push, _parent, _attrs) => {
      const _component_el_button = ElButton;
      const _component_el_tree = ElTree;
      _push(`<!--[-->`);
      _push(ssrRenderComponent(_component_el_button, { onClick: collapseAll }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`Collapse All`);
          } else {
            return [
              createTextVNode("Collapse All")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(ssrRenderComponent(_component_el_button, { onClick: collapseAll }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`Expand All`);
          } else {
            return [
              createTextVNode("Expand All")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(ssrRenderComponent(_component_el_tree, {
        data: unref(data),
        onNodeClick: handleNodeClick,
        "default-expand-all": isExpandAll
      }, null, _parent));
      _push(`<!--]-->`);
    };
  }
});
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Category/CategoryTree.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
