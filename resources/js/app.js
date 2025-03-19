import "../css/app.css";
import "../css/style.css";
import "../css/style.css";
import "./bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import "bootstrap/dist/css/bootstrap.css";
import "@fortawesome/fontawesome-free/css/fontawesome.min.css";
import "@fortawesome/fontawesome-free/css/all.min.css";
import Antd from "ant-design-vue";
import VueFeather from "vue-feather";
import DatePicker from "vue3-datepicker";
import Vue3Autocounter from "vue3-autocounter";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { BootstrapVue3, BToastPlugin } from "bootstrap-vue-3";

const appName = import.meta.env.VITE_APP_NAME || "App";

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob("./Pages/**/*.vue")
    ),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .component(VueFeather.name, VueFeather)
      .component("vue3-autocounter", Vue3Autocounter)
      .component("date-picker", DatePicker)
      .use(Antd)
      .use(plugin)
      .use(ZiggyVue)
      .use(BootstrapVue3)
      .use(BToastPlugin)
      .mount(el);
  },
  progress: {
    color: "#4B5563",
  },
});
