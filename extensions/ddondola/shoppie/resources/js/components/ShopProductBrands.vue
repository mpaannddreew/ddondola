<template>
    <div class="h-100" style="overflow-x: hidden; overflow-y: auto;">
        <div class="center-xy" v-if="!loaded && !showBrands || !showBrands && loaded">
            <div align="center" v-if="!loaded && !showBrands">
                <div class="loader"></div>
                <p>loading brands...</p>
            </div>
            <div align="center" v-else-if="!showBrands && loaded">
                <h4 class="m-0"><i class="material-icons">error</i></h4>
                <p class="m-0">No brands.</p>
            </div>
        </div>
        <ul class="list-group" v-if="loaded && showBrands">
            <li class="list-group-item" v-for="(brand, indx) in brands" :key="indx">
                <div class="custom-control custom-checkbox mb-1">
                    <input type="checkbox" class="custom-control-input" :id="`brand-${indx}`" v-model="brandIds" :value="brand.id">
                    <label class="custom-control-label" :for="'brand-' + indx">{{ brand.name }} ({{ brand.productCount }})</label>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "ShopProductBrands",
        mounted() {
            this.fetchBrands();
        },
        data() {
            return {
                brands: [],
                brandIds: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
            }
        },
        props: {
            admin: {
                type: Boolean,
                default: false
            },
            shop: {
                type: String,
                required: true
            }
        },
        methods: {
            fetchBrands() {
                axios.post(graphql.api, {
                    query: graphql.shopProductBrands,
                    variables: {shop: this.shop, count: graphql.rowCount, page: this.page}
                }).then(this.loadBrands).catch(function (error){});
            },
            loadBrands(response) {
                this.loaded = true;
                this.brands = response.data.data.shop.brands.data;
                this.paginatorInfo = response.data.data.shop.brands.paginatorInfo;
            }
        },
        computed: {
            showBrands() {
                return this.brands.length > 0;
            },
            brandsHaveProducts() {
                return Collect(this.brands).reject(function(value, key) {
                    return value.productCount === 0;
                }).count() > 0;
            }
        },
        watch: {
            brandIds(data) {
                Bus.$emit("brand-ids", data);
            }
        }
    }
</script>

<style scoped>
    .h-100 {
        height: calc(99.9vh - 13.7rem - 1px) !important;
    }
</style>