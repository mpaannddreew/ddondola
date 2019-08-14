<template>
    <div>
        <div class="card card-small border">
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-4">
                    <strong class="text-muted d-block mb-2">About</strong>
                    <span>{{ about }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AboutShop",
        props: {
            shop: {
                type: Object,
                required: true
            }
        },
        computed: {
            about() {
                return Collect(this.shop.profile).get('about', '');
            }
        }
    }
</script>

<style scoped>

</style>