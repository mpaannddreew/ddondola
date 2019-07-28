<div class="card card-small mb-4 pt-3 border">
    <ul class="list-group list-group-flush">
        <li class="list-group-item p-4">
            <strong class="text-muted d-block mb-2">Description</strong>
            <span>{{ $product->description }}</span>
        </li>
        <li class="list-group-item pt-4 pb-0 px-0">
            <strong class="text-muted d-block mb-2 px-4">Attributes</strong>
            <span>
                <table class="table table-striped m-0">
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