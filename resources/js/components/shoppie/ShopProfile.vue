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
    export default {
        name: "ShopProfile",
        data() {
            return {}
        },
        props: {
            shop: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>