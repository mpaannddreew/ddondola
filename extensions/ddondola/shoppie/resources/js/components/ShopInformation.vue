<template>
    <div :class="{'h-100-directory': directory, 'h-100': !directory}" style="overflow-x: hidden; overflow-y: auto;">
        <div class="card card-small user-details" :class="{border: withBorder}">
            <div class="card-header p-0" style="border-radius: 0 !important;">
                <div class="user-details__bg">
                    <img :src="shop.coverPicture.url" alt="User Details Background Image">
                </div>
            </div>
            <div class="card-body p-0 border-0">
                <div class="user-details__avatar mx-auto border lis-border-width-4" style="box-shadow: none !important; border-radius: 5px !important; border: medium solid rgb(255, 255, 255) !important;">
                    <img :src="shop.avatar.url" alt="User Avatar">
                </div>
                <h4 class="text-center m-0 mt-2" v-if="directory">{{ shop.name }}</h4>
                <h4 class="text-center m-0 mt-2" v-else>
                    <a :href="url" class="btn-link" v-if="!directory">
                        {{ shop.name }}
                    </a>
                </h4>
                <p class="text-center text-light m-0 mb-2">
                    <mini-rating-meter :reviewable="shop"></mini-rating-meter>
                    <small class="text-muted">{{ shop.averageRating }} average based on {{ shop.reviewCount }} {{ text }}</small>
                </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-4" v-for="(p, i) in shop.profile" v-if="p.length">
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
            },
            directory: {
                type: Boolean,
                default: true
            },
            withBorder: {
                type: Boolean,
                default: false
            }
        },
        filters: {
            ucFirst(data) {
                return _.upperFirst(data);
            },
            camel(data) {
                return _.startCase(data);
            }
        },
        computed: {
            text() {
                return this.shop.reviewCount === 1 ? 'review': 'reviews';
            },
            url() {
                return `/shops/${this.shop.code}`;
            }
        }
    }
</script>

<style scoped>
    .h-100-directory {
        height: calc(99.9vh - 13.7rem - 1px) !important;
    }

    li.list-group-item.p-4:first-child {
        border-top: none !important;
    }
</style>