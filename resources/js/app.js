import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import Vue3Toasity from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { ZiggyVue } from "ziggy-js";

import Layout from "./Layout/Layout.vue";

import "flowbite";

createInertiaApp({
  resolve: (name) => {
    const page = resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob("./Pages/**/*.vue")
    );

    page.then((module) => {
      if (module.default.layout === undefined) module.default.layout = Layout;
    });

    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(Vue3Toasity, {
        autoClose: 3000,
        // ...
      })
      .use(ZiggyVue)
      .mount(el);
  },
});
