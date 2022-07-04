<nav class="sb-topnav navbar navbar-expand" style="background-color:#F6FAFD;">
    <a class="navbar-brand text-primary" href="{{ route('dashboard', ['state' => 'dashboard']) }}">

            <img src="{{ asset('assets/logo.png') }}" style="width: 150px;">

    </a>
    <button class="btn btn-dark btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars text-warning"></i></button>
    <!-- Navbar-->
    <span class="d-none d-lg-inline-flex ms-3"><span class="fw-bold">WelCome...!</span>&nbsp;{{ ucwords(session()->get('auth_employee')->name) }}</span>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('dashboard', ['state' => 'my_account']) }}">
                <i class="fas fa-id-card-alt"></i>&nbsp;<span class="d-none d-lg-inline-flex">My Account&nbsp;</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('logout') }}">
                <i class="fa fa-power-off" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
</nav>
