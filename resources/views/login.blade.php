<!doctype html>
<html lang="en">
@include('components.header')
<body>
<div class="container-fluid bg-dark p-3" style="min-height:150px;">
    <div class="row">
        <h3 class="text-warning text-left col-lg-5" style="margin-left:50px">Login</h3>
        @if(isset($no_employees))
            @if($no_employees == 1)
             <a class="btn btn-outline-warning col-lg-2" href="{{ route('admin-register') }}">MAKE ADMINISTRATOR USER</a>

            @endif
        @endif
    </div>
</div>
<div class="card container " style="top:-60px;" >
    <div class="row">
        <div class="col-lg-5 p-3">
            <h3><i class="fas fa-sign-in-alt"></i>&nbsp;Login</h3>
            <form class="ms-3" method="post" action="{{ route('login-submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required="required" placeholder="Email Address">
                    @error('email')
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
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Check me out</label>
                </div>
                <button type="submit" class="btn btn-warning col-12">Login</button>
            </form>
        </div>
        <div class="col-lg-7">
            <img src="{{ asset('assets/login.svg') }}" alt=""  class="col-12 ps-5 pe-5 pt-3 pb-3">
        </div>
    </div>
</div>
<script>
    checkUser();
    function checkUser() {
        let email = getCookie("email");
        let password = getCookie("password");
        if (email != "" && password != "") {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        }
    }
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
</script>
@include('template.message')
</body>
</html>
