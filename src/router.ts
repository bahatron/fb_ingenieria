import Vue from 'vue';
import Router from 'vue-router';
import store from './store';
/**
 * @todo: fix eslint rules to not defining file name index.vue
 */
import Home from './pages/homepage/index.vue';
import Login from './pages/login/index.vue';

Vue.use(Router);

const router = new Router({
    routes: [
        {
            path: '/',
            name: 'homepage',
            component: Home,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/admin',
            name: 'admin',
            component: () => import(/* webpackChunkName: "Admin" */ './pages/admin/index.vue'),
            meta: {
                requiresAuth: true,
            },
        },
        // {
        //     path: '/about',
        //     name: 'about',
        //     // route level code-splitting
        //     // this generates a separate chunk (about.[hash].js) for this route
        //     // which is lazy-loaded when the route is visited.
        //     component: () => import(/* webpackChunkName: "about" */ './views/About.vue'),
        // },
    ],
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!store.getters['auth/user']) {
            next({ name: 'login' });
        } else {
            next();
        }
    } else {
        next(); // make sure to always call next()!
    }
});

export default router;
