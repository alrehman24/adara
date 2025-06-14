import { createWebHistory, createRouter } from "vue-router";
// import test from './test.vue'
// import Layout from './frontTemplate/Layout.vue'
import Index from "./frontTemplate/Index.vue";
import Category from "./views/Category.vue";
import Layout from "./frontTemplate/Layout.vue";
import ProductDetail from "./views/ProductDetail.vue";

const routes = [
    {
        path: "/",
        component: Layout,
        children: [
            {
                name: "Index",
                path: "/",
                component: Index,
            },
            {
                path: "category/:slug", // or just 'category' if no dynamic part
                name: "Category",
                component: Category,
            },
            {
                path: "product/:slug", // or just 'category' if no dynamic part
                name: "Product",
                component: ProductDetail,
            }
            // Add other pages similarly
        ],
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;
