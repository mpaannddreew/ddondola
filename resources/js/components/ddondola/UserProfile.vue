<template>
    <div class="row">
        <div class="col-md-3">
            <about></about>
        </div>
        <div class="col-md-9">
            <activities></activities>
        </div>
    </div>
</template>

<script>
    import About from "./profile/About";
    export default {
        name: "UserProfile",
        components: {About}
    }
</script>

<style scoped>

</style>