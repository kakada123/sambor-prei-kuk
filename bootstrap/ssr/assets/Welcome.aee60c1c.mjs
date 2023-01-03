import { unref, useSSRContext } from "vue";
import { ssrRenderComponent } from "vue/server-renderer";
import { Head } from "@inertiajs/inertia-vue3";
const _sfc_main = {
  __name: "Welcome",
  __ssrInlineRender: true,
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<!--[-->`);
      _push(ssrRenderComponent(unref(Head), { title: "Welcome" }, null, _parent));
      _push(`<nav class="bg-cyan-900 w-100 text-slate-50 py-2"><div class="md:container md:mx-auto"><ul class="list-none inline-flex font-khmer text-sm items-center"><li class="m-0"><a href="#"><img src="https://www.moe.gov.kh/wp-content/uploads/2019/05/cropped-ic-moe-logo.png" class="h-12 p-0 min-w-max"></a></li><li class="m-2 ml-5"><a href="#" class="hover:text-slate-200 whitespace-nowrap">\u1791\u17C6\u1796\u17D0\u179A\u178A\u17BE\u1798</a></li><li class="m-2"><a href="#" class="hover:text-slate-200 whitespace-nowrap">\u17A2\u17C6\u1796\u17B8\u1780\u17D2\u179A\u179F\u17BD\u1784</a></li><li class="m-2"><a href="#" class="hover:text-slate-200 whitespace-nowrap">\u1785\u17D2\u1794\u17B6\u1794\u17CB\u1793\u17B7\u1784\u179B\u17B7\u1781\u17B7\u178F\u1794\u1791\u178A\u17D2\u178B\u17B6\u1793</a></li><li class="m-2"><a href="#" class="hover:text-slate-200 whitespace-nowrap">\u1798\u1787\u17D2\u1788\u1798\u178E\u17D2\u178C\u179B\u1796\u178F\u17CD\u1798\u17B6\u1793</a></li><li class="m-2"><a href="#" class="hover:text-slate-200 whitespace-nowrap">\u1798\u1787\u17D2\u1788\u1798\u178E\u17D2\u178C\u179B\u1796\u178F\u17CD\u1798\u17B6\u1793</a></li></ul></div></nav><!--]-->`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Welcome.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
