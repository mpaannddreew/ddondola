<template>
    <li class="nav-item border-right dropdown notifications">
        <a class="nav-link nav-link-icon text-center" :href="cartUrl" role="button">
            <div class="nav-link-icon__wrapper">
                <i class="material-icons">shopping_cart</i>
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
                Bus.$on('cart-size', this.amendSize);
            },
            amendSize(event) {
                if (event.type === 'increase') {
                    this.count += event.count;
                } else {
                    this.count -= event.count;
                }
            }
        }
    }
</script>

<style scoped>

</style>