@extends('shoppie::shop.product.basic.base')
@section('home-active', 'active')
@section('product')
    <div class="card card-small mb-4 pt-3 border">
        <ul class="list-group list-group-flush">
            <li class="list-group-item p-4">
                <strong class="text-muted d-block mb-2">Description</strong>
                <span>{{ $product->description }}</span>
            </li>
            <li class="list-group-item py-4 px-2">
                <strong class="text-muted d-block mb-2 px-3">Arributes</strong>
                <span>
                    <table class="table table-bordered m-0">
                        <tbody>
                        @foreach($product->settings('attributes') as $attribute)
                            <tr>
                                <td>{{ $attribute["name"] }}</td>
                                <td>{{ $attribute["value"] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </span>
            </li>
        </ul>
    </div>
@endsection
