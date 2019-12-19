<template>
    <li class="nav-item border-right dropdown notifications">
        <a class="nav-link nav-link-icon text-center" :href="cartUrl" role="button">
            <div class="nav-link-icon__wrapper">
                <i class="material-icons">{{ icon }}</i>
                <span class="badge badge-pill badge-danger" v-show="showCount">{{ count }}</span>
            </div>
        </a>
    </li>
</template>

<script>
    export default {
        name: "NavCart",
        mounted() {
            this.fetchCartSize();
            this.listenToCartEvents();
        },
        data() {
            return {
                count: 0,
                cartUrl: '/me/cart'
            }
        },
        computed: {
            showCount() {
                return this.count > 0;
            },
            icon() {
                return this.showCount ? 'shopping_cart': 'remove_shopping_cart';
            }
        },
        methods: {
            fetchCartSize() {
                axios.post(graphql.api, {query: graphql.myCart})
                    .then(this.loadCartSize).catch(function (error) {});
            },
            loadCartSize(response) {
                this.count = response.data.data.me.cart.productCount;
            },
            listenToCartEvents() {
                Echo.private(`user.${this.authCode}`)
                    .listen('.cart.update', (e) => {
                        this.count = e.count;
                    });
            }
        },
        watch: {
            count: {
                handler: function (count) {
                    if (count < 0) {
                        this.count = 0;
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>