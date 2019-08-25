<template>
    <div>
        <div class="main_title_3">
            <span></span>
            <h2><i class="material-icons">local_mall</i> Products</h2>
            <p>Browse the most desirable products</p>
            <a :href="directoryUrl">See all <i class="material-icons">arrow_forward</i></a>
        </div>
        <div class="row add_bottom_30">
            <template v-if="!loaded || (loaded && !hasFeatured)">
                <div class="col-lg-12 col-sm-12">
                    <div align="center" class="my-2" v-if="!loaded">
                        <div class="loader"></div>
                        <p class="m-0">Loading featured products...</p>
                    </div>
                    <div align="center" class="my-2" v-if="loaded && !hasFeatured">
                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                        <p class="m-0">No featured products</p>
                    </div>
                </div>
            </template>
            <template v-if="loaded && hasFeatured">
                <div :class="classObject" v-for="(product, indx) in products">
                    <a :href="`${directoryUrl}/${product.code}`" class="grid_item small">
                        <figure>
                            <img :src="product.images[0].url" alt="">
                            <div class="info">
                                <mini-rating-meter :reviewable="product"></mini-rating-meter>
                                <h3 style="line-height: 1.2;" class="text-ellipsis">{{ product.name }}</h3>
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
        name: "FeaturedProducts",
        mounted() {
            this.fetchFeatured();
        },
        data() {
            return {
                products: [],
                loaded: false
            }
        },
        props: {
            count: {
                type: Number,
                default: 2
            }
        },
        computed: {
            directoryUrl() {
                return '/products';
            },
            hasFeatured() {
                return this.products.length > 0;
            },
            classObject() {
                return {'col-lg-6 col-sm-6': this.count === 2, 'col-lg-4 col-sm-6': this.count === 3, 'col-lg-3 col-sm-6': this.count === 4}
            }
        },
        methods: {
            fetchFeatured() {
                axios.post(graphql.api, {
                    query: graphql.featuredProducts,
                    variables: {count: this.count}
                }).then(this.loadFeatured).catch(function (error) {});
            },
            loadFeatured(response) {
                this.loaded = true;
                this.products = response.data.data.products;
            }
        }
    }
</script>

<style scoped>

</style>