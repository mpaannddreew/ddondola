<template>
    <div>
        <ul class="nav nav-tabs border-bottom-0">
            <li class="nav-item mr-1">
                <a class="nav-link border-radius" href="javascript:void(0)" :class="{active: latest}"
                   @click="activateTab('latest')"><i class="material-icons">update</i> Latest</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-radius" href="javascript:void(0)" :class="{active: popular}"
                   @click="activateTab('popular')"><i class="material-icons">trending_up</i> Popular</a>
            </li>
            <li class="nav-item ml-1">
                <a class="nav-link border-radius" href="javascript:void(0)" :class="{active: recommended}"
                   @click="activateTab('recommended')"><i class="material-icons">verified_user</i> Recommended</a>
            </li>
        </ul>
        <div class="py-1">
            <product-feed-tab :showing="tab"></product-feed-tab>
        </div>
    </div>
</template>

<script>
    import ProductFeedTab from "./ProductFeedTab";
    export default {
        name: "ProductFeed",
        components: {ProductFeedTab},
        data() {
            return {
                tab: 'latest'
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

</style>