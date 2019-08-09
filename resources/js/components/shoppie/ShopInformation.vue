<template>
    <div class="h-100" style="overflow-x: hidden; overflow-y: auto;">
        <div class="card card-small user-details">
            <div class="card-header p-0" style="border-radius: 0 !important;">
                <div class="user-details__bg">
                    <img :src="shop.coverPicture.url" alt="User Details Background Image">
                </div>
            </div>
            <div class="card-body p-0">
                <div class="user-details__avatar mx-auto border lis-border-width-4" style="box-shadow: none !important; border-radius: 5px !important; border: medium solid rgb(255, 255, 255) !important;">
                    <img :src="shop.avatar.url" alt="User Avatar">
                </div>
                <h4 class="text-center m-0 mt-2">{{ shop.name }}</h4>
                <p class="text-center text-light m-0 mb-2">
                    <mini-rating-meter :reviewable="shop"></mini-rating-meter>
                </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-4" v-for="(p, i) in shop.profile">
                    <strong class="text-muted d-block mb-2">{{ i|camel|ucFirst }}</strong>
                    <span>
                        {{ p }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShopInformation",
        props: {
            shop: {
                type: Object,
                required: true
            }
        },
        filters: {
            ucFirst(data) {
                return _.upperFirst(data);
            },
            camel(data) {
                return _.camelCase(data);
            }
        }
    }
</script>

<style scoped>
    .h-100 {
        height: calc(99.9vh - 13.7rem - 1px) !important;
    }
</style>