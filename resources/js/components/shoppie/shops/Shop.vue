<template>
    <div class="strip grid border">
        <figure>
            <a href="detail-restaurant.html" class="picture">
                <img src="/images/shops/location_1.jpg" class="img-fluid" alt="">
                <div class="read_more">
                    <span>Open</span>
                </div>
            </a>
            <small>Restaurant</small>
        </figure>
        <div class="wrapper">
            <h3><a href="detail-restaurant.html">Da Alfredo</a></h3>
            <small>27 Old Gloucester St</small>
            <p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu.</p>
            <!--<a class="address" href="https://www.google.com/maps/dir//Assistance+–+Hôpitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x47e66e1de36f4147:0xb6615b4092e0351f!2sAssistance+Publique+-+Hôpitaux+de+Paris+(AP-HP)+-+Siège!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361">Get directions</a>-->
        </div>
        <ul class="m-0 p-3">
            <li><span class="loc_open">Now Open</span></li>
            <li>
                <div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "GridShop"
    }
</script>

<style scoped>
    .wrapper {
        background-color: #fff;
    }
</style>