import Vue from "vue";
import Router from "vue-router";
import store from "./store";
/**
 * @todo: fix eslint rules to not defining file name index.vue
 */
import Home from "./pages/homepage/HomePage.vue";
import Login from "./pages/login/LoginPage.vue";

Vue.use(Router);

const router = new Router({
    routes: [
        {
            path: "/",
            name: "homepage",
            component: Home,
        },
        {
            path: "/login",
            name: "login",
            component: Login,
        },
        {
            path: "/admin",
            name: "mainAdminPage",
            component: () => import(/* webpackChunkName: "AdminPage" */ "./pages/admin/MainAdminPage.vue"),
            meta: {
                requiresAuth: true,
            },
            children: [
                {
                    path: "",
                    component: () => import(/* webpackChunkName: "AdminPage" */ "./components/admin/AdminDashboard.vue"),
                    meta: {
                        requiresAuth: true, // is this really necessary for children pages?
                    },
                },
                {
                    path: "clients",
                    name: "clientAdminPage",
                    component: () => import(/* webpackChunkName: "ClientAdminPage" */ "./pages/admin/ClientAdminPage.vue"),
                    meta: {
                        requiresAuth: true, // is this really necessary for children pages?
                    },
                },
                {
                    path: "projects",
                    name: "projectAdminPage",
                    component: () => import(/* webpackChunkName: "ClientAdminPage" */ "./components/project/pages/ProjectAdminPage.vue"),
                },
            ],
        },
    ],
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!store.getters["auth/user"]) {
            next({ name: "login" });
        } else {
            next();
        }
    } else {
        next(); // make sure to always call next()!
    }
});

export default router;
