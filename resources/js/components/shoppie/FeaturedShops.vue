<template>
    <div>
        <div class="main_title_3">
            <span></span>
            <h2><i class="material-icons">folder_open</i> Shops</h2>
            <p>Discover new shops!</p>
            <a :href="directoryUrl">See all <i class="material-icons">arrow_forward</i></a>
        </div>
        <div class="row add_bottom_30">
            <template v-if="!loaded || (loaded && !hasFeatured)">
                <div class="col-lg-12 col-sm-12">
                    <div align="center" class="my-2" v-if="!loaded">
                        <div class="loader"></div>
                        <p class="m-0">Loading featured shops...</p>
                    </div>
                    <div align="center" class="my-2" v-if="loaded && !hasFeatured">
                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                        <p class="m-0">No featured shops</p>
                    </div>
                </div>
            </template>
            <template v-if="loaded && hasFeatured">
                <div class="col-lg-6 col-sm-6" v-for="(shop, indx) in shops">
                    <a :href="directoryUrl + '/' + shop.code" class="grid_item small">
                        <figure>
                            <img :src="shop.avatar.url" alt="">
                            <div class="info">
                                <mini-rating-meter :reviewable="shop"></mini-rating-meter>
                                <h3 style="line-height: 1.2;" class="text-ellipsis">{{ shop.name }}</h3>
                            </div>
                        </figure>
                    </a>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FeaturedShops",
        mounted() {
            this.fetchFeatured();
        },
        data() {
            return {
                shops: [],
                loaded: false
            }
        },
        computed: {
            directoryUrl() {
                return '/shops';
            }
            ,
            hasFeatured() {
                return this.shops.length > 0;
            }
        },
        methods: {
            fetchFeatured() {
                axios.post(graphql.api, {
                    query: graphql.featuredShops
                }).then(this.loadFeatured).catch(function (error) {});
            },
            loadFeatured(response) {
                this.loaded = true;
                this.shops = response.data.data.shops;
            }
        }
    }
</script>

<style scoped>

</style>