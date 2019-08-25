<template>
    <div class="deals_item">
        <div class="deals_image">
            <img :src="deal.images[0].url" alt="">
        </div>
        <div class="deals_content">
            <div class="text-center">
                <span class="text-muted d-block">{{ deal.subcategory.name }}</span>
                <a :href="`/products/${deal.code}`"><h4 class="mb-2 text-ellipsis">{{ deal.name }}</h4></a>
            </div>
            <div class="text-center">
                <ul class="price list-inline no-margin">
                    <li class="list-inline-item deals_item_price_a text-primary">{{ deal.currencyCode }} {{ deal.discountedPrice|commas }}</li>
                    <li class="list-inline-item deals_item_price_a" style="text-decoration: line-through;">{{ deal.currencyCode }} {{ deal.price|commas }}</li>
                </ul>
            </div>
            <div class="available">
                <div class="available_line d-flex flex-row justify-content-start">
                    <div class="available_title">Available: <span>6</span></div>
                    <div class="sold_title ml-auto">Already sold: <span>28</span></div>
                </div>
                <div class="progress progress-sm mb-3 bg-light border">
                    <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 17%;"></div>
                </div>
            </div>
            <div class="deals_timer_title_container text-center">
                <div class="deals_timer_title">Hurry Up</div>
                <div class="deals_timer_subtitle">Offer ends in</div>
            </div>
            <div class="deals_timer d-flex flex-row justify-content-center mt-2">
                <div class="deals_timer_content">
                    <div class="deals_timer_box clearfix">
                        <div class="deals_timer_unit border-right">
                            <div id="deals_timer1_hr" class="deals_timer_hr">{{ hours }}</div>
                        </div>
                        <div class="deals_timer_unit border-right">
                            <div id="deals_timer1_min" class="deals_timer_min">{{ minutes }}</div>
                        </div>
                        <div class="deals_timer_unit">
                            <div id="deals_timer1_sec" class="deals_timer_sec">{{ seconds }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Deal",
        mounted() {
            this.initTimer();
        },
        data() {
            return {
                days: null,
                hours: null,
                minutes: null,
                seconds: null
            }
        },
        props: {
            deal: {
                type: Object,
                required: true
            }
        },
        computed: {
            target_date() {
                return Moment(this.offer.end_date).valueOf();
            },
            offer() {
                return this.deal.offers.data[0];
            },
            showDeal() {
                return (this.target_date - (new Date().getTime())) / 1000 > 0;
            }
        },
        methods: {
            initTimer() {
                if($('.deals_timer_box').length)
                {
                    setInterval(this.countDown, 1000);
                }
            },
            countDown() {
                // find the amount of "seconds" between now and target
                var current_date = new Date().getTime();
                var seconds_left = (this.target_date - current_date) / 1000;

                // do some time calculations
                this.days = parseInt(seconds_left / 86400);
                seconds_left = seconds_left % 86400;

                this.hours = parseInt(seconds_left / 3600);
                this.hours = this.hours + this.days * 24;
                seconds_left = seconds_left % 3600;


                this.minutes = parseInt(seconds_left / 60);
                this.seconds = parseInt(seconds_left % 60);

                if(this.hours.toString().length < 2)
                {
                    this.hours = "0" + this.hours;
                }
                if(this.minutes.toString().length < 2)
                {
                    this.minutes = "0" + this.minutes;
                }
                if(this.seconds.toString().length < 2)
                {
                    this.seconds = "0" + this.seconds;
                }
            }
        }
    }
</script>

<style scoped>

</style>