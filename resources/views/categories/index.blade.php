@extends('master')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Categories</div>
        <div class="panel-body">
            @include('categories.breadcrumbs')
            <ul class="list-group">
            @foreach ($categories as $category)
                <li class="list-group-item">
                    <a href="{!! url('/categories/index/' . $category->id) !!}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
            </ul>
            {!! $categories->render() !!}
        </div>
    </div>
@endsection