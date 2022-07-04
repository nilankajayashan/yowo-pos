<!doctype html>
<html lang="en">
@include('components.header')
<body class="sb-nav-fixed">
@include('components.top-nav')
<div id="layoutSidenav">
    @include('components.side-nav')
    <div id="layoutSidenav_content">
        <main>
            @if(isset($state))
                @switch($state)
                    @case('dashboard')
                        @include('pages.dashboard')
                        @break
                    @case('categories')
                    @include('pages.categories')
                    @break
                    @case('products')
                    @include('pages.products')
                    @break
                    @case('stocks')
                    @include('pages.stocks')
                    @break
                    @case('sell')
                    @include('pages.sells')
                    @break
                    @case('add_bill')
                    @include('pages.add_bill')
                    @break
                    @case('customers')
                    @include('pages.customers')
                    @break
                    @case('web')
                    @include('pages.web')
                    @break
                    @case('cart')
                    @include('pages.cart')
                    @break
                    @case('edit-cart')
                    @include('pages.edit-cart')
                    @break
                    @case('orders')
                    @include('pages.orders')
                    @break
                    @case('employees')
                    @include('pages.employees')
                    @break
                    @case('my_account')
                    @include('pages.my_account')
                    @break
                @endswitch
            @else
                <h1>404 Error</h1>
            @endif
        </main>
        @include('template.message')
{{--        @include('../Components/footer')--}}
    </div>
</div>
</body>
<script src="{{ asset('js/scripts.js')}}" type="text/javascript"></script>
</html>


