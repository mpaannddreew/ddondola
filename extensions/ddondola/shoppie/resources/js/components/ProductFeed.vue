<template>
    <!--<div class="card card-small h-100 border main" style="box-shadow: none;">-->
        <!--<div class="card-header bg-light p-0" v-if="showHeader">-->
            <!--<div class="header-navbar collapse d-lg-flex p-0 bg-light border-bottom">-->
                <!--<div class="container p-0">-->
                    <!--<div class="row">-->
                        <!--<div class="col">-->
                            <!--<ul class="nav nav-tabs nav-justified border-0 flex-column flex-lg-row">-->
                                <!--<li class="nav-item">-->
                                    <!--<a class="nav-link" href="javascript:void(0)" :class="{active: latest}"-->
                                       <!--@click="activateTab('latest')"><i class="material-icons">update</i> Latest</a>-->
                                <!--</li>-->
                                <!--<li class="nav-item">-->
                                    <!--<a class="nav-link" href="javascript:void(0)" :class="{active: popular}"-->
                                       <!--@click="activateTab('popular')"><i class="material-icons">trending_up</i> Popular</a>-->
                                <!--</li>-->
                                <!--<li class="nav-item">-->
                                    <!--<a class="nav-link border-radius" href="javascript:void(0)" :class="{active: recommended}"-->
                                       <!--@click="activateTab('recommended')"><i class="material-icons">verified_user</i> Recommended</a>-->
                                <!--</li>-->
                            <!--</ul>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
        <!--<div class="card-body p-0">-->
            <!--<product-feed-tab :showing="tab"></product-feed-tab>-->
        <!--</div>-->
    <!--</div>-->
    <product-feed-tab :showing="tab"></product-feed-tab>
</template>

<script>
    import ProductFeedTab from "./ProductFeedTab";
    export default {
        name: "ProductFeed",
        components: {ProductFeedTab},
        data() {
            return {
                tab: 'latest',
                showHeader: false
            }
        },
        computed: {
            latest() {
                return this.tab === 'latest';
            },
            popular() {
                return this.tab === 'popular';
            },
            recommended() {
                return this.tab === 'recommended';
            }
        },
        methods: {
            activateTab(tab) {
                this.tab = tab;
            }
        }
    }
</script>

<style scoped>
    .nav-link {
        margin: 0 !important;
    }

    .nav-item {
        border-right:1px solid #e1e5eb!important;
    }

    .nav-item:last-child {
        border-right: none !important;
    }
</style>