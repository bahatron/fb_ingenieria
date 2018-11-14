import Vue from 'vue';
import Router from 'vue-router';

/**
 * @todo: fix eslint rules to not defining file name index.vue
 */
import Home from './pages/homepage/index.vue';

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'homepage',
            component: Home,
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
