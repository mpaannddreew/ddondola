<template>
    <div class="friend-card border">
        <img src="/images/hero_in_shop_detail.jpg" alt="profile-cover" class="img-responsive cover">
        <div class="card card-info">
            <img src="/images/avatars/0.jpg" alt="user" class="profile-photo-lg">
            <div class="friend-info">
                <button class="pull-right btn btn-sm btn-pill btn-outline-primary"><i class="fa fa-user-plus"></i> Follow</button>
                <h5><a href="#" class="profile-link">Sophia Lee</a></h5>
                <p class="mb-2">Student at Harvard</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserCard"
    }
</script>

<style scoped>

</style>