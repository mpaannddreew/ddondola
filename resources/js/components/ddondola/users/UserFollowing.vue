<template>
    <div class="friend-list">
        <div class="row">
            <div class="col-md-4 col-sm-4" v-for="(indx, shop) in shops" :key="indx">
                <div is="shop-card"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import ShopCard from "../../shoppie/shops/ShopCard";
    export default {
        name: "UserFollowing",
        components: {ShopCard},
        data() {
            return {
                shops: [1, 2, 3, 4]
            }
        }
    }
</script>

<style scoped>

</style>