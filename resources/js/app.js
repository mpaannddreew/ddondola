
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

import ChatArea from './components/messenger/ChatArea.vue';
import ChatAreaEmpty from './components/messenger/ChatAreaEmpty.vue';
import ShopDirectoryArea from './components/shoppie/ShopDirectoryArea.vue';
import ProductDirectoryArea from './components/shoppie/ProductDirectoryArea.vue';
import MyOrders from './components/shoppie/MyOrders.vue';
import OrderDetails from './components/shoppie/orders/OrderDetails.vue';
import ShopOrders from './components/shoppie/ShopOrders.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/me/messenger', component: ChatAreaEmpty},
        {path: '/me/messenger/:participant', component: ChatArea, props: true},
        {path: '/me/orders', component: MyOrders},
        {path: '/me/orders/:order', component: OrderDetails, props: true},
        {path: '/shops/:initiator/messenger', component: ChatAreaEmpty, props: true},
        {path: '/shops/:initiator/messenger/:participant', component: ChatArea, props: true},
        {path: '/shops/:shop/orders', component: ShopOrders, props: true},
        {path: '/shops/:shop/orders/:order', component: OrderDetails, props: true},
        {path: '/shops', component: ShopDirectoryArea, props: true},
        {path: '/shops/:category', component: ShopDirectoryArea, props: true},
        {path: '/products', component: ProductDirectoryArea, props: true},
        {path: '/products/:category', component: ProductDirectoryArea, props: true}
    ]
});

const app = new Vue({
    el: '#app',
    router
});
