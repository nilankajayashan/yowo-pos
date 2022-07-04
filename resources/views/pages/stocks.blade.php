<div class="m-0">
    <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px;">
        <div class="row">
            <h3 class="text-warning col-lg-10">Stocks</h3>
        </div>
    </div>
    <div class="ps-3 pe-3 table-responsive">
        @if(isset($products) || in_array( 'view-product', json_decode($permissions)))
            <table class="table mt-3 ">
                <thead>
                <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Status</th>
                    @if(in_array( 'edit-product', json_decode($permissions)))
                        <th scope="col">Update Stock</th>
                @endif
                </thead>
                </tr>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $product->product_id }}</th>
                        <td>{{ ucwords($product->name) }}</td>
                        <td>
                            <div style="width: 100px;" class="">
                                <img src="{{ asset('product_images/'.$product->product_id.'/'.json_decode($product->main_image))  }}" alt="{{ $product->name }}" class="w-100">
                            </div>
                        </td>
                        <td>
                            @php $category_name = 'Can not find'; @endphp
                            @foreach($categories as $category)
                                @if($category->category_id == $product->categories)
                                    @php $category_name = $category->name @endphp
                                @endif
                            @endforeach
                            {{ ucwords( $category_name ) }}
                        </td>
                        <td>{{ 'Rs.'.number_format($product->unit_price).'/=' }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <h6><span class="badge @if($product->status == 1)
                                    bg-success
@else
                                    bg-secondary
@endif">@if($product->status == 1) Active @else Deactive @endif</span></h6>
                        </td>
                        @if(in_array( 'edit-product', json_decode($permissions)))
                            <td>
                                <form action="{{ route('update-product-stock') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                             <div class="row" style="width: 150px;">
                                 <input type="number" class="form-control col-5" name="quantity" placeholder="Quantity" required="required" min="1" value="{{ $product->quantity }}">
                                 <button type="submit" class="btn btn-warning col-6 ms-2">Update</button>
                             </div>
                                </form>
                            </td>
                        @endif
                    </tr>
                        @endforeach
                        </td>
                </tbody>
            </table>
        @else
            <h6 class="d-inline-flex mt-3 ms-3 ">Something went wrong...! Please refresh page now&nbsp;</h6>
            <a class="btn btn-warning d-inline-flex mt-0 mt-lg-3 ms-3 ms-lg-0" href="{{ route('dashboard', ['state' => 'products']) }}">Refresh</a>
        @endif
    </div>
</div>
