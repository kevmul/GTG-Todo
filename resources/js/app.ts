import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { createRouter, createWebHashHistory } from 'vue-router';
import routes from './routes';

import App from './App.vue';
import InlineSvg from './components/InlineSvg';

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

const pinia = createPinia();

const app = createApp(App);
app.use(router);
app.use(pinia);
app.component('InlineSvg', InlineSvg);
app.mount('#app');
