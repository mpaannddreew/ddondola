<div class="container py-2">
    <div class="row">
        <div class="col-md-3 px-1">

        </div>
        <div class="col-md-6 px-1">
            <reviews :reviewable="{{ $shop }}" reviewable-type="shop"></reviews>
        </div>
        <div class="col-md-3 px-1">
            <rating-meter :reviewable="{{ $shop }}"></rating-meter>
        </div>
    </div>
</div>