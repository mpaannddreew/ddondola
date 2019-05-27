<template>
    <div>
        <div class="main_title_3">
            <span></span>
            <h2><i class="material-icons">folder_open</i> Shops</h2>
            <p>Discover new shops!</p>
            <a :href="directoryUrl">See all <i class="material-icons">arrow_forward</i></a>
        </div>
        <div class="row add_bottom_30">
            <div class="col-lg-6 col-sm-6">
                <a href="javascript:void(0)" class="grid_item small">
                    <figure>
                        <img src="/images/shop-sample.jpg" alt="">
                        <div class="info">
                            <ul class="list-inline text-warning">
                                <li><i class="fa fa-star pr-1"></i></li>
                                <li><i class="fa fa-star pr-1"></i></li>
                                <li><i class="fa fa-star pr-1"></i></li>
                                <li><i class="fa fa-star-o pr-1"></i></li>
                                <li><i class="fa fa-star-o pr-1"></i></li>
                                <li>3.0</li>
                            </ul>
                            <h3 style="line-height: 1.2;">Victoria Secretes</h3>
                        </div>
                    </figure>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6">
                <a href="javascript:void(0)" class="grid_item small">
                    <figure>
                        <img src="/images/shop-sample.jpg" alt="">
                        <div class="info">
                            <ul class="list-inline text-warning">
                                <li><i class="fa fa-star pr-1"></i></li>
                                <li><i class="fa fa-star pr-1"></i></li>
                                <li><i class="fa fa-star pr-1"></i></li>
                                <li><i class="fa fa-star-o pr-1"></i></li>
                                <li><i class="fa fa-star-o pr-1"></i></li>
                                <li>3.0</li>
                            </ul>
                            <h3 style="line-height: 1.2;">Louis Vuitton</h3>
                        </div>
                    </figure>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FeaturedShops",
        data() {
            return {
                shops: []
            }
        },
        computed: {
            directoryUrl() {
                return '/shops';
            }
        }
    }
</script>

<style scoped>

</style>