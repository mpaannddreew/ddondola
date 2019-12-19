<div class="card card-small mb-4 pt-3 border">
    <ul class="list-group list-group-flush">
        <li class="list-group-item p-4">
            <strong class="text-muted d-block mb-2 d-flex">
                {{ $product->name }}
                <mini-rating-meter :reviewable="{{ $product }}" :show-base="false" class="ml-auto"></mini-rating-meter>
            </strong>
        </li>
        <li class="list-group-item p-4 d-flex">
            <strong class="text-muted d-block">Price</strong>
            <span class="ml-auto">
                <var class="price h5 text-primary">
                    <span class="currency">{{ $product->currencyCode() }}</span> <span class="num">{{ number_format($product->discountedPrice()) }}</span>
                    @if($product->discount())
                        <span style="text-decoration: line-through" class="text-muted">
                            <span class="currency text-muted">{{ $product->currencyCode() }}</span> <span class="num text-muted">{{ number_format($product->price) }}</span>
                        </span>
                    @endif
                </var>
            </span>
        </li>
        <li class="list-group-item p-4">
            <strong class="text-muted d-block">Description</strong>
            <span>{{ $product->description }}</span>
        </li>
        @if($product->brand)
        <li class="list-group-item p-4 d-flex">
            <strong class="text-muted d-block">Brand</strong>
            <span class="ml-auto">{{ $product->brand->name }}</span>
        </li>
        @endif
        <li class="list-group-item p-4 d-flex">
            <strong class="text-muted d-block">Category</strong>
            <span class="ml-auto">{{ $product->category()->name }}</span>
        </li>
        <li class="list-group-item p-4 d-flex">
            <strong class="text-muted d-block">Subcategory</strong>
            <span class="ml-auto">{{ $product->subcategory->name }}</span>
        </li>
        <li class="list-group-item pt-4 pb-0 px-0">
            <strong class="text-muted d-block px-4"><i class="material-icons">tag</i> Attributes</strong>
            <span>
                <table class="table m-0">
                    <tbody>
                    @foreach($product->settings('attributes') as $attribute)
                        <tr>
                            <th class="text-muted px-4">{{ $attribute["name"] }}</th>
                            <td>{{ $attribute["value"] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </span>
        </li>
    </ul>
</div>