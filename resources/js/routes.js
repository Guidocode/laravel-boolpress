import Vue from "vue";

import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomeComp from './components/pages/HomeComp';
import BlogComp from './components/pages/BlogComp';
import AboutComp from './components/pages/AboutComp';
import ContactsComp from './components/pages/ContactsComp';

const router = new VueRouter({

    mode: 'history',

    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeComp
        },
        {
            path: '/blog',
            name: 'blog',
            component: BlogComp
        },
        {
            path: '/chi-siamo',
            name: 'about',
            component: AboutComp
        },
        {
            path: '/contatti',
            name: 'contacts',
            component: ContactsComp
        }
    ]
});

export default router;
