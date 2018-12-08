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
            name: "admin",
            component: () => import(/* webpackChunkName: "AdminPage" */ "./pages/admin/MainAdminPage.vue"),
            meta: {
                requiresAuth: true,
            },
            children: [
                {
                    path: "clients",
                    component: () => import(/* webpackChunkName: "ClientAdminPage" */ "./modules/client/ClientAdminPage.vue"),
                    meta: {
                        requiresAuth: true, // is this really necessary for children pages?
                    },
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
