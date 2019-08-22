
/**
 * First we will loading all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./queries');
window.Routes = [];
window.Vue = require('vue');
window.Bus = new Vue();
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueContentPlaceholders from 'vue-content-placeholders';
Vue.use(VueContentPlaceholders);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import ChatArea from './components/messenger/ChatArea';
import ChatAreaEmpty from './components/messenger/ChatAreaEmpty';
import Cart from './components/shoppie/cart/Cart';
import Checkout from './components/shoppie/cart/Checkout';
import OrderDetailsEmpty from './components/shoppie/orders/OrderDetailsEmpty';
import OrderDetails from './components/shoppie/orders/OrderDetails';
import UserDetailsEmpty from './components/ddondola/admin/UserAdminEmpty';
import UsersDetails from './components/ddondola/admin/UserAdmin';
import ShopAdminEmpty from './components/shoppie/admin/ShopAdminEmpty';
import ShopAdmin from './components/shoppie/admin/ShopAdmin';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/me/cart', component: Cart},
        {path: '/me/cart/checkout', component: Checkout},
        {path: '/me/messenger', component: ChatAreaEmpty},
        {path: '/me/messenger/:participant', component: ChatArea, props: true},
        {path: '/me/orders', component: OrderDetailsEmpty},
        {path: '/me/orders/:order', component: OrderDetails, props: true},
        {path: '/shops/:initiator/messenger', component: ChatAreaEmpty, props: true},
        {path: '/shops/:initiator/messenger/:participant', component: ChatArea, props: true},
        {path: '/shops/:shop/orders', component: OrderDetailsEmpty, props: true},
        {path: '/shops/:shop/orders/:order', component: OrderDetails, props: true},
        {path: '/admin/users', component: UserDetailsEmpty},
        {path: '/admin/users/:user', component: UsersDetails, props: true},
        {path: '/admin/shops', component: ShopAdminEmpty},
        {path: '/admin/shops/:shop', component: ShopAdmin, props: true}
    ]
});

const app = new Vue({
    el: '#app',
    router
});

// function formatNumber(num) {
//     return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
// }