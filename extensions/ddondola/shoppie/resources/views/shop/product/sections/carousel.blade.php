<section class="py-2">
    <!-- Categories Carousel -->
    <div class="fullwidth-carousel-container margin-top-25">
        <div class="fullwidth-slick-carousel category-carousel">
            <!-- Item -->
            @foreach($product->productImages() as $image)
                <product-carousel-image :image="{{ json_encode($image) }}" ></product-carousel-image>
            @endforeach
            <!-- Item / End -->
        </div>
    </div>
    <!-- Categories Carousel / End -->
</section>