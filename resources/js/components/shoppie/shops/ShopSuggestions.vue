<template>
    <div class="card card-small border">
        <div class="card-header border-bottom">
            <h6 class="m-0">{{ title }}</h6>
        </div>
        <div class="card-body p-0">
            <div class="suggestions-list">
                <div class="suggestion-usd">
                    <img src="/images/avatars/0.jpg" alt="" class="rounded w-40">
                    <div class="sgt-text">
                        <h4><a href="#">Jessica William</a></h4>
                        <span>Fashion</span>
                    </div>
                    <span><i class="fa fa-thumbs-o-up"></i></span>
                </div>
                <div class="suggestion-usd">
                    <img src="/images/avatars/0.jpg" alt="" class="rounded w-40">
                    <div class="sgt-text">
                        <h4><a href="#">John Doe</a></h4>
                        <span>Electronics</span>
                    </div>
                    <span><i class="fa fa-thumbs-o-up"></i></span>
                </div>
                <div class="suggestion-usd">
                    <img src="/images/avatars/0.jpg" alt="" class="rounded w-40">
                    <div class="sgt-text">
                        <h4><a href="#">Poonam</a></h4>
                        <span>Furniture</span>
                    </div>
                    <span><i class="fa fa-thumbs-o-up"></i></span>
                </div>
                <div class="suggestion-usd">
                    <img src="/images/avatars/0.jpg" alt="" class="rounded w-40">
                    <div class="sgt-text">
                        <h4><a href="#">Bill Gates</a></h4>
                        <span>Cosmetics</span>
                    </div>
                    <span><i class="fa fa-thumbs-o-up"></i></span>
                </div>
                <div class="suggestion-usd">
                    <img src="/images/avatars/0.jpg" alt="" class="rounded w-40">
                    <div class="sgt-text">
                        <h4><a href="#">Jessica William</a></h4>
                        <span>Groceries</span>
                    </div>
                    <span><i class="fa fa-thumbs-o-up"></i></span>
                </div>
                <div class="suggestion-usd">
                    <img src="/images/avatars/0.jpg" alt="" class="rounded w-40">
                    <div class="sgt-text">
                        <h4><a href="#">John Doe</a></h4>
                        <span>Restaurant</span>
                    </div>
                    <span><i class="fa fa-thumbs-o-up"></i></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShopSuggestions",
        data() {
            return {}
        },
        props: {
            title: {
                type: String,
                required: false,
                default: "Suggestions"
            }
        }
    }
</script>

<style scoped>

</style>