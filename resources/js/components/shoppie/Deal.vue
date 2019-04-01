<template>
    <div class="owl-item deals_item">
        <div class="deals_image">
            <img src="/images/products/hoodie-man-1.png" alt="">
        </div>
        <div class="deals_content">
            <div class="deals_info_line d-flex flex-row justify-content-start">
                <div class="deals_item_category"><a href="#">Headphones</a></div>
                <div class="deals_item_price_a ml-auto">$300</div>
            </div>
            <div class="deals_info_line d-flex flex-row justify-content-start">
                <div class="deals_item_name">Beoplay H7</div>
                <div class="deals_item_price ml-auto">$225</div>
            </div>
            <div class="available">
                <div class="available_line d-flex flex-row justify-content-start">
                    <div class="available_title">Available: <span>6</span></div>
                    <div class="sold_title ml-auto">Already sold: <span>28</span></div>
                </div>
                <div class="available_bar"><span style="width:17%"></span></div>
            </div>
            <div class="deals_timer d-flex flex-row justify-content-start">
                <div class="deals_timer_title_container">
                    <div class="deals_timer_title">Hurry Up</div>
                    <div class="deals_timer_subtitle">Offer ends in:</div>
                </div>
                <div class="deals_timer_content ml-auto">
                    <div class="deals_timer_box clearfix" data-target-time="">
                        <div class="deals_timer_unit">
                            <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                            <span>hours</span>
                        </div>
                        <div class="deals_timer_unit">
                            <div id="deals_timer1_min" class="deals_timer_min"></div>
                            <span>mins</span>
                        </div>
                        <div class="deals_timer_unit">
                            <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                            <span>secs</span>
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

            }
        },
        methods: {
            initTimer() {
                if($('.deals_timer_box').length)
                {
                    var timer = $('.deals_timer_box');

                    var targetTime;
                    var target_date;

                    // Add a date to data-target-time of the .deals_timer_box
                    // Format: "Feb 17, 2018"
                    if(timer.data('target-time') !== "")
                    {
                        targetTime = timer.data('target-time');
                        target_date = new Date(targetTime).getTime();
                    }
                    else
                    {
                        var date = new Date();
                        date.setDate(date.getDate() + 2);
                        target_date = date.getTime();
                    }

                    // variables for time units
                    var days, hours, minutes, seconds;

                    var h = timer.find('.deals_timer_hr');
                    var m = timer.find('.deals_timer_min');
                    var s = timer.find('.deals_timer_sec');

                    setInterval(function ()
                    {
                        // find the amount of "seconds" between now and target
                        var current_date = new Date().getTime();
                        var seconds_left = (target_date - current_date) / 1000;
                        console.log(seconds_left);

                        // do some time calculations
                        days = parseInt(seconds_left / 86400);
                        seconds_left = seconds_left % 86400;

                        hours = parseInt(seconds_left / 3600);
                        hours = hours + days * 24;
                        seconds_left = seconds_left % 3600;


                        minutes = parseInt(seconds_left / 60);
                        seconds = parseInt(seconds_left % 60);

                        if(hours.toString().length < 2)
                        {
                            hours = "0" + hours;
                        }
                        if(minutes.toString().length < 2)
                        {
                            minutes = "0" + minutes;
                        }
                        if(seconds.toString().length < 2)
                        {
                            seconds = "0" + seconds;
                        }

                        // display results
                        h.text(hours);
                        m.text(minutes);
                        s.text(seconds);

                    }, 1000);
                }
            }
        }
    }
</script>

<style scoped>

</style>