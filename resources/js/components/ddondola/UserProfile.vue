<template>
    <div class="row">
        <div class="col-md-3">
            <info></info>
        </div>
        <div class="col-md-6">
            <about></about>
        </div>
        <div class="col-md-3">

        </div>
    </div>
</template>

<script>
    import Info from "./profile/UserInfo";
    import About from "./profile/AboutUser";
    export default {
        name: "UserProfile",
        components: {About, Info}
    }
</script>

<style scoped>

</style>