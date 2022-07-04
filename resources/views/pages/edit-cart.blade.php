<div class="m-0">
    <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px;">
        <div class="row">
            <h3 class="text-warning col-lg-10">Edit Cart</h3>
            @if(in_array( 'view-cart', json_decode($permissions)))
                <div class="col-lg-2  pt-2">
                    <a class="btn btn-warning" href="{{ route('dashboard', ['state' => 'cart']) }}">Back</a>
                </div>
            @endif
        </div>
    </div>
    <div>
        @if(isset($carts) || in_array( 'view-cart', json_decode($permissions)) || in_array( 'edit-cart', json_decode($permissions)))
            <div class="ps-3 pe-3 table-responsive">
                <table class="table mt-3">
                    <tbody>
                    @foreach($cart as $cart)
                        <tr>
                            <td>
                                <img src="
 @if(isset($main_images))
                                @foreach($main_images as $main_image)
                                @if($main_image['product_id'] == $cart->product_id){{ asset('product_images/'.$main_image['product_id'].'/'.json_decode($main_image['image']))  }}
                                @break
                                @endif
                                @endforeach
                                @endif
" alt="" class="" style="width: 100px;"/>
                            </td>
                            <td>
                                <h5>{{ ucwords($cart->name) }}</h5>
                                <h6>Unit: Rs:{{number_format( $cart->unit_price) }}/=</h6>
                                <h6>Total: Rs:{{ number_format($cart->unit_price * $cart->user_quantity) }}/=</h6>
                            </td>
                            <td> <h6 class="d-inline">Quantity:</h6>
                                {{$cart->user_quantity}}
                                <form action="{{ route('remove-item-cart') }}" method="post" >
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $cart->product_id }}">
                                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                    <button type="submit" class="btn btn-outline-danger btn-close d-inline-flex float-end"></button>
                                </form>
                                <form action="{{ route('update-item-cart') }}" method="post" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                    <input type="hidden" name="product_id" value="{{ $cart->product_id }}">
                                    <input type="number" name="quantity" id="quantity" class="form-control d-inline-flex" min="1" value="{{ $cart->user_quantity }}" style="width: 100px">
                                    <button type="submit" class="btn btn-outline-primary d-inline-flex">Update</button>
                                </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h6 class="d-inline-flex mt-3 ms-3 ">Something went wrong...! Please refresh page now&nbsp;</h6>
            <a class="btn btn-warning d-inline-flex mt-0 mt-lg-3 ms-3 ms-lg-0" href="{{ route('dashboard', ['state' => 'cart']) }}">Refresh</a>
        @endif
    </div>
</div>
