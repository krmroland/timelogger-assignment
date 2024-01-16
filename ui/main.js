import App from "./App.vue";

import { createApp } from "vue";

import "./scss/app.scss";

import { registerPlugins } from "@/plugins";

const app = createApp(App);

registerPlugins(app);

app.mount("#app");

window.$app = app;
