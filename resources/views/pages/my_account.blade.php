<div class="m-0">
    <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px;">
        <div class="row">
            <h3 class="text-warning col-8">My Account</h3>
        </div>
    </div>
    <div class="row position-relative text-center m-0" style="margin-top: -40px !important;">
        <div class="col-lg-3 m-0">
            <div class="card ms-5 me-5 p-0 rounded-circle overflow-hidden">
                <img src="@if($my_details->profile != null){{ asset('employee_profile/'.$my_details->employee_id.'/'.json_decode($my_details->profile)) }} @else {{ asset('employee_profile/common/profile.png') }} @endif" alt="">
{{--            <img class="w-100 p-0 " src="@if($my_details->profile != null){{ asset('employee_profile/'.$my_details->employee_id.'/'.json_decode($my_details->profile)) }} @else {{ asset('employee_profile/common/profile.png') }} @endif" alt="">--}}
            </div>
            <div class=" position-relative" style="width: 20px; height: 20px; margin-top: -80px !important; margin-left: 200px !important;">
                <button type="button" class="btn btn-dark rounded-circle" data-bs-toggle="modal" data-bs-target="#profile">
                    <i class="fas fa-camera-retro"></i>
                </button>
            </div>
            <div class="modal fade" id="profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h6>Profile Image</h6>
                            <form action="{{ route('upload-employee-profile') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="profile" class="form-control mb-3">
                                <input type="submit" value="Upload Profile Image" class="btn btn-warning col-12">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 m-lg-0 mt-5">
            <div class="card">
                <div class="card-body">
                    <h5>@if($my_details->name != null) {{ 'WelCome...! '.ucwords($my_details->name) }} @else Hello Employee @endif</h5>
                    <div class="mb-3">
                        <span class="fs-5 float-start mb-2">Email: {{ $my_details->email }}</span>
                    </div>
                    <form action="{{ route('update-employee-account') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Your Name" required="required" value="{{ $my_details->name }}">
                            @error('name')
                            <div class="bg-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="Contact Number"  value="{{ $my_details->mobile }}">
                            @error('mobile')
                            <div class="bg-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                            @error('password')
                            <div class="bg-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-warning col-12">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
