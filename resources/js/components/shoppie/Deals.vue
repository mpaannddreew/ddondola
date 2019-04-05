<template>
    <div>
        <div class="card card-small border" v-if="!loaded">
            <div class="card-body">
                <div align="center"><div class="loader"></div></div>
            </div>
        </div>
        <div class="card card-small border" v-else-if="loaded && hasDeals">
            <div class="card-body p-0">
                <div class="deals m-0">
                    <div class="deals_title">Active shop deals</div>
                    <div class="deals_slider_container">

                        <!-- Deals Slider -->
                        <div class="deals_slider">
                            <div v-for="(deal, indx) in deals" v-if="isActive(indx)">
                                <!-- Deals Item -->
                                <deal :deal="deal" :key="indx"></deal>
                            </div>
                        </div>

                    </div>

                    <div class="deals_slider_nav_container">
                        <div class="deals_slider_prev deals_slider_nav">
                            <i class="fa fa-chevron-left ml-auto" @click="previous"></i>
                        </div>
                        <div class="deals_slider_next deals_slider_nav">
                            <i class="fa fa-chevron-right ml-auto" @click="next"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Deal from "./Deal";
    export default {
        name: "Deals",
        components: {Deal},
        mounted() {
            this.fetchOffers();
        },
        data() {
            return {
                deals: [],
                loaded: false,
                active: 0
            }
        },
        props: {
            shop: {
                type: Object,
                required: true
            }
        },
        computed: {
            hasDeals() {
                return this.dealsCount > 0;
            },
            dealsCount() {
                return this.deals.length;
            }
        },
        watch: {
            deals: {
                handler(data) {
                    console.log(data.length);
                    if (data.length > 0) {
                        this.initDealsSlider();
                    }
                },
                deep: true
            }
        },
        methods: {
            fetchOffers() {
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.activeShopOffers,
                    variables: {shopId: this.shop.id, ordering: "active", count: 1, page: 1}
                }).then(this.loadOffers).catch(function(error){});
            },
            loadOffers(response) {
                this.loaded = true;
                this.deals = response.data.data.shop.deals;
            },
            isActive(indx) {
                return this.active === indx;
            },
            previous() {
                if (this.active > 0) {
                    this.active --;
                }
            },
            next() {
                if (this.active < (this.dealsCount - 1)) {
                    this.active ++;
                }
            }
        }
    }
</script>

<style scoped>

</style>