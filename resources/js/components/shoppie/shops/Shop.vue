<template>
    <div class="thingsBox thinsSpace card border" data-marker-id="1">
        <div class="thingsImage"><img src="/images/hero-area.jpg" alt="Image things">
            <div class="thingsMask">
                <ul class="list-inline rating">
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                </ul>
                <a :href="shopUrl">
                    <h2>
                        {{ shop.name }}
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                    </h2>
                </a>
                <p>215 Terry Lane, New York</p>
            </div>
        </div>
        <div class="thingsCaption">
            <ul class="list-inline captionItem">
                <li><i class="material-icons">thumb_up</i> 8 K</li>
                <li><a href="javascript:void(0)"> {{ shop.category.name }}</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Shop",
        data() {
            return {}
        },
        props: {
            mine: {
                type: Boolean,
                required: true
            },
            shop: {
                type: Object,
                required: true
            },
            url: {
                type: String,
                required: true
            }
        },
        computed: {
            shopUrl() {
                return this.url + "/shops/" + this.shop.code;
            }
        }
    }
</script>

<style scoped>

</style>