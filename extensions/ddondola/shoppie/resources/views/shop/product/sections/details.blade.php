<div class="card card-small mb-4 pt-3 border">
    <ul class="list-group list-group-flush">
        <li class="list-group-item p-4">
            <strong class="text-muted d-block mb-2"><i class="material-icons">local_mall</i> Name</strong>
            <span>{{ $product->name }}</span>
        </li>
        <li class="list-group-item p-4">
            <strong class="text-muted d-block mb-2"><i class="material-icons">monetization_on</i> Price</strong>
            <span>
                <var class="price h3 text-warning">
                    <span class="currency">{{ $product->currencyCode() }}</span> <span class="num">{{ number_format($product->discountedPrice()) }}</span>
                    @if($product->discount())
                        <span style="text-decoration: line-through">
                            <span class="currency text-muted">{{ $product->currencyCode() }}</span> <span class="num text-muted">{{ number_format($product->price) }}</span>
                        </span>
                    @endif
                </var>
            </span>
        </li>
        <li class="list-group-item p-4">
            <strong class="text-muted d-block mb-2"><i class="material-icons">description</i> Description</strong>
            <span>{{ $product->description }}</span>
        </li>
        <li class="list-group-item p-4">
            <strong class="text-muted d-block mb-2"><i class="material-icons">work</i> Brand</strong>
            <span>{{ $product->brand->name }}</span>
        </li>
        <li class="list-group-item p-4">
            <strong class="text-muted d-block mb-2"><i class="material-icons">folder</i> Category</strong>
            <span>{{ $product->category()->name }}</span>
        </li>
        <li class="list-group-item p-4">
            <strong class="text-muted d-block mb-2"><i class="material-icons">folder_open</i> Subcategory</strong>
            <span>{{ $product->subcategory->name }}</span>
        </li>
        <li class="list-group-item pt-4 pb-0 px-0">
            <strong class="text-muted d-block mb-2 px-4"><i class="material-icons">tag</i> Attributes</strong>
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