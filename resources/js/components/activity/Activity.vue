<template>
    <div class="central-meta item">
        <div class="user-post">
            <div class="friend-info">
                <figure>
                    <img alt="" :src="actor.avatar.url" class="img-fluid rounded-circle">
                </figure>
                <div class="friend-name">
                    <ins>
                        <a :href="actorProfile" class="name">{{ actor.name }}</a> {{ action }} <a :href="subjectUrl" class="name">{{ subjectName }}</a>
                    </ins>
                    <span class="time">{{ time }} <span v-html="offerTimeline" :class="offerState"></span></span>
                </div>
                <div class="description my-2" v-if="subjectType === 'product' && activity.verb !== 'review' && activity.verb !== 'offer'">
                    <p class="text-ellipsis m-0" v-if="subject.product.description">
                        <i class="material-icons">description</i> {{ subject.product.description }}
                    </p>
                    <p class="m-0 mt-1">
                        <span class="badge badge-info mr-1">{{ subject.product.brand.name }}</span>
                        <span class="badge badge-info mr-1">{{ subject.product.category.name }}</span>
                        <span class="badge badge-info mr-1">{{ subject.product.subcategory.name }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="post-meta m-0" v-if="subjectHasImages">
            <ul class="photos gallery-small">
                <li v-for="(image, indx) in subject.product.images">
                    <a class="strip" :href="image.url" title="" data-strip-group="mygroup" data-strip-group-options="loop: false" :key="indx">
                        <img :src="image.url" alt="">
                    </a>
                </li>
            </ul>
        </div>
        <div class="post-meta mt-2 bg-light border" v-if="subjectType === 'shop' && activity.verb !== 'review'" style="border-radius: 4px;">
            <div class="linked-image align-left m-0 mr-2">
                <a title="" :href="subjectUrl"><img alt="" :src="subject.shop.avatar.url"></a>
            </div>
            <div class="detail">
                <a :href="subjectUrl"><span class="text-primary text-ellipsis">{{ subjectName }}</span></a>
                <p class="my-1 text-ellipsis"><i class="material-icons">description</i> {{ subject.shop.profile.description }}</p>
                <p class="badge badge-secondary m-0">{{ subject.shop.category.name }}</p>
            </div>
        </div>
        <div class="post-meta mt-2 bg-light border p-2" v-if="foreignIsReview" style="border-radius: 4px;">
            <div class="d-flex align-items-center flex-row">
                <div class="p-2 h2 text-warning m-0"> <span>{{ foreign.review.rating }}.0</span></div>
                <div class="p-2" style="display: inline-block; width: 87%;">
                    <p class="m-0"><span class="text-warning" v-html="starHtml"></span></p>
                    <p class="m-0 text-ellipsis">{{ foreign.review.body }}</p>
                </div>
            </div>
        </div>
        <div class="post-meta mt-2 bg-light border" v-if="foreignIsOffer" style="border-radius: 4px;">
            <div class="linked-image align-left m-0 mr-2">
                <a title="" :href="subjectUrl"><img alt="" :src="subject.product.images[0].url"></a>
            </div>
            <div class="detail">
                <a :href="subjectUrl"><span class="text-primary text-ellipsis">{{ subjectName }}</span></a>
                <p class="my-1 text-ellipsis"><i class="material-icons">description</i> {{ subject.product.description }}</p>
                <div class="price-wrap">
                    <span class="price-new b">{{ subject.product.currencyCode }} {{ discountedPrice }}</span>
                    <del class="price-old text-muted">{{ subject.product.currencyCode }} {{ subject.product.price }}</del>
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
            actor() {
                return this.activity.actor;
            },
            subject() {
                return this.activity.subject;
            },
            foreign() {
                return this.activity.foreign;
            },
            subjectType() {
                return _.lowerCase(this.subject.type);
            },
            time() {
                return _.lowerCase(Moment(this.activity.created_at).fromNow());
            },
            actorProfile() {
                return (_.lowerCase(this.actor.type) === 'user' ? "/people/": "/shops/") + this.actor.code;
            },
            action() {
                return this.activity.action;
            },
            subjectUrl() {
                if (this.subjectType === 'user') {
                    return "/people/" + this.subject.user.code;
                }else if(this.subjectType === 'product') {
                    return "/products/" + this.subject.product.code;
                }else if(this.subjectType === 'shop') {
                    return "/shops/" + this.subject.shop.code;
                }

                return '';
            },
            subjectName() {
                if (this.subjectType === 'user') {
                    return this.subject.user.name;
                }else if(this.subjectType === 'product') {
                    return this.subject.product.name;
                }else if(this.subjectType === 'shop') {
                    return this.subject.shop.name;
                }

                return '';
            },
            subjectHasImages() {
                return this.subjectType === 'product' && this.activity.verb !== 'review' && this.activity.verb !== 'offer';
            },
            foreignIsReview() {
                return this.foreign && this.activity.verb === 'review' && this.foreign !== null;
            },
            foreignIsOffer() {
                return this.subjectType === 'product' && this.activity.verb === 'offer' && this.foreign !== null;
            },
            starHtml() {
                var stars = "";
                if (this.foreignIsReview) {
                    var difference = 5 - this.foreign.review.rating;
                    for (var i = 1; i <= this.foreign.review.rating; i++) {
                        stars += '<i class="fa fa-star"></i>';
                        if (i === this.foreign.review.rating && difference > 0) {
                            for (var j = 1; j <= difference; j++) {
                                stars += '<i class="fa fa-star-o"></i>';
                            }
                        }
                    }
                }

                return stars;
            },
            discountedPrice() {
                if (this.foreignIsOffer)
                    return this.subject.product.price - (this.subject.product.price * (this.foreign.offer.discount/100));
                return "";
            },
            offerTimeline() {
                if (this.foreignIsOffer)
                    return "[<i class='material-icons'>date_range</i> "
                        + this.humanize(this.foreign.offer.start_date)  + " - " + this.humanize(this.foreign.offer.end_date) + "]";
                return "";
            },
            offerState() {
                if (this.foreignIsOffer)
                    return {'text-danger': this.foreign.offer.ended, 'text-warning': !this.foreign.offer.started,
                        'text-success': this.foreign.offer.started && !this.foreign.offer.ended};

                return {'text-muted': true}
            }
        },
        methods: {
            humanize(datetime) {
                return Moment(datetime).format("dddd, MMMM Do YYYY");
            }
        }
    }
</script>

<style scoped>
    span.time {
        text-transform: lowercase !important;
    }

    .photos {
        list-style: outside none none;
        margin-bottom: 0;
        padding-left: 0;
    }

    .photos > li {
        display: inline-block;
        min-width: 32.3%;
        width: 32.3%;
        margin: 0 1.3px;
    }

    .photos > li:hover a img {
        transform: scale(1.01);
    }

    .photos > li a {
        display: inline-block;
        overflow: hidden;
        width: 100%;
    }

    .photos > li a img {
        width: 100%;
    }

    .post-meta {
        float: left;
        margin-top: 15px;
        width: 100%;
    }

    .post-meta > img {
        float: left;
        width: 100%;
    }

    .description {
        float: left;
        margin-top: 12px;
        width: 100%;
    }

    .description > p {
        margin-bottom: 20px;
    }

    .description > span {
        color: #2a2a2a;
        font-size: 18px;
        font-weight: 600;
        line-height: 28px;
        display: inline-block;
        margin-bottom: 5px;
    }

    .description > p a {
        font-weight: 600;
    }

    .linked-image {
        display: inline-block;
        width: 20%;
        vertical-align: top;
        float: none;
        margin-bottom: 15px;
    }

    .align-left {
        float: left;
        margin-right: 20px;
    }

    .post-meta .detail {
        display: inline-block;
        width: 78%;
    }

    .post-meta .detail > a > span {
        font-size: 24px;
        font-weight: 300;
    }

    .post-meta .detail > a {
        font-size: 12px;
        letter-spacing: 1px;
    }

    .post-meta .detail > a:hover {
        color: red;
    }

    .align-right {
        float: right;
        margin-left: 20px;
    }

    .post-meta .linked-image.align-left a img {

        height: auto;
        max-width: 100%;

    }

</style>