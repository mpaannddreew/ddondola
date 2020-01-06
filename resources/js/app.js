
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

import Helper from './helpers';
Vue.use(Helper, {auth: Auth, csrf: Token.content, seller: Seller, authCode: Code});

import VueTelInput from 'vue-tel-input'

Vue.use(VueTelInput);

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
import ShopOrderDetails from './components/shoppie/orders/ShopOrderDetails';
import Invoice from './components/shoppie/orders/Invoice';
import Payment from './components/shoppie/orders/Payment';
import Transactions from './components/bank/Transactions';
import Deposit from './components/bank/Deposit';
import Withdraw from './components/bank/Withdraw';
import CreateWithdraw from './components/bank/CreateWithdraw';
import Escrow from './components/bank/Escrow';

const router = new VueRouter({
    mode: 'history',
    routes: [
        // cart app
        {path: '/me/cart', component: Cart},
        {path: '/me/cart/checkout', component: Checkout},

        // user messenger app
        {path: '/me/messenger', component: ChatAreaEmpty},
        {path: '/me/messenger/:participant', component: ChatArea, props: true},

        // user orders app
        {path: '/me/orders', component: OrderDetailsEmpty},
        {path: '/me/orders/:order', component: OrderDetails, props: true},
        {path: '/me/orders/:order/invoice', component: Invoice, props: true},
        {path: '/me/orders/:order/payment', component: Payment, props: true},

        // user wallet app
        {path: '/me/wallet', component: Transactions},
        {path: '/me/wallet/deposit', component: Deposit},
        {path: '/me/wallet/withdraw', component: Withdraw},
        {path: '/me/wallet/withdraw/create', component: CreateWithdraw},
        {path: '/me/wallet/escrow', component: Escrow},

        // shop messenger app
        {path: '/shops/:initiator/messenger', component: ChatAreaEmpty, props: true},
        {path: '/shops/:initiator/messenger/:participant', component: ChatArea, props: true},

        // shop orders app
        {path: '/shops/:shop/orders', component: OrderDetailsEmpty, props: true},
        {path: '/shops/:shop/orders/:order', component: ShopOrderDetails, props: true},

        // shop wallet app
        {path: '/shops/:shop/wallet', component: Transactions, props: true},
        {path: '/shops/:shop/wallet/deposit', component: Deposit, props: true},
        {path: '/shops/:shop/wallet/withdraw', component: Withdraw, props: true},
        {path: '/shops/:shop/wallet/withdraw/create', component: CreateWithdraw, props: true},
        {path: '/shops/:shop/wallet/Escrow', component: Escrow, props: true},

        // admin wallet app
        {path: '/admin/wallet', component: Transactions, props: { admin: true }},
        {path: '/admin/wallet/deposit', component: Deposit, props: { admin: true }},
        {path: '/admin/wallet/withdraw', component: Withdraw, props: { admin: true }},
        {path: '/admin/wallet/withdraw/create', component: CreateWithdraw, props: { admin: true }},
        {path: '/admin/wallet/Escrow', component: Escrow, props: { admin: true }},
    ]
});

const app = new Vue({
    el: '#app',
    router
});