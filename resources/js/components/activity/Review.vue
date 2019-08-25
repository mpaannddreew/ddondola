<template>
    <div class="central-meta item">
        <div class="user-post">
            <div class="friend-info">
                <figure>
                    <img alt="" :src="review.reviewer.avatar.url" class="img-fluid rounded-circle">
                </figure>
                <div class="friend-name">
                    <ins>
                        <a :href="'/people/' + review.reviewer.code" class="name ">{{ review.reviewer.name }}</a>
                    </ins>
                    <span>
                        <span class="text-warning" v-html="starHtml"></span> – <span class="time">{{ review.created_at|fromNow|lowerCase }}</span>
                    </span>
                </div>
                <div class="description mt-2">
                    <p class="m-0">
                        {{ review.body }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Review",
        props: {
            review: {
                type: Object,
                required: true
            }
        },
        computed: {
            starHtml() {
                var stars = "";
                var difference = 5 - this.review.rating;
                for (var i = 1; i <= this.review.rating; i++) {
                    stars += '<i class="fa fa-star"></i>';
                    if (i === this.review.rating && difference > 0) {
                        for (var j = 1; j <= difference; j++) {
                            stars += '<i class="fa fa-star-o"></i>';
                        }
                    }
                }

                return stars;
            }
        }
    }
</script>

<style scoped>
    span.time {
        text-transform: lowercase !important;
    }
</style>