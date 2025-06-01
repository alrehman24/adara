// // import './bootstrap';
// import { createApp } from "vue";
// import App from "./App.vue";
// import router from "./routes.js";
// const app = createApp({});
// createApp(App).use(router).mount("#app");

import { createApp } from "vue";
import App from "./App.vue";
import router from "./routes.js";
import helpers from "./utils/helpers.js";

// Create a single app instance
const app = createApp(App);

// Register helpers globally
app.config.globalProperties.$helpers = helpers;

// Use the router and mount the app
app.use(router).mount("#app");
