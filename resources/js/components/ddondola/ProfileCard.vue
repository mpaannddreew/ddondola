<template>
    <div class="profile-card mb-3">
        <img src="/images/avatars/0.jpg" alt="user" class="profile-photo">
        <h5><a :href="profileUrl" class="text-white">John Doe</a></h5>
        <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> 1,299 followers</a>
    </div>
</template>

<script>
    export default {
        name: "ProfileCard",
        data() {
            return {

            }
        },
        props: {
            profileUrl: {
                type: String,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>