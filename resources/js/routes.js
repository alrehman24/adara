import { createWebHistory, createRouter } from "vue-router";
// import test from './test.vue'
// import Layout from './frontTemplate/Layout.vue'
import Index from "./frontTemplate/Index.vue";
import Category from "./frontTemplate/Category.vue";
import Layout from "./frontTemplate/Layout.vue";

// const routes = [

//     {
//         name: 'Index',
//         path: '/',
//         component: Index,

//     }, {
//         name: 'Category',
//         path: '/category/:slug?',
//         component: Category,

//     },

// ];
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
            // Add other pages similarly
        ],
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;
