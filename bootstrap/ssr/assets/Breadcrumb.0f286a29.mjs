import { ElRow, ElCol, ElMenu, ElMenuItem, ElIcon, ElSubMenu, ElAside, ElContainer, ElMain, ElDropdown, ElAvatar, ElDropdownMenu, ElDropdownItem, ElHeader, ElFooter, ElBreadcrumb, ElBreadcrumbItem } from "element-plus/es";
import "element-plus/es/components/footer/style/css";
import "element-plus/es/components/main/style/css";
import "element-plus/es/components/aside/style/css";
import "element-plus/es/components/header/style/css";
import "element-plus/es/components/container/style/css";
import { mergeProps, withCtx, unref, createVNode, toDisplayString, createTextVNode, useSSRContext, renderSlot } from "vue";
import { ssrRenderComponent, ssrInterpolate, ssrRenderSlot } from "vue/server-renderer";
import "element-plus/es/components/sub-menu/style/css";
import "element-plus/es/components/icon/style/css";
import "element-plus/es/components/menu-item/style/css";
import "element-plus/es/components/menu/style/css";
import "element-plus/es/components/col/style/css";
import "element-plus/es/components/row/style/css";
import { HomeFilled, Box, ArrowRight, Menu, Files, Tools } from "@element-plus/icons-vue";
import { Link } from "@inertiajs/inertia-vue3";
import "element-plus/es/components/dropdown-item/style/css";
import "element-plus/es/components/dropdown-menu/style/css";
import "element-plus/es/components/avatar/style/css";
import "element-plus/es/components/dropdown/style/css";
import "element-plus/es/components/breadcrumb-item/style/css";
import "element-plus/es/components/breadcrumb/style/css";
import { _ as _export_sfc } from "./_plugin-vue_export-helper.43be4956.mjs";
const Menu_vue_vue_type_style_index_0_lang = "";
const _sfc_main$3 = {
  __name: "Menu",
  __ssrInlineRender: true,
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      const _component_el_row = ElRow;
      const _component_el_col = ElCol;
      const _component_el_menu = ElMenu;
      const _component_el_menu_item = ElMenuItem;
      const _component_el_icon = ElIcon;
      const _component_el_sub_menu = ElSubMenu;
      _push(ssrRenderComponent(_component_el_row, mergeProps({ class: "tac the_menu" }, _attrs), {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(_component_el_col, { span: 24 }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(ssrRenderComponent(_component_el_menu, {
                    "active-text-color": "#af150b",
                    "background-color": "#ffffff",
                    class: "el-menu-vertical",
                    "default-active": "1",
                    "text-color": "#000000",
                    select: 2,
                    "unique-opened": true
                  }, {
                    default: withCtx((_3, _push4, _parent4, _scopeId3) => {
                      if (_push4) {
                        _push4(ssrRenderComponent(unref(Link), {
                          href: _ctx.appRoute("dashboard")
                        }, {
                          default: withCtx((_4, _push5, _parent5, _scopeId4) => {
                            if (_push5) {
                              _push5(ssrRenderComponent(_component_el_menu_item, { index: "1" }, {
                                title: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(ssrRenderComponent(_component_el_icon, null, {
                                      default: withCtx((_6, _push7, _parent7, _scopeId6) => {
                                        if (_push7) {
                                          _push7(ssrRenderComponent(unref(HomeFilled), null, null, _parent7, _scopeId6));
                                        } else {
                                          return [
                                            createVNode(unref(HomeFilled))
                                          ];
                                        }
                                      }),
                                      _: 1
                                    }, _parent6, _scopeId5));
                                    _push6(`<span${_scopeId5}>${ssrInterpolate(_ctx.$t("app.Home"))}</span>`);
                                  } else {
                                    return [
                                      createVNode(_component_el_icon, null, {
                                        default: withCtx(() => [
                                          createVNode(unref(HomeFilled))
                                        ]),
                                        _: 1
                                      }),
                                      createVNode("span", null, toDisplayString(_ctx.$t("app.Home")), 1)
                                    ];
                                  }
                                }),
                                _: 1
                              }, _parent5, _scopeId4));
                            } else {
                              return [
                                createVNode(_component_el_menu_item, { index: "1" }, {
                                  title: withCtx(() => [
                                    createVNode(_component_el_icon, null, {
                                      default: withCtx(() => [
                                        createVNode(unref(HomeFilled))
                                      ]),
                                      _: 1
                                    }),
                                    createVNode("span", null, toDisplayString(_ctx.$t("app.Home")), 1)
                                  ]),
                                  _: 1
                                })
                              ];
                            }
                          }),
                          _: 1
                        }, _parent4, _scopeId3));
                        _push4(ssrRenderComponent(_component_el_sub_menu, { index: "2" }, {
                          title: withCtx((_4, _push5, _parent5, _scopeId4) => {
                            if (_push5) {
                              _push5(ssrRenderComponent(_component_el_icon, null, {
                                default: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(ssrRenderComponent(unref(Box), null, null, _parent6, _scopeId5));
                                  } else {
                                    return [
                                      createVNode(unref(Box))
                                    ];
                                  }
                                }),
                                _: 1
                              }, _parent5, _scopeId4));
                              _push5(`<span${_scopeId4}>${ssrInterpolate(_ctx.$t("app.Categories"))}</span>`);
                            } else {
                              return [
                                createVNode(_component_el_icon, null, {
                                  default: withCtx(() => [
                                    createVNode(unref(Box))
                                  ]),
                                  _: 1
                                }),
                                createVNode("span", null, toDisplayString(_ctx.$t("app.Categories")), 1)
                              ];
                            }
                          }),
                          default: withCtx((_4, _push5, _parent5, _scopeId4) => {
                            if (_push5) {
                              _push5(ssrRenderComponent(unref(Link), {
                                href: _ctx.appRoute("category.index")
                              }, {
                                default: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(ssrRenderComponent(_component_el_menu_item, { index: "2-1" }, {
                                      default: withCtx((_6, _push7, _parent7, _scopeId6) => {
                                        if (_push7) {
                                          _push7(ssrRenderComponent(_component_el_icon, null, {
                                            default: withCtx((_7, _push8, _parent8, _scopeId7) => {
                                              if (_push8) {
                                                _push8(ssrRenderComponent(unref(ArrowRight), null, null, _parent8, _scopeId7));
                                              } else {
                                                return [
                                                  createVNode(unref(ArrowRight))
                                                ];
                                              }
                                            }),
                                            _: 1
                                          }, _parent7, _scopeId6));
                                          _push7(` ${ssrInterpolate(_ctx.$t("app.Categories"))}`);
                                        } else {
                                          return [
                                            createVNode(_component_el_icon, null, {
                                              default: withCtx(() => [
                                                createVNode(unref(ArrowRight))
                                              ]),
                                              _: 1
                                            }),
                                            createTextVNode(" " + toDisplayString(_ctx.$t("app.Categories")), 1)
                                          ];
                                        }
                                      }),
                                      _: 1
                                    }, _parent6, _scopeId5));
                                  } else {
                                    return [
                                      createVNode(_component_el_menu_item, { index: "2-1" }, {
                                        default: withCtx(() => [
                                          createVNode(_component_el_icon, null, {
                                            default: withCtx(() => [
                                              createVNode(unref(ArrowRight))
                                            ]),
                                            _: 1
                                          }),
                                          createTextVNode(" " + toDisplayString(_ctx.$t("app.Categories")), 1)
                                        ]),
                                        _: 1
                                      })
                                    ];
                                  }
                                }),
                                _: 1
                              }, _parent5, _scopeId4));
                              _push5(ssrRenderComponent(_component_el_menu_item, { index: "2-2" }, {
                                default: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(ssrRenderComponent(_component_el_icon, null, {
                                      default: withCtx((_6, _push7, _parent7, _scopeId6) => {
                                        if (_push7) {
                                          _push7(ssrRenderComponent(unref(ArrowRight), null, null, _parent7, _scopeId6));
                                        } else {
                                          return [
                                            createVNode(unref(ArrowRight))
                                          ];
                                        }
                                      }),
                                      _: 1
                                    }, _parent6, _scopeId5));
                                    _push6(` ${ssrInterpolate(_ctx.$t("app.Create category"))}`);
                                  } else {
                                    return [
                                      createVNode(_component_el_icon, null, {
                                        default: withCtx(() => [
                                          createVNode(unref(ArrowRight))
                                        ]),
                                        _: 1
                                      }),
                                      createTextVNode(" " + toDisplayString(_ctx.$t("app.Create category")), 1)
                                    ];
                                  }
                                }),
                                _: 1
                              }, _parent5, _scopeId4));
                            } else {
                              return [
                                createVNode(unref(Link), {
                                  href: _ctx.appRoute("category.index")
                                }, {
                                  default: withCtx(() => [
                                    createVNode(_component_el_menu_item, { index: "2-1" }, {
                                      default: withCtx(() => [
                                        createVNode(_component_el_icon, null, {
                                          default: withCtx(() => [
                                            createVNode(unref(ArrowRight))
                                          ]),
                                          _: 1
                                        }),
                                        createTextVNode(" " + toDisplayString(_ctx.$t("app.Categories")), 1)
                                      ]),
                                      _: 1
                                    })
                                  ]),
                                  _: 1
                                }, 8, ["href"]),
                                createVNode(_component_el_menu_item, { index: "2-2" }, {
                                  default: withCtx(() => [
                                    createVNode(_component_el_icon, null, {
                                      default: withCtx(() => [
                                        createVNode(unref(ArrowRight))
                                      ]),
                                      _: 1
                                    }),
                                    createTextVNode(" " + toDisplayString(_ctx.$t("app.Create category")), 1)
                                  ]),
                                  _: 1
                                })
                              ];
                            }
                          }),
                          _: 1
                        }, _parent4, _scopeId3));
                        _push4(ssrRenderComponent(_component_el_sub_menu, { index: "3" }, {
                          title: withCtx((_4, _push5, _parent5, _scopeId4) => {
                            if (_push5) {
                              _push5(ssrRenderComponent(_component_el_icon, null, {
                                default: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(ssrRenderComponent(unref(Menu), null, null, _parent6, _scopeId5));
                                  } else {
                                    return [
                                      createVNode(unref(Menu))
                                    ];
                                  }
                                }),
                                _: 1
                              }, _parent5, _scopeId4));
                              _push5(`<span${_scopeId4}>${ssrInterpolate(_ctx.$t("app.Menus"))}</span>`);
                            } else {
                              return [
                                createVNode(_component_el_icon, null, {
                                  default: withCtx(() => [
                                    createVNode(unref(Menu))
                                  ]),
                                  _: 1
                                }),
                                createVNode("span", null, toDisplayString(_ctx.$t("app.Menus")), 1)
                              ];
                            }
                          }),
                          default: withCtx((_4, _push5, _parent5, _scopeId4) => {
                            if (_push5) {
                              _push5(ssrRenderComponent(_component_el_menu_item, { index: "3-1" }, {
                                default: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(ssrRenderComponent(_component_el_icon, null, {
                                      default: withCtx((_6, _push7, _parent7, _scopeId6) => {
                                        if (_push7) {
                                          _push7(ssrRenderComponent(unref(ArrowRight), null, null, _parent7, _scopeId6));
                                        } else {
                                          return [
                                            createVNode(unref(ArrowRight))
                                          ];
                                        }
                                      }),
                                      _: 1
                                    }, _parent6, _scopeId5));
                                    _push6(` ${ssrInterpolate(_ctx.$t("app.Menus"))}`);
                                  } else {
                                    return [
                                      createVNode(_component_el_icon, null, {
                                        default: withCtx(() => [
                                          createVNode(unref(ArrowRight))
                                        ]),
                                        _: 1
                                      }),
                                      createTextVNode(" " + toDisplayString(_ctx.$t("app.Menus")), 1)
                                    ];
                                  }
                                }),
                                _: 1
                              }, _parent5, _scopeId4));
                              _push5(ssrRenderComponent(_component_el_menu_item, { index: "3-2" }, {
                                default: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(ssrRenderComponent(_component_el_icon, null, {
                                      default: withCtx((_6, _push7, _parent7, _scopeId6) => {
                                        if (_push7) {
                                          _push7(ssrRenderComponent(unref(ArrowRight), null, null, _parent7, _scopeId6));
                                        } else {
                                          return [
                                            createVNode(unref(ArrowRight))
                                          ];
                                        }
                                      }),
                                      _: 1
                                    }, _parent6, _scopeId5));
                                    _push6(` ${ssrInterpolate(_ctx.$t("app.Create menu"))}`);
                                  } else {
                                    return [
                                      createVNode(_component_el_icon, null, {
                                        default: withCtx(() => [
                                          createVNode(unref(ArrowRight))
                                        ]),
                                        _: 1
                                      }),
                                      createTextVNode(" " + toDisplayString(_ctx.$t("app.Create menu")), 1)
                                    ];
                                  }
                                }),
                                _: 1
                              }, _parent5, _scopeId4));
                            } else {
                              return [
                                createVNode(_component_el_menu_item, { index: "3-1" }, {
                                  default: withCtx(() => [
                                    createVNode(_component_el_icon, null, {
                                      default: withCtx(() => [
                                        createVNode(unref(ArrowRight))
                                      ]),
                                      _: 1
                                    }),
                                    createTextVNode(" " + toDisplayString(_ctx.$t("app.Menus")), 1)
                                  ]),
                                  _: 1
                                }),
                                createVNode(_component_el_menu_item, { index: "3-2" }, {
                                  default: withCtx(() => [
                                    createVNode(_component_el_icon, null, {
                                      default: withCtx(() => [
                                        createVNode(unref(ArrowRight))
                                      ]),
                                      _: 1
                                    }),
                                    createTextVNode(" " + toDisplayString(_ctx.$t("app.Create menu")), 1)
                                  ]),
                                  _: 1
                                })
                              ];
                            }
                          }),
                          _: 1
                        }, _parent4, _scopeId3));
                        _push4(ssrRenderComponent(_component_el_sub_menu, { index: "4" }, {
                          title: withCtx((_4, _push5, _parent5, _scopeId4) => {
                            if (_push5) {
                              _push5(ssrRenderComponent(_component_el_icon, null, {
                                default: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(ssrRenderComponent(unref(Files), null, null, _parent6, _scopeId5));
                                  } else {
                                    return [
                                      createVNode(unref(Files))
                                    ];
                                  }
                                }),
                                _: 1
                              }, _parent5, _scopeId4));
                              _push5(`<span${_scopeId4}>${ssrInterpolate(_ctx.$t("app.Articles"))}</span>`);
                            } else {
                              return [
                                createVNode(_component_el_icon, null, {
                                  default: withCtx(() => [
                                    createVNode(unref(Files))
                                  ]),
                                  _: 1
                                }),
                                createVNode("span", null, toDisplayString(_ctx.$t("app.Articles")), 1)
                              ];
                            }
                          }),
                          default: withCtx((_4, _push5, _parent5, _scopeId4) => {
                            if (_push5) {
                              _push5(ssrRenderComponent(_component_el_menu_item, { index: "4-1" }, {
                                default: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(ssrRenderComponent(_component_el_icon, null, {
                                      default: withCtx((_6, _push7, _parent7, _scopeId6) => {
                                        if (_push7) {
                                          _push7(ssrRenderComponent(unref(ArrowRight), null, null, _parent7, _scopeId6));
                                        } else {
                                          return [
                                            createVNode(unref(ArrowRight))
                                          ];
                                        }
                                      }),
                                      _: 1
                                    }, _parent6, _scopeId5));
                                    _push6(` ${ssrInterpolate(_ctx.$t("app.Articles"))}`);
                                  } else {
                                    return [
                                      createVNode(_component_el_icon, null, {
                                        default: withCtx(() => [
                                          createVNode(unref(ArrowRight))
                                        ]),
                                        _: 1
                                      }),
                                      createTextVNode(" " + toDisplayString(_ctx.$t("app.Articles")), 1)
                                    ];
                                  }
                                }),
                                _: 1
                              }, _parent5, _scopeId4));
                              _push5(ssrRenderComponent(_component_el_menu_item, { index: "4-2" }, {
                                default: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(ssrRenderComponent(_component_el_icon, null, {
                                      default: withCtx((_6, _push7, _parent7, _scopeId6) => {
                                        if (_push7) {
                                          _push7(ssrRenderComponent(unref(ArrowRight), null, null, _parent7, _scopeId6));
                                        } else {
                                          return [
                                            createVNode(unref(ArrowRight))
                                          ];
                                        }
                                      }),
                                      _: 1
                                    }, _parent6, _scopeId5));
                                    _push6(` ${ssrInterpolate(_ctx.$t("app.Create article"))}`);
                                  } else {
                                    return [
                                      createVNode(_component_el_icon, null, {
                                        default: withCtx(() => [
                                          createVNode(unref(ArrowRight))
                                        ]),
                                        _: 1
                                      }),
                                      createTextVNode(" " + toDisplayString(_ctx.$t("app.Create article")), 1)
                                    ];
                                  }
                                }),
                                _: 1
                              }, _parent5, _scopeId4));
                            } else {
                              return [
                                createVNode(_component_el_menu_item, { index: "4-1" }, {
                                  default: withCtx(() => [
                                    createVNode(_component_el_icon, null, {
                                      default: withCtx(() => [
                                        createVNode(unref(ArrowRight))
                                      ]),
                                      _: 1
                                    }),
                                    createTextVNode(" " + toDisplayString(_ctx.$t("app.Articles")), 1)
                                  ]),
                                  _: 1
                                }),
                                createVNode(_component_el_menu_item, { index: "4-2" }, {
                                  default: withCtx(() => [
                                    createVNode(_component_el_icon, null, {
                                      default: withCtx(() => [
                                        createVNode(unref(ArrowRight))
                                      ]),
                                      _: 1
                                    }),
                                    createTextVNode(" " + toDisplayString(_ctx.$t("app.Create article")), 1)
                                  ]),
                                  _: 1
                                })
                              ];
                            }
                          }),
                          _: 1
                        }, _parent4, _scopeId3));
                        _push4(ssrRenderComponent(_component_el_menu_item, { index: "5" }, {
                          default: withCtx((_4, _push5, _parent5, _scopeId4) => {
                            if (_push5) {
                              _push5(ssrRenderComponent(_component_el_icon, null, {
                                default: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(ssrRenderComponent(unref(Tools), null, null, _parent6, _scopeId5));
                                  } else {
                                    return [
                                      createVNode(unref(Tools))
                                    ];
                                  }
                                }),
                                _: 1
                              }, _parent5, _scopeId4));
                              _push5(`<span${_scopeId4}>${ssrInterpolate(_ctx.$t("app.Site Setting"))}</span>`);
                            } else {
                              return [
                                createVNode(_component_el_icon, null, {
                                  default: withCtx(() => [
                                    createVNode(unref(Tools))
                                  ]),
                                  _: 1
                                }),
                                createVNode("span", null, toDisplayString(_ctx.$t("app.Site Setting")), 1)
                              ];
                            }
                          }),
                          _: 1
                        }, _parent4, _scopeId3));
                      } else {
                        return [
                          createVNode(unref(Link), {
                            href: _ctx.appRoute("dashboard")
                          }, {
                            default: withCtx(() => [
                              createVNode(_component_el_menu_item, { index: "1" }, {
                                title: withCtx(() => [
                                  createVNode(_component_el_icon, null, {
                                    default: withCtx(() => [
                                      createVNode(unref(HomeFilled))
                                    ]),
                                    _: 1
                                  }),
                                  createVNode("span", null, toDisplayString(_ctx.$t("app.Home")), 1)
                                ]),
                                _: 1
                              })
                            ]),
                            _: 1
                          }, 8, ["href"]),
                          createVNode(_component_el_sub_menu, { index: "2" }, {
                            title: withCtx(() => [
                              createVNode(_component_el_icon, null, {
                                default: withCtx(() => [
                                  createVNode(unref(Box))
                                ]),
                                _: 1
                              }),
                              createVNode("span", null, toDisplayString(_ctx.$t("app.Categories")), 1)
                            ]),
                            default: withCtx(() => [
                              createVNode(unref(Link), {
                                href: _ctx.appRoute("category.index")
                              }, {
                                default: withCtx(() => [
                                  createVNode(_component_el_menu_item, { index: "2-1" }, {
                                    default: withCtx(() => [
                                      createVNode(_component_el_icon, null, {
                                        default: withCtx(() => [
                                          createVNode(unref(ArrowRight))
                                        ]),
                                        _: 1
                                      }),
                                      createTextVNode(" " + toDisplayString(_ctx.$t("app.Categories")), 1)
                                    ]),
                                    _: 1
                                  })
                                ]),
                                _: 1
                              }, 8, ["href"]),
                              createVNode(_component_el_menu_item, { index: "2-2" }, {
                                default: withCtx(() => [
                                  createVNode(_component_el_icon, null, {
                                    default: withCtx(() => [
                                      createVNode(unref(ArrowRight))
                                    ]),
                                    _: 1
                                  }),
                                  createTextVNode(" " + toDisplayString(_ctx.$t("app.Create category")), 1)
                                ]),
                                _: 1
                              })
                            ]),
                            _: 1
                          }),
                          createVNode(_component_el_sub_menu, { index: "3" }, {
                            title: withCtx(() => [
                              createVNode(_component_el_icon, null, {
                                default: withCtx(() => [
                                  createVNode(unref(Menu))
                                ]),
                                _: 1
                              }),
                              createVNode("span", null, toDisplayString(_ctx.$t("app.Menus")), 1)
                            ]),
                            default: withCtx(() => [
                              createVNode(_component_el_menu_item, { index: "3-1" }, {
                                default: withCtx(() => [
                                  createVNode(_component_el_icon, null, {
                                    default: withCtx(() => [
                                      createVNode(unref(ArrowRight))
                                    ]),
                                    _: 1
                                  }),
                                  createTextVNode(" " + toDisplayString(_ctx.$t("app.Menus")), 1)
                                ]),
                                _: 1
                              }),
                              createVNode(_component_el_menu_item, { index: "3-2" }, {
                                default: withCtx(() => [
                                  createVNode(_component_el_icon, null, {
                                    default: withCtx(() => [
                                      createVNode(unref(ArrowRight))
                                    ]),
                                    _: 1
                                  }),
                                  createTextVNode(" " + toDisplayString(_ctx.$t("app.Create menu")), 1)
                                ]),
                                _: 1
                              })
                            ]),
                            _: 1
                          }),
                          createVNode(_component_el_sub_menu, { index: "4" }, {
                            title: withCtx(() => [
                              createVNode(_component_el_icon, null, {
                                default: withCtx(() => [
                                  createVNode(unref(Files))
                                ]),
                                _: 1
                              }),
                              createVNode("span", null, toDisplayString(_ctx.$t("app.Articles")), 1)
                            ]),
                            default: withCtx(() => [
                              createVNode(_component_el_menu_item, { index: "4-1" }, {
                                default: withCtx(() => [
                                  createVNode(_component_el_icon, null, {
                                    default: withCtx(() => [
                                      createVNode(unref(ArrowRight))
                                    ]),
                                    _: 1
                                  }),
                                  createTextVNode(" " + toDisplayString(_ctx.$t("app.Articles")), 1)
                                ]),
                                _: 1
                              }),
                              createVNode(_component_el_menu_item, { index: "4-2" }, {
                                default: withCtx(() => [
                                  createVNode(_component_el_icon, null, {
                                    default: withCtx(() => [
                                      createVNode(unref(ArrowRight))
                                    ]),
                                    _: 1
                                  }),
                                  createTextVNode(" " + toDisplayString(_ctx.$t("app.Create article")), 1)
                                ]),
                                _: 1
                              })
                            ]),
                            _: 1
                          }),
                          createVNode(_component_el_menu_item, { index: "5" }, {
                            default: withCtx(() => [
                              createVNode(_component_el_icon, null, {
                                default: withCtx(() => [
                                  createVNode(unref(Tools))
                                ]),
                                _: 1
                              }),
                              createVNode("span", null, toDisplayString(_ctx.$t("app.Site Setting")), 1)
                            ]),
                            _: 1
                          })
                        ];
                      }
                    }),
                    _: 1
                  }, _parent3, _scopeId2));
                } else {
                  return [
                    createVNode(_component_el_menu, {
                      "active-text-color": "#af150b",
                      "background-color": "#ffffff",
                      class: "el-menu-vertical",
                      "default-active": "1",
                      "text-color": "#000000",
                      select: 2,
                      "unique-opened": true
                    }, {
                      default: withCtx(() => [
                        createVNode(unref(Link), {
                          href: _ctx.appRoute("dashboard")
                        }, {
                          default: withCtx(() => [
                            createVNode(_component_el_menu_item, { index: "1" }, {
                              title: withCtx(() => [
                                createVNode(_component_el_icon, null, {
                                  default: withCtx(() => [
                                    createVNode(unref(HomeFilled))
                                  ]),
                                  _: 1
                                }),
                                createVNode("span", null, toDisplayString(_ctx.$t("app.Home")), 1)
                              ]),
                              _: 1
                            })
                          ]),
                          _: 1
                        }, 8, ["href"]),
                        createVNode(_component_el_sub_menu, { index: "2" }, {
                          title: withCtx(() => [
                            createVNode(_component_el_icon, null, {
                              default: withCtx(() => [
                                createVNode(unref(Box))
                              ]),
                              _: 1
                            }),
                            createVNode("span", null, toDisplayString(_ctx.$t("app.Categories")), 1)
                          ]),
                          default: withCtx(() => [
                            createVNode(unref(Link), {
                              href: _ctx.appRoute("category.index")
                            }, {
                              default: withCtx(() => [
                                createVNode(_component_el_menu_item, { index: "2-1" }, {
                                  default: withCtx(() => [
                                    createVNode(_component_el_icon, null, {
                                      default: withCtx(() => [
                                        createVNode(unref(ArrowRight))
                                      ]),
                                      _: 1
                                    }),
                                    createTextVNode(" " + toDisplayString(_ctx.$t("app.Categories")), 1)
                                  ]),
                                  _: 1
                                })
                              ]),
                              _: 1
                            }, 8, ["href"]),
                            createVNode(_component_el_menu_item, { index: "2-2" }, {
                              default: withCtx(() => [
                                createVNode(_component_el_icon, null, {
                                  default: withCtx(() => [
                                    createVNode(unref(ArrowRight))
                                  ]),
                                  _: 1
                                }),
                                createTextVNode(" " + toDisplayString(_ctx.$t("app.Create category")), 1)
                              ]),
                              _: 1
                            })
                          ]),
                          _: 1
                        }),
                        createVNode(_component_el_sub_menu, { index: "3" }, {
                          title: withCtx(() => [
                            createVNode(_component_el_icon, null, {
                              default: withCtx(() => [
                                createVNode(unref(Menu))
                              ]),
                              _: 1
                            }),
                            createVNode("span", null, toDisplayString(_ctx.$t("app.Menus")), 1)
                          ]),
                          default: withCtx(() => [
                            createVNode(_component_el_menu_item, { index: "3-1" }, {
                              default: withCtx(() => [
                                createVNode(_component_el_icon, null, {
                                  default: withCtx(() => [
                                    createVNode(unref(ArrowRight))
                                  ]),
                                  _: 1
                                }),
                                createTextVNode(" " + toDisplayString(_ctx.$t("app.Menus")), 1)
                              ]),
                              _: 1
                            }),
                            createVNode(_component_el_menu_item, { index: "3-2" }, {
                              default: withCtx(() => [
                                createVNode(_component_el_icon, null, {
                                  default: withCtx(() => [
                                    createVNode(unref(ArrowRight))
                                  ]),
                                  _: 1
                                }),
                                createTextVNode(" " + toDisplayString(_ctx.$t("app.Create menu")), 1)
                              ]),
                              _: 1
                            })
                          ]),
                          _: 1
                        }),
                        createVNode(_component_el_sub_menu, { index: "4" }, {
                          title: withCtx(() => [
                            createVNode(_component_el_icon, null, {
                              default: withCtx(() => [
                                createVNode(unref(Files))
                              ]),
                              _: 1
                            }),
                            createVNode("span", null, toDisplayString(_ctx.$t("app.Articles")), 1)
                          ]),
                          default: withCtx(() => [
                            createVNode(_component_el_menu_item, { index: "4-1" }, {
                              default: withCtx(() => [
                                createVNode(_component_el_icon, null, {
                                  default: withCtx(() => [
                                    createVNode(unref(ArrowRight))
                                  ]),
                                  _: 1
                                }),
                                createTextVNode(" " + toDisplayString(_ctx.$t("app.Articles")), 1)
                              ]),
                              _: 1
                            }),
                            createVNode(_component_el_menu_item, { index: "4-2" }, {
                              default: withCtx(() => [
                                createVNode(_component_el_icon, null, {
                                  default: withCtx(() => [
                                    createVNode(unref(ArrowRight))
                                  ]),
                                  _: 1
                                }),
                                createTextVNode(" " + toDisplayString(_ctx.$t("app.Create article")), 1)
                              ]),
                              _: 1
                            })
                          ]),
                          _: 1
                        }),
                        createVNode(_component_el_menu_item, { index: "5" }, {
                          default: withCtx(() => [
                            createVNode(_component_el_icon, null, {
                              default: withCtx(() => [
                                createVNode(unref(Tools))
                              ]),
                              _: 1
                            }),
                            createVNode("span", null, toDisplayString(_ctx.$t("app.Site Setting")), 1)
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
            }, _parent2, _scopeId));
          } else {
            return [
              createVNode(_component_el_col, { span: 24 }, {
                default: withCtx(() => [
                  createVNode(_component_el_menu, {
                    "active-text-color": "#af150b",
                    "background-color": "#ffffff",
                    class: "el-menu-vertical",
                    "default-active": "1",
                    "text-color": "#000000",
                    select: 2,
                    "unique-opened": true
                  }, {
                    default: withCtx(() => [
                      createVNode(unref(Link), {
                        href: _ctx.appRoute("dashboard")
                      }, {
                        default: withCtx(() => [
                          createVNode(_component_el_menu_item, { index: "1" }, {
                            title: withCtx(() => [
                              createVNode(_component_el_icon, null, {
                                default: withCtx(() => [
                                  createVNode(unref(HomeFilled))
                                ]),
                                _: 1
                              }),
                              createVNode("span", null, toDisplayString(_ctx.$t("app.Home")), 1)
                            ]),
                            _: 1
                          })
                        ]),
                        _: 1
                      }, 8, ["href"]),
                      createVNode(_component_el_sub_menu, { index: "2" }, {
                        title: withCtx(() => [
                          createVNode(_component_el_icon, null, {
                            default: withCtx(() => [
                              createVNode(unref(Box))
                            ]),
                            _: 1
                          }),
                          createVNode("span", null, toDisplayString(_ctx.$t("app.Categories")), 1)
                        ]),
                        default: withCtx(() => [
                          createVNode(unref(Link), {
                            href: _ctx.appRoute("category.index")
                          }, {
                            default: withCtx(() => [
                              createVNode(_component_el_menu_item, { index: "2-1" }, {
                                default: withCtx(() => [
                                  createVNode(_component_el_icon, null, {
                                    default: withCtx(() => [
                                      createVNode(unref(ArrowRight))
                                    ]),
                                    _: 1
                                  }),
                                  createTextVNode(" " + toDisplayString(_ctx.$t("app.Categories")), 1)
                                ]),
                                _: 1
                              })
                            ]),
                            _: 1
                          }, 8, ["href"]),
                          createVNode(_component_el_menu_item, { index: "2-2" }, {
                            default: withCtx(() => [
                              createVNode(_component_el_icon, null, {
                                default: withCtx(() => [
                                  createVNode(unref(ArrowRight))
                                ]),
                                _: 1
                              }),
                              createTextVNode(" " + toDisplayString(_ctx.$t("app.Create category")), 1)
                            ]),
                            _: 1
                          })
                        ]),
                        _: 1
                      }),
                      createVNode(_component_el_sub_menu, { index: "3" }, {
                        title: withCtx(() => [
                          createVNode(_component_el_icon, null, {
                            default: withCtx(() => [
                              createVNode(unref(Menu))
                            ]),
                            _: 1
                          }),
                          createVNode("span", null, toDisplayString(_ctx.$t("app.Menus")), 1)
                        ]),
                        default: withCtx(() => [
                          createVNode(_component_el_menu_item, { index: "3-1" }, {
                            default: withCtx(() => [
                              createVNode(_component_el_icon, null, {
                                default: withCtx(() => [
                                  createVNode(unref(ArrowRight))
                                ]),
                                _: 1
                              }),
                              createTextVNode(" " + toDisplayString(_ctx.$t("app.Menus")), 1)
                            ]),
                            _: 1
                          }),
                          createVNode(_component_el_menu_item, { index: "3-2" }, {
                            default: withCtx(() => [
                              createVNode(_component_el_icon, null, {
                                default: withCtx(() => [
                                  createVNode(unref(ArrowRight))
                                ]),
                                _: 1
                              }),
                              createTextVNode(" " + toDisplayString(_ctx.$t("app.Create menu")), 1)
                            ]),
                            _: 1
                          })
                        ]),
                        _: 1
                      }),
                      createVNode(_component_el_sub_menu, { index: "4" }, {
                        title: withCtx(() => [
                          createVNode(_component_el_icon, null, {
                            default: withCtx(() => [
                              createVNode(unref(Files))
                            ]),
                            _: 1
                          }),
                          createVNode("span", null, toDisplayString(_ctx.$t("app.Articles")), 1)
                        ]),
                        default: withCtx(() => [
                          createVNode(_component_el_menu_item, { index: "4-1" }, {
                            default: withCtx(() => [
                              createVNode(_component_el_icon, null, {
                                default: withCtx(() => [
                                  createVNode(unref(ArrowRight))
                                ]),
                                _: 1
                              }),
                              createTextVNode(" " + toDisplayString(_ctx.$t("app.Articles")), 1)
                            ]),
                            _: 1
                          }),
                          createVNode(_component_el_menu_item, { index: "4-2" }, {
                            default: withCtx(() => [
                              createVNode(_component_el_icon, null, {
                                default: withCtx(() => [
                                  createVNode(unref(ArrowRight))
                                ]),
                                _: 1
                              }),
                              createTextVNode(" " + toDisplayString(_ctx.$t("app.Create article")), 1)
                            ]),
                            _: 1
                          })
                        ]),
                        _: 1
                      }),
                      createVNode(_component_el_menu_item, { index: "5" }, {
                        default: withCtx(() => [
                          createVNode(_component_el_icon, null, {
                            default: withCtx(() => [
                              createVNode(unref(Tools))
                            ]),
                            _: 1
                          }),
                          createVNode("span", null, toDisplayString(_ctx.$t("app.Site Setting")), 1)
                        ]),
                        _: 1
                      })
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
    };
  }
};
const _sfc_setup$3 = _sfc_main$3.setup;
_sfc_main$3.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Layouts/Main/Menu.vue");
  return _sfc_setup$3 ? _sfc_setup$3(props, ctx) : void 0;
};
const Header_vue_vue_type_style_index_0_lang = "";
const _sfc_main$2 = {
  __name: "Header",
  __ssrInlineRender: true,
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      const _component_el_row = ElRow;
      const _component_el_aside = ElAside;
      const _component_el_container = ElContainer;
      const _component_el_main = ElMain;
      const _component_el_col = ElCol;
      const _component_el_dropdown = ElDropdown;
      const _component_el_avatar = ElAvatar;
      const _component_el_dropdown_menu = ElDropdownMenu;
      const _component_el_dropdown_item = ElDropdownItem;
      _push(ssrRenderComponent(_component_el_row, mergeProps({ class: "top_header" }, _attrs), {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(_component_el_aside, {
              width: "250px",
              class: "logo"
            }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(`<img src="https://backend-website.test/assets/images/logo-dark.png" class="logo_header"${_scopeId2}>`);
                } else {
                  return [
                    createVNode("img", {
                      src: "https://backend-website.test/assets/images/logo-dark.png",
                      class: "logo_header"
                    })
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(ssrRenderComponent(_component_el_container, null, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(ssrRenderComponent(_component_el_main, { class: "user-side" }, {
                    default: withCtx((_3, _push4, _parent4, _scopeId3) => {
                      if (_push4) {
                        _push4(ssrRenderComponent(_component_el_col, { span: 24 }, {
                          default: withCtx((_4, _push5, _parent5, _scopeId4) => {
                            if (_push5) {
                              _push5(ssrRenderComponent(_component_el_dropdown, { trigger: "click" }, {
                                dropdown: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(ssrRenderComponent(_component_el_dropdown_menu, null, {
                                      default: withCtx((_6, _push7, _parent7, _scopeId6) => {
                                        if (_push7) {
                                          _push7(ssrRenderComponent(unref(Link), {
                                            href: _ctx.appRoute("logout"),
                                            method: "post",
                                            as: "button"
                                          }, {
                                            default: withCtx((_7, _push8, _parent8, _scopeId7) => {
                                              if (_push8) {
                                                _push8(ssrRenderComponent(_component_el_dropdown_item, null, {
                                                  default: withCtx((_8, _push9, _parent9, _scopeId8) => {
                                                    if (_push9) {
                                                      _push9(` Log Out `);
                                                    } else {
                                                      return [
                                                        createTextVNode(" Log Out ")
                                                      ];
                                                    }
                                                  }),
                                                  _: 1
                                                }, _parent8, _scopeId7));
                                              } else {
                                                return [
                                                  createVNode(_component_el_dropdown_item, null, {
                                                    default: withCtx(() => [
                                                      createTextVNode(" Log Out ")
                                                    ]),
                                                    _: 1
                                                  })
                                                ];
                                              }
                                            }),
                                            _: 1
                                          }, _parent7, _scopeId6));
                                        } else {
                                          return [
                                            createVNode(unref(Link), {
                                              href: _ctx.appRoute("logout"),
                                              method: "post",
                                              as: "button"
                                            }, {
                                              default: withCtx(() => [
                                                createVNode(_component_el_dropdown_item, null, {
                                                  default: withCtx(() => [
                                                    createTextVNode(" Log Out ")
                                                  ]),
                                                  _: 1
                                                })
                                              ]),
                                              _: 1
                                            }, 8, ["href"])
                                          ];
                                        }
                                      }),
                                      _: 1
                                    }, _parent6, _scopeId5));
                                  } else {
                                    return [
                                      createVNode(_component_el_dropdown_menu, null, {
                                        default: withCtx(() => [
                                          createVNode(unref(Link), {
                                            href: _ctx.appRoute("logout"),
                                            method: "post",
                                            as: "button"
                                          }, {
                                            default: withCtx(() => [
                                              createVNode(_component_el_dropdown_item, null, {
                                                default: withCtx(() => [
                                                  createTextVNode(" Log Out ")
                                                ]),
                                                _: 1
                                              })
                                            ]),
                                            _: 1
                                          }, 8, ["href"])
                                        ]),
                                        _: 1
                                      })
                                    ];
                                  }
                                }),
                                default: withCtx((_5, _push6, _parent6, _scopeId5) => {
                                  if (_push6) {
                                    _push6(`<span class="el-dropdown-link"${_scopeId5}>`);
                                    _push6(ssrRenderComponent(_component_el_avatar, { src: "https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png" }, null, _parent6, _scopeId5));
                                    _push6(`</span>`);
                                  } else {
                                    return [
                                      createVNode("span", { class: "el-dropdown-link" }, [
                                        createVNode(_component_el_avatar, { src: "https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png" })
                                      ])
                                    ];
                                  }
                                }),
                                _: 1
                              }, _parent5, _scopeId4));
                            } else {
                              return [
                                createVNode(_component_el_dropdown, { trigger: "click" }, {
                                  dropdown: withCtx(() => [
                                    createVNode(_component_el_dropdown_menu, null, {
                                      default: withCtx(() => [
                                        createVNode(unref(Link), {
                                          href: _ctx.appRoute("logout"),
                                          method: "post",
                                          as: "button"
                                        }, {
                                          default: withCtx(() => [
                                            createVNode(_component_el_dropdown_item, null, {
                                              default: withCtx(() => [
                                                createTextVNode(" Log Out ")
                                              ]),
                                              _: 1
                                            })
                                          ]),
                                          _: 1
                                        }, 8, ["href"])
                                      ]),
                                      _: 1
                                    })
                                  ]),
                                  default: withCtx(() => [
                                    createVNode("span", { class: "el-dropdown-link" }, [
                                      createVNode(_component_el_avatar, { src: "https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png" })
                                    ])
                                  ]),
                                  _: 1
                                })
                              ];
                            }
                          }),
                          _: 1
                        }, _parent4, _scopeId3));
                      } else {
                        return [
                          createVNode(_component_el_col, { span: 24 }, {
                            default: withCtx(() => [
                              createVNode(_component_el_dropdown, { trigger: "click" }, {
                                dropdown: withCtx(() => [
                                  createVNode(_component_el_dropdown_menu, null, {
                                    default: withCtx(() => [
                                      createVNode(unref(Link), {
                                        href: _ctx.appRoute("logout"),
                                        method: "post",
                                        as: "button"
                                      }, {
                                        default: withCtx(() => [
                                          createVNode(_component_el_dropdown_item, null, {
                                            default: withCtx(() => [
                                              createTextVNode(" Log Out ")
                                            ]),
                                            _: 1
                                          })
                                        ]),
                                        _: 1
                                      }, 8, ["href"])
                                    ]),
                                    _: 1
                                  })
                                ]),
                                default: withCtx(() => [
                                  createVNode("span", { class: "el-dropdown-link" }, [
                                    createVNode(_component_el_avatar, { src: "https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png" })
                                  ])
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
                  }, _parent3, _scopeId2));
                } else {
                  return [
                    createVNode(_component_el_main, { class: "user-side" }, {
                      default: withCtx(() => [
                        createVNode(_component_el_col, { span: 24 }, {
                          default: withCtx(() => [
                            createVNode(_component_el_dropdown, { trigger: "click" }, {
                              dropdown: withCtx(() => [
                                createVNode(_component_el_dropdown_menu, null, {
                                  default: withCtx(() => [
                                    createVNode(unref(Link), {
                                      href: _ctx.appRoute("logout"),
                                      method: "post",
                                      as: "button"
                                    }, {
                                      default: withCtx(() => [
                                        createVNode(_component_el_dropdown_item, null, {
                                          default: withCtx(() => [
                                            createTextVNode(" Log Out ")
                                          ]),
                                          _: 1
                                        })
                                      ]),
                                      _: 1
                                    }, 8, ["href"])
                                  ]),
                                  _: 1
                                })
                              ]),
                              default: withCtx(() => [
                                createVNode("span", { class: "el-dropdown-link" }, [
                                  createVNode(_component_el_avatar, { src: "https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png" })
                                ])
                              ]),
                              _: 1
                            })
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
            }, _parent2, _scopeId));
          } else {
            return [
              createVNode(_component_el_aside, {
                width: "250px",
                class: "logo"
              }, {
                default: withCtx(() => [
                  createVNode("img", {
                    src: "https://backend-website.test/assets/images/logo-dark.png",
                    class: "logo_header"
                  })
                ]),
                _: 1
              }),
              createVNode(_component_el_container, null, {
                default: withCtx(() => [
                  createVNode(_component_el_main, { class: "user-side" }, {
                    default: withCtx(() => [
                      createVNode(_component_el_col, { span: 24 }, {
                        default: withCtx(() => [
                          createVNode(_component_el_dropdown, { trigger: "click" }, {
                            dropdown: withCtx(() => [
                              createVNode(_component_el_dropdown_menu, null, {
                                default: withCtx(() => [
                                  createVNode(unref(Link), {
                                    href: _ctx.appRoute("logout"),
                                    method: "post",
                                    as: "button"
                                  }, {
                                    default: withCtx(() => [
                                      createVNode(_component_el_dropdown_item, null, {
                                        default: withCtx(() => [
                                          createTextVNode(" Log Out ")
                                        ]),
                                        _: 1
                                      })
                                    ]),
                                    _: 1
                                  }, 8, ["href"])
                                ]),
                                _: 1
                              })
                            ]),
                            default: withCtx(() => [
                              createVNode("span", { class: "el-dropdown-link" }, [
                                createVNode(_component_el_avatar, { src: "https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png" })
                              ])
                            ]),
                            _: 1
                          })
                        ]),
                        _: 1
                      })
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
    };
  }
};
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Layouts/Main/Header.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const Master_vue_vue_type_style_index_0_lang = "";
const _sfc_main$1 = {
  __name: "Master",
  __ssrInlineRender: true,
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      const _component_el_container = ElContainer;
      const _component_el_header = ElHeader;
      const _component_el_aside = ElAside;
      const _component_el_main = ElMain;
      const _component_el_footer = ElFooter;
      _push(ssrRenderComponent(_component_el_container, _attrs, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(_component_el_header, null, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(ssrRenderComponent(_sfc_main$2, null, null, _parent3, _scopeId2));
                } else {
                  return [
                    createVNode(_sfc_main$2)
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(ssrRenderComponent(_component_el_container, null, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(ssrRenderComponent(_component_el_aside, { width: "250px" }, {
                    default: withCtx((_3, _push4, _parent4, _scopeId3) => {
                      if (_push4) {
                        _push4(ssrRenderComponent(_sfc_main$3, null, null, _parent4, _scopeId3));
                      } else {
                        return [
                          createVNode(_sfc_main$3)
                        ];
                      }
                    }),
                    _: 1
                  }, _parent3, _scopeId2));
                  _push3(ssrRenderComponent(_component_el_container, null, {
                    default: withCtx((_3, _push4, _parent4, _scopeId3) => {
                      if (_push4) {
                        _push4(ssrRenderComponent(_component_el_main, null, {
                          default: withCtx((_4, _push5, _parent5, _scopeId4) => {
                            if (_push5) {
                              ssrRenderSlot(_ctx.$slots, "default", {}, null, _push5, _parent5, _scopeId4);
                            } else {
                              return [
                                renderSlot(_ctx.$slots, "default")
                              ];
                            }
                          }),
                          _: 3
                        }, _parent4, _scopeId3));
                        _push4(ssrRenderComponent(_component_el_footer, null, {
                          default: withCtx((_4, _push5, _parent5, _scopeId4) => {
                            if (_push5) {
                              _push5(`Footer`);
                            } else {
                              return [
                                createTextVNode("Footer")
                              ];
                            }
                          }),
                          _: 1
                        }, _parent4, _scopeId3));
                      } else {
                        return [
                          createVNode(_component_el_main, null, {
                            default: withCtx(() => [
                              renderSlot(_ctx.$slots, "default")
                            ]),
                            _: 3
                          }),
                          createVNode(_component_el_footer, null, {
                            default: withCtx(() => [
                              createTextVNode("Footer")
                            ]),
                            _: 1
                          })
                        ];
                      }
                    }),
                    _: 3
                  }, _parent3, _scopeId2));
                } else {
                  return [
                    createVNode(_component_el_aside, { width: "250px" }, {
                      default: withCtx(() => [
                        createVNode(_sfc_main$3)
                      ]),
                      _: 1
                    }),
                    createVNode(_component_el_container, null, {
                      default: withCtx(() => [
                        createVNode(_component_el_main, null, {
                          default: withCtx(() => [
                            renderSlot(_ctx.$slots, "default")
                          ]),
                          _: 3
                        }),
                        createVNode(_component_el_footer, null, {
                          default: withCtx(() => [
                            createTextVNode("Footer")
                          ]),
                          _: 1
                        })
                      ]),
                      _: 3
                    })
                  ];
                }
              }),
              _: 3
            }, _parent2, _scopeId));
          } else {
            return [
              createVNode(_component_el_header, null, {
                default: withCtx(() => [
                  createVNode(_sfc_main$2)
                ]),
                _: 1
              }),
              createVNode(_component_el_container, null, {
                default: withCtx(() => [
                  createVNode(_component_el_aside, { width: "250px" }, {
                    default: withCtx(() => [
                      createVNode(_sfc_main$3)
                    ]),
                    _: 1
                  }),
                  createVNode(_component_el_container, null, {
                    default: withCtx(() => [
                      createVNode(_component_el_main, null, {
                        default: withCtx(() => [
                          renderSlot(_ctx.$slots, "default")
                        ]),
                        _: 3
                      }),
                      createVNode(_component_el_footer, null, {
                        default: withCtx(() => [
                          createTextVNode("Footer")
                        ]),
                        _: 1
                      })
                    ]),
                    _: 3
                  })
                ]),
                _: 3
              })
            ];
          }
        }),
        _: 3
      }, _parent));
    };
  }
};
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Layouts/Main/Master.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const _sfc_main = {};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs) {
  const _component_el_breadcrumb = ElBreadcrumb;
  const _component_el_breadcrumb_item = ElBreadcrumbItem;
  _push(ssrRenderComponent(_component_el_breadcrumb, mergeProps({ separator: "/" }, _attrs), {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_el_breadcrumb_item, { to: { path: "/" } }, {
          default: withCtx((_2, _push3, _parent3, _scopeId2) => {
            if (_push3) {
              _push3(`Home`);
            } else {
              return [
                createTextVNode("Home")
              ];
            }
          }),
          _: 1
        }, _parent2, _scopeId));
        ssrRenderSlot(_ctx.$slots, "default", {}, null, _push2, _parent2, _scopeId);
      } else {
        return [
          createVNode(_component_el_breadcrumb_item, { to: { path: "/" } }, {
            default: withCtx(() => [
              createTextVNode("Home")
            ]),
            _: 1
          }),
          renderSlot(_ctx.$slots, "default")
        ];
      }
    }),
    _: 3
  }, _parent));
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Layouts/Breadcrumb.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const BreadcrumbVue = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  BreadcrumbVue as B,
  _sfc_main$1 as _
};
