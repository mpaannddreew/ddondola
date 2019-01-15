<template>
    <div class="product-item">
        <div class="carousel-thumb">
            <img class="img-fluid" src="/images/product/img1.jpg" alt="">
            <div class="overlay">
                <div>
                    <a class="btn btn-common" href="ads-details.html">View Details</a>
                </div>
            </div>
            <span class="price">$99.00</span>
        </div>
        <div class="product-content">
            <h3 class="product-title"><a href="ads-details.html">Baby Toy</a></h3>
            <span>Sports / Baby Toys</span>
            <div class="icon">
                <span><i class="fa fa-heart"></i></span>
                <span><i class="fa fa-cart-plus"></i></span>
            </div>
            <div class="card-text">
                <div class="float-left">
                    <span class="icon-wrap">
                      <i class="fa fa-comments"></i>
                    </span>
                    <span class="count-review">
                          (12 Comments)
                    </span>
                </div>
                <!--<div class="float-right">-->
                    <!--<a class="address" href="#"><i class="fa fa-map-marker"></i> New York</a>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Product"
    }
</script>

<style scoped>

</style>