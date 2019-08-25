<template>
    <div class="central-meta item p-0">
        <div class="user-post px-4 pt-4">
            <div class="friend-info">
                <figure>
                    <img alt="" :src="reviewer.avatar.url" class="img-fluid rounded-circle">
                </figure>
                <div class="friend-name">
                    <ins>
                        <a :href="reviewerProfile" class="name">{{ reviewer.name }}</a>
                        <i class="material-icons">chevron_right</i>
                        <a :href="reviewableUrl" class="name">{{ reviewableName }}</a>
                    </ins>
                    <span class="time">{{ activity.created_at|fromNow }}</span>
                </div>
            </div>
        </div>
        <div class="post-meta mt-2 bg-light p-2 px-4">
            <div class="d-flex align-items-center flex-row">
                <div class="h2 text-warning m-0 pl-0 py-2 pr-2"> <span>{{ activity.rating }}.0</span></div>
                <div class="p-2" style="display: inline-block; width: 87%;">
                    <p class="m-0"><span class="text-warning" v-html="starHtml"></span></p>
                    <p class="m-0 text-ellipsis">{{ activity.body }}</p>
                </div>
            </div>
        </div>
        <div v-if="reviewableIsShop">
            <div class="post-meta m-0 p-0">
                <img :src="reviewable.shop.coverPicture.url" class="img-fluid"/>
            </div>
            <div class="post-meta m-0 bg-light p-2 px-4">
                <div class="detail shop">
                    <a class="btn-link" :href="reviewableUrl"><span class="reviewable">{{ reviewableName }}</span></a>
                    <p class="text-ellipsis text-muted mb-3">{{ reviewable.shop.profile.description }}</p>
                </div>
            </div>
        </div>
        <div class="post-meta m-0 bg-light p-0 pt-0" v-else>
            <div class="card card-small card-post card-post--aside card-post--1">
                <div class="card-post__image border-top-left-radius-0 border-bottom-left-radius-0"
                     :style="{backgroundImage: `url(${reviewable.product.images[0].url})`}">
                    <!--<div class="card-post__author d-flex">-->
                        <!--<a :href="'/shops/' + reviewable.product.shop.code" class="card-post__author-avatar card-post__author-avatar&#45;&#45;small"-->
                           <!--:style="{backgroundImage: 'url(' + reviewable.product.shop.avatar.url + ')'}">-->
                            <!--offered by {{ reviewable.product.shop.name }}</a>-->
                    <!--</div>-->
                </div>
                <div class="card-body w-60">
                    <h5 class="card-title">
                        <a class="btn-link" :href="reviewableUrl">{{ reviewable.product.name }}</a>
                    </h5>
                    <p class="card-text mb-3 text-ellipsis">{{ reviewable.product.description }}</p>
                    <span class="text-muted">
                        <ul class="price list-inline no-margin">
                            <li class="list-inline-item deals_item_price_a" :class="{ 'text-primary': reviewable.product.discount }">
                                {{ reviewable.product.currencyCode }} {{ reviewable.product.discountedPrice }}
                            </li>
                            <li class="list-inline-item deals_item_price_a" style="text-decoration: line-through;" v-if="reviewable.product.discount">
                                {{ reviewable.product.currencyCode }} {{ reviewable.product.price }}
                            </li>
                        </ul>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Activity",
        data() {
            return {}
        },
        props: {
            activity: {
                type: Object,
                required: true
            }
        },
        computed: {
            reviewer() {
                return this.activity.reviewer;
            },
            reviewable() {
                return this.activity.reviewable;
            },
            reviewableType() {
                return this.lowerCase(this.reviewable.type);
            },
            reviewerProfile() {
                return `/people/${this.reviewer.code}`;
            },
            reviewableIsShop() {
                return this.reviewableType === 'shop';
            },
            reviewableUrl() {
                if(!this.reviewableIsShop) {
                    return `/products/${this.reviewable.product.code}`;
                }

                return `/shops/${this.reviewable.shop.code}`;
            },
            reviewableName() {
                if(!this.reviewableIsShop) {
                    return this.reviewable.product.name;
                }

                return this.reviewable.shop.name;
            },
            starHtml() {
                var stars = "";
                var difference = 5 - this.activity.rating;
                for (var i = 1; i <= this.activity.rating; i++) {
                    stars += '<i class="fa fa-star"></i>';
                    if (i === this.activity.rating && difference > 0) {
                        for (var j = 1; j <= difference; j++) {
                            stars += '<i class="fa fa-star-o"></i>';
                        }
                    }
                }

                return stars;
            }
        },
        methods: {

        }
    }
</script>

<style scoped>
    span.time {
        text-transform: lowercase !important;
    }

    .post-meta {
        float: left;
        margin-top: 15px;
        width: 100%;
    }

    .post-meta .detail > a span.reviewable {

        font-size: 20px;
        font-weight: 400;

    }

    .post-meta .detail > a {

        font-size: 12px;
        letter-spacing: 1px;

    }

    .w-60{
        width:60%!important
    }

</style>