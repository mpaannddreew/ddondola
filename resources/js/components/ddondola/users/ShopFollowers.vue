<template>
    <div class="friend-list">
        <div class="row">
            <div class="col-md-4 col-sm-4" v-for="(indx, user) in users" :key="indx">
                <div is="user-card"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserCard from "./UserCard";
    export default {
        name: "ShopFollowers",
        components: {UserCard},
        data() {
            return {
                users: [1, 2, 3, 4]
            }
        }
    }
</script>

<style scoped>

</style>