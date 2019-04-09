<template>
    <div>
        <div class="card card-small border" v-if="!loaded">
            <div class="card-body">
                <div align="center"><div class="loader"></div></div>
            </div>
        </div>
        <div class="card card-small border" v-else-if="loaded && hasDeals">
            <div class="card-header border-bottom">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-left mb-sm-0">
                        <h5 class="page-title m-0">Deals</h5>
                    </div>
                    <div class="col-12 col-sm-6 d-flex align-items-center">
                        <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group" aria-label="Table row actions">
                            <a href="javascript:void(0)" class="btn btn-white" :class="{disabled: !hasPrevious}" @click="previous">
                                <i class="fa fa-chevron-left ml-auto"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-white" :class="{disabled: !hasNext}" @click="next">
                                <i class="fa fa-chevron-right ml-auto"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="deals m-0 p-0">
                    <div class="deals_slider_container">

                        <!-- Deals Slider -->
                        <div class="deals_slider">
                            <div v-for="(deal, indx) in deals" v-if="isActive(indx)">
                                <!-- Deals Item -->
                                <deal :deal="deal" :key="indx"></deal>
                            </div>
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
            },
            hasNext() {
                return this.active < (this.dealsCount - 1)
            },
            hasPrevious() {
                return this.active > 0;
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
                if (this.hasPrevious) {
                    this.active --;
                }
            },
            next() {
                if (this.hasNext) {
                    this.active ++;
                }
            }
        }
    }
</script>

<style scoped>

</style>