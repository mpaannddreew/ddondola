
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Bus = new Vue();
import VueRouter from 'vue-router';
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component('nav-messenger', require('./components/messenger/NavMessenger.vue'));
Vue.component('nav-cart', require('./components/shoppie/NavCart.vue'));
Vue.component('nav-tray', require('./components/ddondola/NavTray.vue'));
Vue.component('alert', require('./components/ddondola/Alert.vue'));
let Messenger = require('./components/messenger/Messenger.vue');
let ChatArea = require('./components/messenger/ChatArea.vue');
Vue.component('messenger', Messenger);
Vue.component('notifications', require('./components/ddondola/Notifications.vue'));
Vue.component('profile-card', require('./components/ddondola/ProfileCard.vue'));
Vue.component('user-shops', require('./components/shoppie/UserShops'));

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/me/messenger/', component: Messenger,
            children: [
                {
                    // UserProfile will be rendered inside User's <router-view>
                    // when /user/:id/profile is matched
                    path: '/',
                    component: ChatArea
                },
                {
                    // UserPosts will be rendered inside User's <router-view>
                    // when /user/:id/posts is matched
                    path: ':converser_code',
                    component: ChatArea
                }
            ]
        },
        {
            path: '/shops/:shop_code/messenger/', component: Messenger,
            children: [
                {
                    // UserProfile will be rendered inside User's <router-view>
                    // when /user/:id/profile is matched
                    path: '/',
                    component: ChatArea
                },
                {
                    // UserPosts will be rendered inside User's <router-view>
                    // when /user/:id/posts is matched
                    path: ':converser_code',
                    component: ChatArea
                }
            ]
        }
    ]
});

const app = new Vue({
    el: '#app',
    router
});
