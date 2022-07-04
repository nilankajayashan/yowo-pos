<div class="m-0">
    <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px;">
        <div class="row">
            @if(in_array( 'add-cart', json_decode($permissions)))
                {{--            add cart modal--}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add to cart</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('add-to-cart') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <select name="user_id" id="" class="form-control">
                                            <option value="" disabled selected>Select Customer</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->user_id }}">{{ $user->user_id.' | '.$user->name.' | '.$user->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                        <div class="bg-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <select name="product_id" id="" class="form-control">
                                            <option value="" disabled selected>Select Customer</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->product_id }}">{{ $product->product_id.' | '.$product->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                        <div class="bg-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" placeholder="Quantity" required="required" min="1" value="1">
                                        @error('quantity')
                                        <div class="bg-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-warning col-12" value="Add To Cart">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{--            end add cart modal--}}
            @endif
            <h3 class="text-warning col-lg-10">Carts</h3>
            @if(in_array( 'add-cart', json_decode($permissions)))
                <div class="col-lg-2  pt-2">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Add To Cart</button>
                </div>
            @endif
        </div>
    </div>
    <div class="ps-3 pe-3 table-responsive">
        @if(isset($carts) || in_array( 'view-cart', json_decode($permissions)))
            <table class="table mt-3">
                <thead>
                <tr>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Updated @</th>
                    @if(in_array( 'edit-cart', json_decode($permissions)) || in_array( 'delete-cart', json_decode($permissions)))
                        <th scope="col">Actions</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                        <tr>
                            <th scope="row">{{ $cart->user_id }}</th>
                            <td>
                                @php $user_name  = ''; @endphp
                                @foreach($users as $user)
                                    @if($user->user_id == $cart->user_id)
                                        @php $user_name = $user->name @endphp
                                    @endif
                                @endforeach
                                {{ ucwords($user_name) }}
                            </td>
                            <td>{{ date_format($cart->updated_at, 'd-m-Y') }}</td>
                            @if(in_array( 'edit-cart', json_decode($permissions)) || in_array( 'delete-cart', json_decode($permissions)))
                                <td>
                                    @if(in_array( 'edit-cart', json_decode($permissions)))
                                        <form action="{{ route('edit-cart-view') }}" method="post" class="d-inline-flex">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $cart->user_id }}">
                                            <button type="submit" class="bg-white border-0">
                                                <i class="fas fa-edit text-primary"></i>&nbsp;Edit
                                            </button>
                                        </form>
                                    @endif
                                    @if(in_array( 'delete-cart', json_decode($permissions)))
                                        <form action="{{ route('delete-cart') }}" method="post" class="d-inline-flex">
                                            @csrf
                                            <span class="d-inline-flex">|</span>
                                            <input type="hidden" name="user_id" value="{{ $cart->user_id }}">
                                            <button type="submit" class="bg-white border-0">
                                                <i class="fas fa-trash-alt text-danger"></i>&nbsp;Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </td>
                </tbody>
            </table>
        @else
            <h6 class="d-inline-flex mt-3 ms-3 ">Something went wrong...! Please refresh page now&nbsp;</h6>
            <a class="btn btn-warning d-inline-flex mt-0 mt-lg-3 ms-3 ms-lg-0" href="{{ route('dashboard', ['state' => 'cart']) }}">Refresh</a>
        @endif
    </div>
</div>
