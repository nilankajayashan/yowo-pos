<!doctype html>
<html lang="en">
@include('components.header')
<body>
<div class="container-fluid bg-dark p-3" style="min-height:150px;">
    <div class="row">
        <h3 class="text-warning text-left col-lg-5" style="margin-left:50px">Register</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="col-lg-6 m-0 p-0 ">
            <ol class="breadcrumb text-warning bg-transparent p-0 m-0" style="float: right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard', ['state' => 'dashboard']) }}" class="text-decoration-none text-warning">Home</a></li>
                <li class="breadcrumb-item  active text-warning" aria-current="page">Register</li>
            </ol>
        </nav>
    </div>
</div>
<div class="card container " style="top:-60px;" >
    <div class="row">
        <div class="col-lg-7">
            <img src="{{ asset('assets/register.svg') }}" alt=""  class="col-12 float-end p-3">
        </div>
        <div class="col-lg-5 p-3">
            <h3><i class="fas fa-user-shield"></i>&nbsp;Register - Shop Owner</h3>
            <form class="ms-3" method="post" action="{{ route('admin-register-submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required="required" placeholder="Name">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" required="required" placeholder="Email Address">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input type="tel" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Mobil Number">
                    @error('mobile')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" minlength="8" maxlength="32" required="required" placeholder="Password">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning col-12">Register</button>
            </form>
        </div>
    </div>
</div>
@include('template.message')
</body>
</html>
