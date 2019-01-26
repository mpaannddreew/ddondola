<template>
    <div class="pb-4">
        <div class="row">
            <div class="col-md-6" v-for="(indx, shop) in shops">
                <div is="shop"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import Shop from "../../shoppie/shops/Shop";
    export default {
        name: "UserFollowing",
        components: {Shop},
        data() {
            return {
                shops: [1, 2, 3, 4]
            }
        }
    }
</script>

<style scoped>

</style>