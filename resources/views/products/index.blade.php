@extends('master')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Products</div>
        <div class="panel-body">
            <ul class="list-group">
            @foreach ($products as $product)
                <li class="list-group-item">
                    {{ $product->name }}
                </li>
            @endforeach
            </ul>
            {!! $products->render() !!}
        </div>
    </div>
@endsection