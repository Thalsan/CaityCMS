<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{!! url('/') !!}">Home <span class="sr-only">(current)</span></a></li>
        <li class="{{ Request::is('products*') ? 'active' : '' }}"><a href="{!! url('/products') !!}">Products</a></li>
    </ul>
</div>