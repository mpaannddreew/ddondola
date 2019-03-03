<template>
    <div>
        <header class="d-flex justify-content-between align-items-start mb-4">
            <span class="visible-items">Showing <strong>1-15 </strong>of <strong>158 </strong>results</span>
            <div class="btn-group">
                <select class="form-control" tabindex="-98">
                    <option value="newest">Fashion</option>
                    <option value="oldest">Electronics</option>
                    <option value="lowest-price">Restaurants</option>
                    <option value="heigh-price">Bars</option>
                </select>
            </div>
        </header>
        <div class="card card-small lo-stats h-100 border">
            <table class="table mb-0">
                <thead class="py-2 bg-light text-semibold border-bottom">
                <tr>
                    <th>Details</th>
                    <th></th>
                    <th class="text-center">Products</th>
                    <th class="text-center">Likes</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr is="shop" :mine="mine"></tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import Shop from './shops/Shop';
    export default {
        name: "Shops",
        components: {Shop},
        data() {
            return {
                shops: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
            }
        },
        methods: {

        },
        props: {
            mine: {
                type: Boolean,
                required: false,
                default: false
            }
        }
    }
</script>

<style scoped>

</style>