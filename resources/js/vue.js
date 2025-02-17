import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import DashboardLayout from './global/Dashboard.vue';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
    const page = pages[`./Pages/${name}.vue`]; // Get the page component
    page.default.layout = page.default.layout || DashboardLayout; // Assign default layout if not already set
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})