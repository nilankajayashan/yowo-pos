<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion" id="sidenavAccordion" style="background-color:#F6FAFD;">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading pb-1">Main</div>
                @if(in_array( 'dashboard', json_decode($permissions)))
                    <a class="nav-link ps-0  @if(isset($state) && $state == 'dashboard') bg-dark text-light  @else text-dark @endif" href="{{ route('dashboard', ['state' => 'dashboard']) }}">
                        <div class="sb-nav-link-icon ps-2  rounded-nav @if(isset($state) && $state == 'dashboard')bg-warning text-dark @else bg-dark text-warning  @endif"><i class="fas fa-tachometer-alt p-2" aria-hidden="true"></i></div>
                        Dashboard
                    </a>
                @endif

                    @if(in_array( 'view-category', json_decode($permissions)))
                        <a class="nav-link ps-0  @if(isset($state) && $state == 'categories') bg-dark text-light  @else text-dark @endif" href="{{ route('dashboard', ['state' => 'categories']) }}">
                            <div class="sb-nav-link-icon ps-2  rounded-nav @if(isset($state) && $state == 'categories')bg-warning text-dark @else bg-dark text-warning  @endif"><i class="fas fa-stream p-2" aria-hidden="true"></i></div>
                            Categories
                        </a>
                    @endif
                    @if(in_array( 'view-product', json_decode($permissions)))
                        <a class="nav-link ps-0  @if(isset($state) && $state == 'products') bg-dark text-light  @else text-dark @endif" href="{{ route('dashboard', ['state' => 'products']) }}">
                            <div class="sb-nav-link-icon ps-2  rounded-nav @if(isset($state) && $state == 'products')bg-warning text-dark @else bg-dark text-warning  @endif"><i class="fas fa-shopping-bag p-2" aria-hidden="true"></i></div>
                            Products
                        </a>
                        <a class="nav-link ps-0  @if(isset($state) && $state == 'stocks') bg-dark text-light  @else text-dark @endif" href="{{ route('dashboard', ['state' => 'stocks']) }}">
                            <div class="sb-nav-link-icon ps-2  rounded-nav @if(isset($state) && $state == 'stocks')bg-warning text-dark @else bg-dark text-warning  @endif"><i class="fas fa-cubes p-2" aria-hidden="true"></i></div>
                            Stocks
                        </a>
                    @endif
                @if(in_array( 'view-sell', json_decode($permissions)))
                <a class="nav-link ps-0  @if(isset($state) && ($state == 'sell' || $state == 'add_bill')) bg-dark text-light  @else text-dark @endif" href="{{ route('dashboard', ['state' => 'sell']) }}">
                    <div class="sb-nav-link-icon ps-2 rounded-nav @if(isset($state) && ($state == 'sell' || $state == 'add_bill'))bg-warning text-dark @else bg-dark text-warning  @endif"><i class="fas fa-cash-register p-2"></i></div>
                    Sell
                </a>
                @endif
                @if(in_array( 'view-customer', json_decode($permissions)))
                <a class="nav-link ps-0  @if(isset($state) && $state == 'customers') bg-dark text-light  @else text-dark @endif" href="{{ route('dashboard', ['state' => 'customers']) }}">
                    <div class="sb-nav-link-icon ps-2  rounded-nav @if(isset($state) && $state == 'customers')bg-warning text-dark @else bg-dark text-warning  @endif"><i class="fa fa-users p-2" aria-hidden="true"></i></div>
                    Customers
                </a>
                @endif
                @if(in_array( 'site-setting', json_decode($permissions)) || in_array( 'view-order', json_decode($permissions)))
                <div class="sb-sidenav-menu-heading pt-1 pb-1">WEB</div>
                @endif
                @if(in_array( 'site-setting', json_decode($permissions)))
                    <a class="nav-link ps-0  @if(isset($state) && $state == 'web') bg-dark text-light  @else text-dark @endif" href="{{ route('dashboard', ['state' => 'web']) }}">
                    <div class="sb-nav-link-icon ps-2  rounded-nav @if(isset($state) && $state == 'web')bg-warning text-dark @else bg-dark text-warning  @endif"><i class="fa fa-globe p-2" aria-hidden="true"></i></div>
                    Site Settings
                    </a>
                @endif
                @if(in_array( 'view-cart', json_decode($permissions)))
                    <a class="nav-link ps-0  @if(isset($state) && ($state == 'cart' ||  \Route::currentRouteName() == 'edit-cart-view')) bg-dark text-light  @else text-dark @endif" href="{{ route('dashboard', ['state' => 'cart']) }}">
                        <div class="sb-nav-link-icon ps-2  rounded-nav @if(isset($state) && ($state == 'cart' ||  \Route::currentRouteName() == 'edit-cart-view'))bg-warning text-dark @else bg-dark text-warning  @endif"><i class="fa fa-shopping-cart p-2" aria-hidden="true"></i></div>
                        Carts
                    </a>
                @endif
                @if(in_array( 'view-order', json_decode($permissions)))
                <a class="nav-link ps-0  @if(isset($state) && $state == 'orders') bg-dark text-light  @else text-dark @endif" href="{{ route('dashboard', ['state' => 'orders']) }}">
                    <div class="sb-nav-link-icon ps-2  rounded-nav @if(isset($state) && $state == 'orders')bg-warning text-dark @else bg-dark text-warning  @endif"><i class="fas fa-luggage-cart p-2"></i></div>
                    Orders
                </a>
                @endif
                @if(in_array( 'view-employee', json_decode($permissions)))
                <div class="sb-sidenav-menu-heading pt-1 pb-1">Employee</div>
                <a class="nav-link ps-0  @if(isset($state) && $state == 'employees') bg-dark text-light  @else text-dark @endif" href="{{ route('dashboard', ['state' => 'employees']) }}">
                    <div class="sb-nav-link-icon ps-2  rounded-nav @if(isset($state) && $state == 'employees')bg-warning text-dark @else bg-dark text-warning  @endif"><i class="fa fa-male p-2" aria-hidden="true"></i></div>
                    Employees
                </a>
                @endif
            </div>
        </div>
    </nav>
</div>
