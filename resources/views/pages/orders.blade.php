<div class="m-0">
    <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px;">
        <div class="row">
            <h3 class="text-warning col-lg-10">Orders</h3>
            <div class="col-lg-2  pt-2">
                <button class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#addOrderModal">Add Order</button>
            </div>
            @if(in_array( 'add-order', json_decode($permissions)))
                {{--            add cart modal--}}
                <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add web order</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-2 me-2 ms-2">
                                <form action="{{ route('add-order') }}" method="post">
                                    @csrf
                                    <h6>Customer</h6>
                                    <div class="mb-3">
                                        <select class="form-select form-control @error('user_id') is-invalid @enderror" aria-label="Default select example" name="user_id" id="user_id" required>
                                            <option selected disabled>Customer</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->user_id }}">{{ $user->user_id .' | '. $user->name .' | '. $user->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('shipping_country')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <h6>Shipping Details</h6>
                                        <div class="mb-3 col-lg-6">
                                            <input type="text" class="form-control form-control @error('shipping_name') is-invalid @enderror" placeholder="Full Name" name="shipping_name" >
                                            @error('shipping_name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-6">
                                            <input type="email" class="form-control form-control @error('shipping_email') is-invalid @enderror" placeholder="Email" name="shipping_email">
                                            @error('shipping_email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-6">
                                            <input type="tel" class="form-control form-control @error('shipping_mobile') is-invalid @enderror" placeholder="Contact Number" name="shipping_mobile">
                                            @error('shipping_mobile')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-6">
                                            <select class="form-select form-control @error('shipping_country') is-invalid @enderror" aria-label="Default select example" name="shipping_country" id="country" required>
                                                <option selected disabled>Country</option>
                                                <option value="sri lanka">Sri Lanka</option>
                                            </select>
                                            @error('shipping_country')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-6">
                                            <select class="form-select form-control  @error('shipping_district') is-invalid @enderror" aria-label="Default select example" name="shipping_district" id="district" required>
                                                <option selected disabled>District</option>
                                                <option value="hambantota">Hambantota</option>
                                            </select>
                                            @error('shipping_district')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-6">
                                            <select class="form-select form-control @error('shipping_city') is-invalid @enderror" aria-label="Default select example" name="shipping_city" id="city" required>
                                                <option selected disabled>City</option>
                                                <option value="beliatta">Beliatta</option>
                                            </select>
                                            @error('shipping_city')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-6">
                                            <input type="text" class="form-control form-control @error('shipping_postal_code') is-invalid @enderror" placeholder="Zip | Postal Code" name="shipping_postal_code" id="postal_code">
                                            @error('shipping_postal_code')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-6">
                                            <input type="text" class="form-control form-control @error('shipping_address') is-invalid @enderror" placeholder="Address Line 1" name="shipping_address1">
                                            @error('shipping_address')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-6">
                                            <input type="text" class="form-control form-control" placeholder="Address Line 2" name="shipping_address2">
                                        </div>


                                        {{--                    billing form--}}
                                        <h6>Billing Details</h6>
                                        <div class="form-check form-switch ms-4 mb-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="address_same" data-bs-toggle="collapse" data-bs-target="#billing_form" aria-expanded="true" aria-controls="collapseWidthExample" name="payment_same">
                                            <label class="form-check-label" for="address_same">Billing Details Is Different</label>
                                        </div>
                                        <div class=" row collapse collapse-horizontal col-lg-12" id="billing_form">
                                            <div class="mb-3 col-lg-6">
                                                <input type="text" class="form-control form-control @error('payment_name') is-invalid @enderror" placeholder="Full Name" name="payment_name">
                                                @error('payment_name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-lg-6">
                                                <input type="email" class="form-control form-control @error('payment_email') is-invalid @enderror" placeholder="Email" name="payment_email">
                                                @error('payment_email')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-lg-6">
                                                <input type="tel" class="form-control form-control @error('payment_mobile') is-invalid @enderror" placeholder="Contact Number" name="payment_mobile">
                                                @error('payment_mobile')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-lg-6">
                                                <select class="form-select form-control @error('payment_country') is-invalid @enderror" aria-label="Default select example" name="payment_country" id="country" required>
                                                    <option selected disabled>Country</option>
                                                    <option value="sri lanka">Sri Lanka</option>
                                                </select>
                                                @error('payment_country')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-lg-6">
                                                <input type="text" class="form-control form-control @error('payment_city') is-invalid @enderror" placeholder="City" name="payment_city">
                                                @error('payment_city')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-lg-6">
                                                <input type="text" class="form-control form-control @error('payment_address') is-invalid @enderror" placeholder="Address" name="payment_address">
                                                @error('payment_address')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card col-lg-12 mt-lg-3" style="background-color: #F6FAFD;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-5 border border-1 border-start-0 border-top-0 border-bottom-0">

                                                    <div class="form-check form-switch ms-3">
                                                        <input class="form-check-input" type="radio" name="shipping_method" role="switch" id="free-shipping" value="free_shipping" checked="true">
                                                        <label class="form-check-label" for="free-shipping">Free Shipping</label>
                                                    </div>
                                                    <div class="form-check form-switch ms-3">
                                                        <input class="form-check-input" type="radio" name="shipping_method" role="switch" id="24-7-shipping" value="24_7_shipping">
                                                        <label class="form-check-label" for="24-7-shipping">24/7 Shipping</label>
                                                    </div>
                                                    <hr>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Delivery Note" style="height: 100px" name="shipping_note"></textarea>
                                                        <label for="floatingTextarea2">Delivery Note</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-check form-switch ms-3">
                                                        <input class="form-check-input" type="radio" name="payment_method" role="switch" id="cash-on-delivery" value="cod" checked="true">
                                                        <label class="form-check-label" for="cash-on-delivery">Cash On Delivery | COD</label>
                                                    </div>
                                                    <div class="form-check form-switch ms-3">
                                                        <input class="form-check-input" type="radio" name="payment_method" role="switch" id="payhere" value="payhere">
                                                        <label class="form-check-label" for="payhere">Payhere | Online</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-warning col-lg-12 mt-lg-3" value="Add Order" name="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{--            end add cart modal--}}
            @endif
        </div>
    </div>
    @if(isset($orders))
        <div class="ps-3 pe-3 table-responsive">
        <table class="table mt-3">
            <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Customer</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Order Status</th>
                <th scope="col">Total</th>
                <th scope="col">Ordered @</th>
                <th scope="col">Updated @</th>
                @if(in_array( 'manage-order', json_decode($permissions)) || in_array( 'edit-order', json_decode($permissions)) || in_array( 'delete-order', json_decode($permissions)))
                    <th scope="col">Actions</th>
                @endif
            </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->id }}</th>
                        <td>
                            @php $customer = 'Guest' @endphp
                            @foreach($users as $user)
                                @if($user->user_id == $order->user_id)
                                    @php $customer = $user->name @endphp
                                @endif
                            @endforeach
                            {{ ucwords($customer) }}
                        </td>
                        <td>
                            <h6><span class="badge @switch($order->payment_status)
                                @case('success')
                                    bg-success
@break
                                @case('failed')
                                    bg-danger
@break
                                @default
                                    bg-secondary
@break
                                @endswitch">{{ ucwords($order->payment_status) }}</span></h6>
                        </td>
                        <td>
                            <h6><span class="badge @switch($order->order_status)
                                @case('pending')
                                    bg-info
@break
                                @case('processing')
                                    bg-warning
@break
                                @case('processed')
                                    bg-primary
@break
                                @case('shipped')
                                    bg-primary
@break
                                @case('completed')
                                    bg-success
@break
                                @case('failed')
                                    bg-danger
@break
                                @default
                                    bg-secondary
@break
                                @endswitch">{{ ucwords($order->order_status) }}</span></h6>
                        </td>
                        <td>{{ 'Rs.'.$order->total.'/=' }}</td>
                        <td>{{ date_format($order->created_at, 'd-m-Y') }}</td>
                        <td>{{ date_format($order->updated_at, 'd-m-Y') }}</td>
                        @if(in_array( 'manage-order', json_decode($permissions)) || in_array( 'edit-order', json_decode($permissions)) || in_array( 'delete-order', json_decode($permissions)))
                        <td>
                            @if(in_array( 'manage-order', json_decode($permissions)))
                                <form action="{{ route('order-download') }}" method="post" class="d-inline-flex">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <button type="submit" class="btn bg-transparent"><i class="fas fa-file-pdf text-warning"></i>&nbsp;View</button>
                                </form>
                                <span class="d-inline-flex">|
                                    <button class="bg-white border-0" data-bs-toggle="modal" data-bs-target="#manageOrder-{{ $order->id }}"><i class="fas fa-shipping-fast text-info"></i>&nbsp;Manage</button>
                                </span>
                            @endif
                            @if(in_array( 'edit-order', json_decode($permissions)))
                                <span class="d-inline-flex">|
                                <button class="bg-white border-0" data-bs-toggle="modal" data-bs-target="#editOrder-{{ $order->id }}"><i class="fas fa-edit text-primary"></i>&nbsp;Edit</button>
                                </span>
                            @endif
                            @if(in_array( 'delete-order', json_decode($permissions)))
                                <form action="{{ route('delete-order') }}" method="post" class="d-inline-flex">
                                    @csrf
                                    <span class="d-inline-flex">|</span>
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <button type="submit" class="bg-white border-0">
                                        <i class="fas fa-trash-alt text-danger"></i>&nbsp;Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                        @endif
                    </tr>

                    @if(in_array( 'edit-order', json_decode($permissions)))
                        {{--            edit order modal--}}
                        <div class="modal fade" id="editOrder-{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit web order</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-2 me-2 ms-2">
                                        <form action="{{ route('edit-order') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <div class="row">
                                                <h6>Shipping Details</h6>
                                                <div class="mb-3 col-lg-6">
                                                    <input type="text" class="form-control form-control @error('shipping_name') is-invalid @enderror" placeholder="Full Name" name="shipping_name" value="{{ $order->shipping_name }}" >
                                                    @error('shipping_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-lg-6">
                                                    <input type="email" class="form-control form-control @error('shipping_email') is-invalid @enderror" placeholder="Email" name="shipping_email" value="{{ $order->shipping_email }}">
                                                    @error('shipping_email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-lg-6">
                                                    <input type="tel" class="form-control form-control @error('shipping_mobile') is-invalid @enderror" placeholder="Contact Number" name="shipping_mobile" value="{{ $order->shipping_mobile }}">
                                                    @error('shipping_mobile')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-lg-6">
                                                    <select class="form-select form-control @error('shipping_country') is-invalid @enderror" aria-label="Default select example" name="shipping_country" id="country" required="required" value="{{ $order->shipping_country }}">
                                                        <option selected disabled>Country</option>
                                                        <option value="sri lanka">Sri Lanka</option>
                                                    </select>
                                                    @error('shipping_country')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-lg-6">
                                                    <select class="form-select form-control  @error('shipping_district') is-invalid @enderror" aria-label="Default select example" name="shipping_district" id="district" required="required" value="{{ $order->shipping_district }}">
                                                        <option selected disabled>District</option>
                                                        <option value="hambantota">Hambantota</option>
                                                    </select>
                                                    @error('shipping_district')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-lg-6">
                                                    <select class="form-select form-control @error('shipping_city') is-invalid @enderror" aria-label="Default select example" name="shipping_city" id="city" required="required"  value="{{ $order->shipping_city }}">
                                                        <option selected disabled>City</option>
                                                        <option value="beliatta">Beliatta</option>
                                                    </select>
                                                    @error('shipping_city')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-lg-6">
                                                    <input type="text" class="form-control form-control @error('shipping_postal_code') is-invalid @enderror" placeholder="Zip | Postal Code" name="shipping_postal_code" id="postal_code"  value="{{ $order->shipping_postal_code }}">
                                                    @error('shipping_postal_code')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-lg-6">
                                                    <input type="text" class="form-control form-control @error('shipping_address') is-invalid @enderror" placeholder="Address Line 1" name="shipping_address1"  value="{{ $order->shipping_address1 }}">
                                                    @error('shipping_address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-lg-6">
                                                    <input type="text" class="form-control form-control" placeholder="Address Line 2" name="shipping_address2"  value="{{ $order->shipping_address2 }}">
                                                </div>


                                                {{--                    billing form--}}
                                                <h6>Billing Details</h6>
                                                <div class=" row col-lg-12" id="billing_form">
                                                    <div class="mb-3 col-lg-6">
                                                        <input type="text" class="form-control form-control @error('payment_name') is-invalid @enderror" placeholder="Full Name" name="payment_name"  value="{{ $order->payment_name }}">
                                                        @error('payment_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-lg-6">
                                                        <input type="email" class="form-control form-control @error('payment_email') is-invalid @enderror" placeholder="Email" name="payment_email" value="{{ $order->payment_email }}">
                                                        @error('payment_email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-lg-6">
                                                        <input type="tel" class="form-control form-control @error('payment_mobile') is-invalid @enderror" placeholder="Contact Number" name="payment_mobile" value="{{ $order->payment_mobile }}">
                                                        @error('payment_mobile')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-lg-6">
                                                        <select class="form-select form-control @error('payment_country') is-invalid @enderror" aria-label="Default select example" name="payment_country" id="country" required="required" value="{{ $order->payment_country }}">
                                                            <option selected disabled>Country</option>
                                                            <option value="sri lanka">Sri Lanka</option>
                                                        </select>
                                                        @error('payment_country')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-lg-6">
                                                        <input type="text" class="form-control form-control @error('payment_city') is-invalid @enderror" placeholder="City" name="payment_city" value="{{ $order->payment_city }}">
                                                        @error('payment_city')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-lg-6">
                                                        <input type="text" class="form-control form-control @error('payment_address') is-invalid @enderror" placeholder="Address" name="payment_address" value="{{ $order->payment_address }}">
                                                        @error('payment_address')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card col-lg-12 mt-lg-3" style="background-color: #F6FAFD;">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-5 border border-1 border-start-0 border-top-0 border-bottom-0">

                                                            <div class="form-check form-switch ms-3">
                                                                <input class="form-check-input" type="radio" name="shipping_method" role="switch" id="free-shipping" value="free_shipping" checked="@if($order->shipping_method == 'free_shipping') true @else false @endif">
                                                                <label class="form-check-label" for="free-shipping">Free Shipping</label>
                                                            </div>
                                                            <div class="form-check form-switch ms-3">
                                                                <input class="form-check-input" type="radio" name="shipping_method" role="switch" id="24-7-shipping" value="24_7_shipping" checked="@if($order->shipping_method == '24_7_shipping') true @else false @endif">
                                                                <label class="form-check-label" for="24-7-shipping">24/7 Shipping</label>
                                                            </div>
                                                            <hr>
                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Delivery Note" style="height: 100px" name="shipping_note" value="{{ $order->shipping_note }}"></textarea>
                                                                <label for="floatingTextarea2">Delivery Note</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="form-check form-switch ms-3">
                                                                <input class="form-check-input" type="radio" name="payment_method" role="switch" id="cash-on-delivery" value="cod" checked="@if($order->payment_method == 'cod') true @else false @endif">
                                                                <label class="form-check-label" for="cash-on-delivery">Cash On Delivery | COD</label>
                                                            </div>
                                                            <div class="form-check form-switch ms-3">
                                                                <input class="form-check-input" type="radio" name="payment_method" role="switch" id="payhere" value="payhere" checked="@if($order->payment_method == 'payhere') true @else false @endif">
                                                                <label class="form-check-label" for="payhere">Payhere | Online</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-warning col-lg-12 mt-lg-3" value="Update Order" name="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--            end edit cartorder modal--}}
                    @endif

                    @if(in_array( 'edit-order', json_decode($permissions)))
                        {{--            edit order modal--}}
                        <div class="modal fade" id="manageOrder-{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Manage web order:&nbsp;
                                            <h6><span class="badge @switch($order->order_status)
                                                @case('pending')
                                                    bg-info
@break
                                                @case('processing')
                                                    bg-warning
@break
                                                @case('processed')
                                                    bg-primary
@break
                                                @case('shipped')
                                                    bg-primary
@break
                                                @case('completed')
                                                    bg-success
@break
                                                @case('failed')
                                                    bg-danger
@break
                                                @default
                                                    bg-secondary
@break
                                                @endswitch">{{ ucwords($order->order_status) }}</span></h6>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-2 me-2 ms-2">
                                        <form action="{{ route('manage-order') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <div class="mb-3 mt-3">
                                                <h6>Order Status</h6>
                                                    <select name="order_status" id="" class="form-control">
                                                        <option value="" selected disabled>Select Status</option>
                                                        <option value="pending">pending</option>
                                                        <option value="processing">processing</option>
                                                        <option value="processed">processed</option>
                                                        <option value="shipped">shipped</option>
                                                        <option value="completed">completed</option>
                                                        <option value="failed">failed</option>
                                                    </select>
                                                @error('order_status')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <input type="submit" class="btn btn-warning col-lg-12 mt-lg-3" value="Update Order Status" name="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--            end edit cartorder modal--}}
                    @endif
                @endforeach
            </td>
            </tbody>
        </table>
        </div>
    @else
        <h6 class="d-inline-flex mt-3 ms-3 ">Something went wrong...! Please refresh page now&nbsp;</h6>
        <a class="btn btn-warning d-inline-flex mt-0 mt-lg-3 ms-3 ms-lg-0" href="{{ route('dashboard', ['state' => 'orders']) }}">Refresh</a>
    @endif
</div>
