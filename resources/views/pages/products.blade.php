<div class="m-0">
    <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px;">
        <div class="row">
            <h3 class="text-warning col-lg-10">Products</h3>
            @if(in_array( 'add-product', json_decode($permissions)))
                <div class="col-lg-2  pt-2">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
                </div>
            @endif
        </div>
        @if(in_array( 'add-product', json_decode($permissions)))
            {{--            add product modal--}}
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add-product') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Product Name" required="required">
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Product Description" id="description" name="description"></textarea>
                                                <label for="description">Product Description</label>
                                            </div>
                                            @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control @error('model') is-invalid @enderror" name="model" placeholder="Model">
                                            @error('model')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" placeholder="Quantity" min="1" required="required">
                                            @error('quantity')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">

                                        <div class="mb-3">
                                            <input type="number" class="form-control @error('unit_price') is-invalid @enderror" name="unit_price" placeholder="Unit Price in Sri Lankan Rupee" min="1" required="required">
                                            @error('unit_price')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" class="form-control" name="weight" placeholder="Weight" min="1" required="required">
                                        </div>
                                    </div>

                                    <div class="mb-3 row pe-0">
                                        <div class="col-lg-4">
                                            <input type="number" class="form-control" name="length" placeholder="Length" min="1">
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="number" class="form-control" name="width" placeholder="Width" min="1">
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="number" class="form-control" name="height" placeholder="Height" min="1">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <select name="category" id="" class="form-control @error('categories') is-invalid @enderror" required="required">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    @if($category->parent_id == 0)
                                                        <option class="fw-bold" value="{{ $category->category_id }}">{{ $category->name }}</option>
                                                        @foreach($categories as $sub_category)
                                                             @if($sub_category->parent_id == $category->category_id)
                                                                <option class="ps-2" value="{{ $sub_category->category_id }}">&nbsp;&nbsp;{{ $sub_category->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>





                                            </select>
                                            @error('categories')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="file" class="form-control @error('main_image') is-invalid @enderror" name="main_image" placeholder="main_image" required="required">
                                            @error('main_image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="file" class="form-control" name="additional_images[]" placeholder="additional_images" multiple="multiple">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-warning col-12" value="Add Product">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{--            end add product modal--}}
        @endif
    </div>
    <div class="ps-3 pe-3 table-responsive">
        @if(isset($products) || in_array( 'view-product', json_decode($permissions)))
            <table class="table mt-3">
                <thead>
               <tr>
                   <th scope="col">Product ID</th>
                   <th scope="col">Name</th>
                   <th scope="col">Image</th>
                   <th scope="col">Category</th>
                   <th scope="col">Unit Price</th>
                   <th scope="col">Quantity</th>
                   <th scope="col">Status</th>
                   @if(in_array( 'approve-product', json_decode($permissions)) || in_array( 'edit-product', json_decode($permissions)) || in_array( 'delete-product', json_decode($permissions)))
                       <th scope="col">Actions</th>
                   @endif
               </tr>
                </thead>
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
                            @if(in_array( 'approve-product', json_decode($permissions)) || in_array( 'edit-product', json_decode($permissions)) || in_array( 'delete-product', json_decode($permissions)))
                                <td>
                                    @if(in_array( 'approve-product', json_decode($permissions)))
                                        <form action="{{ route('change-status-product') }}" method="post" class="d-inline-flex">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                            <button type="submit" class="bg-white border-0">
                                                @if($product->status == 0)
                                                    <i class="fas fa-check-circle text-success"></i>&nbsp;Active
                                                @elseif($product->status == 1)
                                                    <i class="fas fa-times-circle text-danger"></i>&nbsp;Deactive
                                                @else
                                                    <i class="fas fa-sync text-info"></i>&nbsp;Change Status
                                                @endif
                                            </button>
                                        </form>
                                    @endif
                                        @if(in_array( 'edit-product', json_decode($permissions)))

                                            <form action="{{ route('generate-barcode') }}" method="post" class="d-inline-flex">
                                                @csrf
                                                <span class="d-inline-flex">|&nbsp;</span>
                                                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                                <button type="submit" class="btn bg-transparent p-0"><i class="fas fa-file-pdf text-warning"></i> BarCode</button>
                                            </form>
                                            <span class="d-inline-flex">|
                                          <button class="bg-white border-0" data-bs-toggle="modal" data-bs-target="#editProduct-{{ $product->product_id }}"><i class="fas fa-edit text-primary"></i>Edit</button>
                                            </span>
                                        @endif
                                    @if(in_array( 'delete-product', json_decode($permissions)))

                                        <form action="{{ route('delete-product') }}" method="post" class="d-inline-flex">
                                            @csrf
                                            <span class="d-inline-flex">|</span>
                                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                            <button type="submit" class="bg-white border-0">
                                                <i class="fas fa-trash-alt text-danger"></i>&nbsp;Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            @endif
                        </tr>
                        @if(in_array( 'edit-product', json_decode($permissions)))
                            {{--            edit product modal--}}
                            <div class="modal fade" id="editProduct-{{ $product->product_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('edit-product') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Product Name" required="required" value="{{ $product->name }}">
                                                            @error('name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-floating">
                                                                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Product Description" id="description" name="description" value="{{ $product->description }}"></textarea>
                                                                <label for="description">Product Description</label>
                                                            </div>
                                                            @error('description')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <input type="text" class="form-control @error('model') is-invalid @enderror" name="model" placeholder="Model" value="{{ $product->model }}">
                                                            @error('model')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" placeholder="Quantity" min="1" required="required" value="{{ $product->quantity }}">
                                                            @error('quantity')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <input type="number" class="form-control @error('unit_price') is-invalid @enderror" name="unit_price" placeholder="Unit Price in Sri Lankan Rupee" min="1" required="required" value="{{ $product->unit_price }}">
                                                            @error('unit_price')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <input type="number" class="form-control" name="weight" placeholder="Weight" min="1" required="required" value="{{ $product->weight }}">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row pe-0">
                                                        @php $dimensions = json_decode($product->dimensions) @endphp
                                                        <div class="col-lg-4">
                                                            <input type="number" class="form-control" name="length" placeholder="Length" min="1" value="@if(count($dimensions)>0){{ $dimensions[0] }}@endif">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="number" class="form-control" name="width" placeholder="Width" min="1" value="@if(count($dimensions)>1){{ $dimensions[1] }}@endif">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="number" class="form-control" name="height" placeholder="Height" min="1" value="@if(count($dimensions)>2){{ $dimensions[2] }}@endif">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <select name="category" id="" class="form-control @error('categories') is-invalid @enderror" required="required">
                                                                <option value="" >Select Category</option>
                                                                @foreach($categories as $category)
                                                                    @if($category->parent_id == 0)
                                                                        <option class="fw-bold" value="{{ $category->category_id }}" selected="@if($product->category_id == $category->category_id) true @endif">{{ $category->name }}</option>
                                                                        @foreach($categories as $sub_category)
                                                                            @if($sub_category->parent_id == $category->category_id)
                                                                                <option class="ps-2" value="{{ $sub_category->category_id }}" selected="@if($product->category_id == $sub_category->category_id) true @endif">&nbsp;&nbsp;{{ $sub_category->name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            </select>





                                                            </select>
                                                            @error('categories')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 text-center">
                                                            <div class="col-lg-12 mb-3" id="{{$product->main_image}}">
                                                                <img src="{{ asset('product_images/'.$product->product_id.'/'.json_decode($product->main_image))  }}" alt="{{ $product->name }}" class="w-75">
                                                                <button type="button" class="btn-close align-top" aria-label="Close" onclick="remover('{{$product->main_image}}')"></button>
                                                            </div>
                                                            <input type="file" class="form-control @error('main_image') is-invalid @enderror" name="main_image" placeholder="main_image" id="main_image">
                                                            @error('main_image')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="col-lg-12 mb-3 row">
                                                                @php $old_additional_images = []; @endphp
                                                                @foreach(json_decode($product->additional_images) as $image)
                                                                    @php  array_push($old_additional_images, $image); @endphp
                                                                    <div class="col-lg-4 p-2 border-0 text-center" id="{{ $image }}">
                                                                    <img src="{{ asset('product_images/'.$product->product_id.'/'.$image)  }}" alt="{{ $product->name }}" class="" style="width: 300px;">
                                                                    <button type="button" class="btn-close align-top" aria-label="Close" onclick="additionalremover('{{$image}}')"></button>
                                                                </div>
                                                                @endforeach
                                                                <input type="hidden" name="old_additional_images" id="old_additional_images" value="{{ json_encode($old_additional_images) }}">
                                                            </div>
                                                            <input type="file" class="form-control" name="additional_images[]" placeholder="additional_images" multiple="multiple">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="submit" class="btn btn-warning col-12" value="Update Product">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--            end edit product modal--}}
                        @endif
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
<script>
    function remover(id){
        document.getElementById(id).style.display = 'none';
        document.getElementById('main_image').setAttribute('required', 'required');
    }
    function additionalremover(id){
        document.getElementById(id).style.display = 'none';
        let old_list = JSON.parse(document.getElementById('old_additional_images').value);
        var index = old_list.indexOf(id);
        if (index !== -1) {
            old_list.splice(index, 1);
        }
        document.getElementById('old_additional_images').value = JSON.stringify(old_list);
    }
</script>
