<div class="m-0">
    <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px;">
        <div class="row">
            @if(in_array( 'add-customer', json_decode($permissions)))
                {{--            add user modal--}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('add-user') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Customer Name" required="required">
                                        @error('name')
                                        <div class="bg-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" required="required">
                                        @error('email')
                                        <div class="bg-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="Contact Number">
                                        @error('mobile')
                                        <div class="bg-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required="required">
                                        @error('password')
                                        <div class="bg-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-warning col-12" value="Add Customer">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{--            end add user modal--}}
            @endif
            <h3 class="text-warning col-lg-10">Customers</h3>
            @if(in_array( 'add-customer', json_decode($permissions)))
                <div class="col-lg-2  pt-2">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Customers</button>
                </div>
            @endif
        </div>
    </div>
    <div class="ps-3 pe-3 table-responsive">
        @if(isset($users) || in_array( 'view-customer', json_decode($permissions)))
            <table class="table mt-3">
                <thead>
                <tr>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile number</th>
                    <th scope="col">Since</th>
                    @if(in_array( 'edit-customer', json_decode($permissions)) || in_array( 'delete-customer', json_decode($permissions)))
                        <th scope="col">Actions</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $user->user_id }}</th>
                            <td>{{ ucwords($user->name) }}</td>
                            <td>{{ ucwords($user->email) }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ date_format($user->created_at, 'd-m-Y') }}</td>
                            @if(in_array( 'edit-customer', json_decode($permissions)) || in_array( 'delete-customer', json_decode($permissions)))
                                <td>
                                    @if(in_array( 'edit-customer', json_decode($permissions)))
                                    <button class="btn bg-white border-0 d-inline-flex" data-bs-toggle="modal" data-bs-target="#editUser-{{ $user->user_id }}"><i class="fas fa-edit text-primary"></i>&nbsp;Edit</button>
                                    @endif
                                    @if(in_array( 'delete-customer', json_decode($permissions)))
                                        <form action="{{ route('delete-user') }}" method="post" class="d-inline-flex">
                                            <span class="d-inline-flex">|</span>
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                            <button type="submit" class="bg-white border-0">
                                                <i class="fas fa-trash-alt text-danger"></i>&nbsp;Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            @endif
                        </tr>
                        @if(in_array( 'edit-customer', json_decode($permissions)))
                            {{--            edit user modal--}}
                            <div class="modal fade" id="editUser-{{ $user->user_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit customer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('edit-user') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="email" value="{{ $user->email }}">
                                                <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Category Name" required="required" value="{{ $user->name }}">
                                                    @error('name')
                                                    <div class="bg-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <input type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="Contact Number"  value="{{ $user->mobile }}">
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
                                                <div class="mb-3">
                                                    <input type="submit" class="btn btn-warning col-12" value="Update Customer">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--            end edit customer modal--}}
                        @endif
                    @endforeach
                </td>
                </tbody>
            </table>
        @else
            <h6 class="d-inline-flex mt-3 ms-3 ">Something went wrong...! Please refresh page now&nbsp;</h6>
            <a class="btn btn-warning d-inline-flex mt-0 mt-lg-3 ms-3 ms-lg-0" href="{{ route('dashboard', ['state' => 'customers']) }}">Refresh</a>
        @endif
    </div>
</div>
