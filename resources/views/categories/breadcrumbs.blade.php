<ol class="breadcrumb">
    <li><a href="{!! url('/categories') !!}">Home</a></li>
    @foreach ($breadcrumbs as $crumb)
        <li><a href="{!! url('/categories/index/' . $crumb['id']) !!}">{{ $crumb['name'] }}</a></li>
    @endforeach
</ol>