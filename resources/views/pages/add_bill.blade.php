<div class="m-0">
    <link href="{{ asset('reader/css/style.css') }}" rel="stylesheet">
    <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px;">
        <h3 class="text-warning d-inline-block">New Bill</h3>
        @if(isset($_COOKIE['bill']))
            <div class="card btn-light d-inline-flex ms-3 p-1 mt-2 ">
                <h6 class="text-dark m-0"><i class="fas fa-shopping-bag p-2 bg-dark text-warning rounded-circle"></i>{{ ' Number Of Products: '.count(json_decode($_COOKIE['bill'])) }}</h6>
            </div>
            @php $full_total = 0; @endphp
            @foreach(json_decode($_COOKIE['bill']) as $bill)
                @foreach($products as $product)
                    @if($product->product_id == $bill->product_id)
                        @php $full_total += $product->unit_price * $bill->quantity; @endphp
                        @break
                    @endif
                @endforeach
            @endforeach
            <div class="card bg-light d-inline-flex ms-3 p-1">
                <h6 class="text-dark m-0"><i class="fas fa-hand-holding-usd p-2 bg-dark text-warning rounded-circle"></i>{{ ' Total bill: Rs.'.number_format($full_total).'/=' }}</h6>
            </div>


            <div class="card p-1 d-inline-flex ms-3 bg-light ">
{{--                <label for="customer-fee" class="text-white d-block">Customer Payment in Rupee</label>--}}

               <div class="row m-0">
                   <i class="fas fa-hand-holding-usd p-2 bg-dark text-warning rounded-circle col-2 me-3" style="width: 30px;"></i>
                   <input type="number" min="1" class="col-9 form-control m-0" id="customer_fee" placeholder="Customer Payment" onchange="calcRest('{{ $full_total }}')">

               </div>
            </div>
            <div class="card p-1 ms-3 btn-group-lg" style="display: none;" id="rest_box">
                <h6 class="text-dark m-0"><i class="fas fa-piggy-bank p-2 bg-dark text-warning rounded-circle"></i> Rest: Rs.<span id="rest"></span>/=</h6>
            </div>
        @endif
    </div>
    <div class="ps-3 pe-3 table-responsive">
        @if(isset($sells) || in_array( 'add-sell', json_decode($permissions)))
            <div class="row">
                <div class="col-lg-9">
                    <div class="table-responsive">
                        <table class="table mt-3 bg-light">
                            <thead>
                            <tr>
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Total</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($_COOKIE['bill']))
                                @foreach(json_decode($_COOKIE['bill']) as $bill)
                                    <tr>
                                        <th scope="row">{{ $bill->product_id }}</th>

                                        <td>
                                            @foreach($products as $product)
                                                @if($product->product_id == $bill->product_id)
                                                    {{ ucwords($product->name) }}
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <form action="{{ route('update-bill') }}" method="post" class="d-inline-flex">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $bill->product_id }}">
                                                <input type="number" name="quantity" id="quantity" class="me-2 rounded border-dark border-1 p-2" min="1" value="{{ $bill->quantity }}" style="width: 100px">
                                                <button type="submit" class="btn btn-outline-primary ">Update</button>
                                            </form>
                                        </td>
                                        <td>
                                            @foreach($products as $product)
                                                @if($product->product_id == $bill->product_id)
                                                    {{ 'Rs.'.number_format($product->unit_price).'/='}}
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($products as $product)
                                                @if($product->product_id == $bill->product_id)
                                                    {{'Rs.'.number_format($product->unit_price * $bill->quantity).'/='}}
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        @if(in_array( 'edit-sell', json_decode($permissions)))
                                            <td>
                                                @if(in_array( 'edit-sell', json_decode($permissions)))

                                                    <form action="{{ route('delete-from-bill') }}" method="post" class="d-inline-flex">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                                        <button type="submit" class="bg-transparent border-0">
                                                            <i class="fas fa-trash-alt text-danger"></i><span class="text-dark">&nbsp;Delete</span>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-3">
                    <form action="{{ route('add-to-bill') }}" method="post" class="mt-2">
                        @csrf
                            <h6>Products</h6>
                            <input type="hidden" name="product_id" id="product">
                            <div class="mb-2 ">
                                <select class="form-select" aria-label="Select Product by name" onchange="selectProduct(this.value)" id="by-name">
                                    <option selected disabled>Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->product_id}}">{{ $product->product_id.' | '.$product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="card bg-warning p-2 mb-2">
                            <select class="p-1 border-0 rounded" id="camera-select"></select>
                            <div class="well mt-2">
                                <canvas style="width: 100% !important; height: 100% !important;" id="webcodecam-canvas"></canvas>
                                <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                                <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                                <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                                <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                            </div>
                            <button title="Play" class="btn btn-primary" id="play" type="button" data-toggle="tooltip">Scan BarCode | QR Code</button>
                            <span title="Decode Image" class="btn btn-default btn-sm d-none" id="decode-img" type="button" data-toggle="tooltip"></span>
                            <span title="Image shoot" class="btn btn-info btn-sm disabled d-none" id="grab-img" type="button" data-toggle="tooltip"></span>
                            <img width="320" height="240" id="scanned-img" src="" class="d-none">
                            <p id="scanned-QR" class="mt-1"></p>
                        </div>
                        <div class="mb-2 bg-warning rounded p-2 ">
                            <label for="quantity" class="fw-bolder ">Quantity </label>
                            <input type="number" name="quantity" value="1" min="1" class="form-control" id="quantity" onchange="">
                        </div>
                            <div class="mb-3 ">
                                <button class="btn btn-warning col-12 p-3 fw-bolder fs-4" type="submit"><i class="fas fa-file-invoice-dollar fs-5"></i>&nbsp;Add To Bill</button>
                            </div>

                    </form>
                </div>
            </div>

            <form action="{{ route('make-bill') }}" method="post">
                @csrf
                <h6>Customer</h6>
                <div class="mb-3 col-lg-12 p-0">
                    <select class="form-select" aria-label="Select User" name="user_id">
                        <option selected disabled>Select Customer [Not Required]</option>
                        @foreach($users as $user)
                            <option value="{{$user->user_id}}">{{ $user->user_id.' | '.$user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">

                    <div class="mb-3 col-lg-3 ">
                        <a href="{{ route('clear-bill') }}" class="btn btn-danger col-12 p-4"><h3 class="lead"><i class="fas fa-eraser"></i>&nbsp;Clear Bill</h3></a>
                    </div>
                    <div class="mb-3 col-lg-9">
                        <button type="submit" class="btn btn-success col-12 p-4" @if(!isset($_COOKIE['bill'])) disabled="disabled" @endif><h3 class="lead"><i class="fas fa-cash-register"></i>&nbsp;Make Bill</h3></button>
                    </div>
                </div>
            </form>
        @else
            <h6 class="d-inline-flex mt-3 ms-3 ">Something went wrong...! Please refresh page now&nbsp;</h6>
            <a class="btn btn-warning d-inline-flex mt-0 mt-lg-3 ms-3 ms-lg-0" href="{{ route('dashboard', ['state' => 'add_bill']) }}">Refresh</a>
        @endif
    </div>
</div>
<script>
    function selectProduct(product_id){
        document.getElementById('product').value =  product_id;

    }
    function calcRest(total){
        let payment = document.getElementById('customer_fee').value;
        if(payment == null || payment == 0){
            document.getElementById('rest_box').style.display = 'none';
        }else{
            document.getElementById('rest').innerText = payment - total;
            document.getElementById('rest_box').style.display = 'inline-flex';
        }
    }
</script>
<script type="text/javascript" src="{{ asset('reader/js/filereader.js') }}"></script>
<script type="text/javascript" src="{{ asset('reader/js/qrcodelib.js') }}"></script>
<script type="text/javascript" src="{{ asset('reader/js/webcodecamjs.js') }}"></script>
<script type="text/javascript" src="{{ asset('reader/js/main.js') }}"></script>
