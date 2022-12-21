import { createApp } from "vue";
import { createRouter, createWebHashHistory } from "vue-router";
import routes from "./routes";
import "./bootstrap";

import App from "./App.vue";

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

const app = createApp(App);
app.use(router);
app.mount("#app");
