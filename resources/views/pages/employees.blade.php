<div class="m-0">
    <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px;">
        <div class="row">
            @if(in_array( 'add-employee', json_decode($permissions)))
                {{--            add user modal--}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('add-employee') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Employee Name" required="required">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" required="required">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="Contact Number">
                                        @error('mobile')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required="required">
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <h6>PERMISSIONS</h6>
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <h6 class="">Categories</h6>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="view-category" name="view_category" value="view-category" onchange="removeOptions('view-category',['add-category','edit-category','delete-category','approve-category'])">
                                                    <label class="form-check-label" for="view-category">View Category</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="add-category" name="add_category" value="add-category" onchange="setRequired('view-category','add-category',['add-category','edit-category','delete-category','approve-category'])">
                                                    <label class="form-check-label" for="add-category">Add Category</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="edit-category" name="edit_category" value="edit-category" onchange="setRequired('view-category','edit-category',['add-category','edit-category','delete-category','approve-category'])">
                                                    <label class="form-check-label" for="edit-category">Edit Category</label>
                                                </div>
                                               <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="approve-category" name="approve_category" value="approve-category"  onchange="setRequired('view-category','approve-category',['add-category','edit-category','delete-category','approve-category'])">
                                                    <label class="form-check-label" for="approve-category">Active/De-active Category</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="delete-category" name="delete_category" value="delete-category"  onchange="setRequired('view-category','delete-category',['add-category','edit-category','delete-category','approve-category'])">
                                                    <label class="form-check-label" for="delete-category">Delete Category</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <h6 class="">Products</h6>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="view-product" name="view_product" value="view-product" onchange="removeOptions('view-product',['add-product','edit-product','delete-product','approve-product'])">
                                                    <label class="form-check-label" for="view-product">View Product</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="add-product" name="add_product" value="add-product" onchange="setRequired('view-product','add-product',['add-product','edit-product','delete-product','approve-product'])">
                                                    <label class="form-check-label" for="add-product">Add Product</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="edit-product" name="edit_product" value="edit-product" onchange="setRequired('view-product','edit-product',['add-product','edit-product','delete-product','approve-product'])">
                                                    <label class="form-check-label" for="edit-product">Edit Product</label>
                                                </div>
                                               <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="approve-product" name="approve_product" value="approve-product"  onchange="setRequired('view-product','approve-product',['add-product','edit-product','delete-product','approve-product'])">
                                                    <label class="form-check-label" for="approve-product">Active/De-active Product</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="delete-product" name="delete_product" value="delete-product"  onchange="setRequired('view-product','delete-product',['add-product','edit-product','delete-product','approve-product'])">
                                                    <label class="form-check-label" for="delete-product">Delete Product</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <h6 class="">Sells</h6>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="view-sell" name="view_sell" value="view-sell" onchange="removeOptions('view-sell',['add-sell','edit-sell','delete-sell'])">
                                                    <label class="form-check-label" for="view-sell">View Sell</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="add-sell" name="add_sell" value="add-sell" onchange="setRequired('view-sell','add-sell',['add-sell','edit-sell','delete-sell'])">
                                                    <label class="form-check-label" for="add-sell">Add Sell</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="edit-sell" name="edit_sell" value="edit-sell" onchange="setRequired('view-sell','edit-sell',['add-sell','edit-sell','delete-sell'])">
                                                    <label class="form-check-label" for="edit-sell">Edit Sell</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="delete-sell" name="delete_sell" value="delete-sell"  onchange="setRequired('view-sell','delete-sell',['add-sell','edit-sell','delete-sell'])">
                                                    <label class="form-check-label" for="delete-sell">Delete Sell</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6 mb-3">
                                                <h6 class="">Customers</h6>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="view-customer" name="view_customer" value="view-customer" onchange="removeOptions('view-customer',['add-customer','edit-customer','delete-customer'])">
                                                    <label class="form-check-label" for="view-customer">View Customer</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="add-customer" name="add_customer" value="add-customer" onchange="setRequired('view-customer','add-customer',['add-customer','edit-customer','delete-customer'])">
                                                    <label class="form-check-label" for="add-customer">Add Customer</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="edit-customer" name="edit_customer" value="edit-customer" onchange="setRequired('view-customer','edit-customer',['add-customer','edit-customer','delete-customer'])">
                                                    <label class="form-check-label" for="edit-customer">Edit Customer</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="delete-customer" name="delete_customer" value="delete-customer"  onchange="setRequired('view-customer','delete-customer',['add-customer','edit-customer','delete-customer'])">
                                                    <label class="form-check-label" for="delete-customer">Delete Customer</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <h6 class="">Employees</h6>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="view-employee" name="view_employee" value="view-employee" onchange="removeOptions('view-employee',['add-employee','edit-employee','delete-employee','approve-employee'])">
                                                    <label class="form-check-label" for="view-employee">View Employee</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="add-employee" name="add_employee" value="add-employee" onchange="setRequired('view-employee','add-employee',['add-employee','edit-employee','delete-employee','approve-employee'])">
                                                    <label class="form-check-label" for="add-employee">Add Employee</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="edit-employee" name="edit_employee" value="edit-employee" onchange="setRequired('view-employee','edit-employee',['add-employee','edit-employee','delete-employee','approve-employee'])">
                                                    <label class="form-check-label" for="edit-employee">Edit Employee</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="approve-employee" name="approve_employee" value="approve-employee"  onchange="setRequired('view-employee','approve-employee',['add-employee','edit-employee','delete-employee','approve-employee'])">
                                                    <label class="form-check-label" for="approve-employee">Active/De-active Employee</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="delete-employee" name="delete_employee" value="delete-employee"  onchange="setRequired('view-employee','delete-employee',['add-employee','edit-employee','delete-employee','approve-employee'])">
                                                    <label class="form-check-label" for="delete-employee">Delete Employee</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <h6 class="">Web Orders</h6>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="view-order" name="view_order" value="view-order" onchange="removeOptions('view-order',['add-order','edit-order','delete-order','manage-order'])">
                                                    <label class="form-check-label" for="view-order">View Order</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="add-order" name="add_order" value="add-order" onchange="setRequired('view-order','add-order',['add-order','edit-order','delete-order','manage-order'])">
                                                    <label class="form-check-label" for="add-order">Add Order</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="edit-order" name="edit_order" value="edit-order" onchange="setRequired('view-order','edit-order',['add-order','edit-order','delete-order','manage-order'])">
                                                    <label class="form-check-label" for="edit-order">Edit Order</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="manage-order" name="manage_order" value="manage-order" onchange="setRequired('view-order','manage-order',['add-order','edit-order','delete-order','manage-order'])">
                                                    <label class="form-check-label" for="manage-order">Manage Order</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="delete-order" name="delete_order" value="delete-order"  onchange="setRequired('view-order','delete-order',['add-order','edit-order','delete-order','manage-order'])">
                                                    <label class="form-check-label" for="delete-order">Delete Order</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <h6 class="">Website Carts</h6>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="view-cart" name="view_cart" value="view-cart" onchange="removeOptions('view-cart',['add-cart','edit-cart','delete-cart'])">
                                                    <label class="form-check-label" for="view-cart">View cart</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="add-cart" name="add_cart" value="add-cart" onchange="setRequired('view-cart','add-cart',['add-cart','edit-cart','delete-cart'])">
                                                    <label class="form-check-label" for="add-cart">Add cart</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="edit-cart" name="edit_cart" value="edit-cart" onchange="setRequired('view-cart','edit-cart',['add-cart','edit-cart','delete-cart'])">
                                                    <label class="form-check-label" for="edit-cart">Edit cart</label>
                                                </div>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="delete-cart" name="delete_cart" value="delete-cart"  onchange="setRequired('view-cart','delete-cart',['add-cart','edit-cart','delete-cart'])">
                                                    <label class="form-check-label" for="delete-cart">Delete cart</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <h6 class="">Website Settings</h6>
                                                <div class="form-check ms-3">
                                                    <input class="form-check-input" type="checkbox" id="site-setting" name="site_setting" value="site-setting">
                                                    <label class="form-check-label" for="site-setting">Site Setting</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-warning col-12" value="Add Employee">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{--            end add user modal--}}
            @endif
            <h3 class="text-warning col-lg-10">Employees</h3>
            @if(in_array( 'add-employee', json_decode($permissions)))
                <div class="col-lg-2  pt-2">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Employee</button>
                </div>
            @endif
        </div>
    </div>
    <div class="ps-3 pe-3 table-responsive">
        @if(isset($employees) || in_array( 'view-employee', json_decode($permissions)))
            <table class="table mt-3">
                <thead>
               <tr>
                   <th scope="col">Employee ID</th>
                   <th scope="col">Name</th>
                   <th scope="col">Email</th>
                   <th scope="col">Mobile number</th>
                   <th scope="col">Status</th>
                   <th scope="col">Since</th>
                   @if(in_array( 'edit-employee', json_decode($permissions)) || in_array( 'delete-employee', json_decode($permissions))|| in_array( 'approve-employee', json_decode($permissions)))
                       <th scope="col">Actions</th>
                   @endif
               </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <th scope="row">{{ $employee->employee_id }}</th>
                            <td>{{ ucwords($employee->name) }}</td>
                            <td>{{ ucwords($employee->email) }}</td>
                            <td>{{ $employee->mobile }}</td>
                            <td>
                                <h6><span class="badge @if($employee->status == 1)
                                        bg-success
                                    @else
                                        bg-secondary
                                    @endif">@if($employee->status == 1) Active @else Deactive @endif</span></h6>
                            </td>
                            <td>{{ $employee->created_at }}</td>
                            @if(in_array( 'edit-employee', json_decode($permissions)) || in_array( 'delete-employee', json_decode($permissions))| in_array( 'approve-employee', json_decode($permissions)))
                                <td>
                                    @if(in_array( 'approve-employee', json_decode($permissions)))
                                        <form action="{{ route('change-status-employee') }}" method="post" class="d-inline-flex">
                                            @csrf
                                            <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">
                                            <button type="submit" class="bg-white border-0">
                                                @if($employee->status == 0)
                                                    <i class="fas fa-check-circle text-success"></i>&nbsp;Active
                                                @elseif($employee->status == 1)
                                                    <i class="fas fa-times-circle text-danger"></i>&nbsp;Deactive
                                                @else
                                                    <i class="fas fa-sync text-info"></i>&nbsp;Change Status
                                                @endif
                                            </button>
                                        </form>
                                    @endif
                                    @if(in_array( 'edit-employee', json_decode($permissions)))
                                        <span class="d-inline-flex">|
                                            <button class="bg-white border-0" data-bs-toggle="modal" data-bs-target="#editEmployee-{{ $employee->employee_id }}"><i class="fas fa-edit text-primary"></i>&nbsp;Edit</button>
                                        </span>
                                    @endif
                                    @if(in_array( 'delete-employee', json_decode($permissions)))
                                        <form action="{{ route('delete-employee') }}" method="post" class="d-inline-flex">
                                            @csrf
                                            <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">
                                            <span class="d-inline-flex">|</span>
                                            <button type="submit" class="bg-white border-0">
                                                <i class="fas fa-trash-alt text-danger"></i>&nbsp;Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            @endif
                        </tr>
                        @if(in_array( 'edit-employee', json_decode($permissions)))
                            {{--            edit user modal--}}
                            <div class="modal fade" id="editEmployee-{{ $employee->employee_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Employee:&nbsp; {{ $employee->email }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('edit-employee') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="email" required="required" value="{{ $employee->email }}">
                                                <input type="hidden" name="employee_id" required="required" value="{{ $employee->employee_id }}">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Employee Name" required="required" value="{{ $employee->name }}">
                                                    @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <input type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="Contact Number" value="{{ $employee->mobile }}">
                                                    @error('mobile')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                                                    @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <h6>PERMISSIONS</h6>
                                                    <div class="row">
                                                        <div class="col-lg-6 mb-3">
                                                            <h6 class="">Categories</h6>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="view-category-{{ $employee->employee_id }}" name="view_category" value="view-category" onchange="removeOptions('view-category-{{ $employee->employee_id }}',['add-category-{{ $employee->employee_id }}','edit-category-{{ $employee->employee_id }}','delete-category-{{ $employee->employee_id }}','approve-category-{{ $employee->employee_id }}'])" @if(in_array('view-category', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="view-category-{{ $employee->employee_id }}">View Category</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="add-category-{{ $employee->employee_id }}" name="add_category" value="add-category" onchange="setRequired('view-category-{{ $employee->employee_id }}','add-category-{{ $employee->employee_id }}',['add-category-{{ $employee->employee_id }}','edit-category-{{ $employee->employee_id }}','delete-category-{{ $employee->employee_id }}','approve-category-{{ $employee->employee_id }}'])" @if(in_array('add-category', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="add-category-{{ $employee->employee_id }}">Add Category</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="edit-category-{{ $employee->employee_id }}" name="edit_category" value="edit-category" onchange="setRequired('view-category-{{ $employee->employee_id }}','edit-category-{{ $employee->employee_id }}',['add-category-{{ $employee->employee_id }}','edit-category-{{ $employee->employee_id }}','delete-category-{{ $employee->employee_id }}','approve-category-{{ $employee->employee_id }}'])"  @if(in_array('edit-category', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="edit-category-{{ $employee->employee_id }}">Edit Category</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="approve-category-{{ $employee->employee_id }}" name="approve_category" value="approve-category"  onchange="setRequired('view-category-{{ $employee->employee_id }}','approve-category-{{ $employee->employee_id }}',['add-category-{{ $employee->employee_id }}','edit-category-{{ $employee->employee_id }}','delete-category-{{ $employee->employee_id }}','approve-category-{{ $employee->employee_id }}'])"  @if(in_array('approve-category', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="approve-category-{{ $employee->employee_id }}">Active/De-active Category</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="delete-category-{{ $employee->employee_id }}" name="delete_category" value="delete-category"  onchange="setRequired('view-category-{{ $employee->employee_id }}','delete-category-{{ $employee->employee_id }}',['add-category-{{ $employee->employee_id }}','edit-category-{{ $employee->employee_id }}','delete-category-{{ $employee->employee_id }}','approve-category-{{ $employee->employee_id }}'])"  @if(in_array('delete-category', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="delete-category-{{ $employee->employee_id }}">Delete Category</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-3">
                                                            <h6 class="">Products</h6>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="view-product-{{ $employee->employee_id }}" name="view_product" value="view-product" onchange="removeOptions('view-product-{{ $employee->employee_id }}',['add-product-{{ $employee->employee_id }}','edit-product-{{ $employee->employee_id }}','delete-product-{{ $employee->employee_id }}','approve-product-{{ $employee->employee_id }}'])"  @if(in_array('view-product', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="view-product-{{ $employee->employee_id }}">View Product</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="add-product-{{ $employee->employee_id }}" name="add_product" value="add-product" onchange="setRequired('view-product-{{ $employee->employee_id }}','add-product-{{ $employee->employee_id }}',['add-product-{{ $employee->employee_id }}','edit-product-{{ $employee->employee_id }}','delete-product-{{ $employee->employee_id }}','approve-product-{{ $employee->employee_id }}'])" @if(in_array('add-product', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="add-product-{{ $employee->employee_id }}">Add Product</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="edit-product-{{ $employee->employee_id }}" name="edit_product" value="edit-product" onchange="setRequired('view-product-{{ $employee->employee_id }}','edit-product-{{ $employee->employee_id }}',['add-product-{{ $employee->employee_id }}','edit-product-{{ $employee->employee_id }}','delete-product-{{ $employee->employee_id }}','approve-product-{{ $employee->employee_id }}'])"  @if(in_array('edit-product', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="edit-product-{{ $employee->employee_id }}">Edit Product</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="approve-product-{{ $employee->employee_id }}" name="approve_product" value="approve-product"  onchange="setRequired('view-product-{{ $employee->employee_id }}','approve-product-{{ $employee->employee_id }}',['add-product-{{ $employee->employee_id }}','edit-product-{{ $employee->employee_id }}','delete-product-{{ $employee->employee_id }}','approve-product-{{ $employee->employee_id }}'])"  @if(in_array('approve-product', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="approve-product-{{ $employee->employee_id }}">Active/De-active Product</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="delete-product-{{ $employee->employee_id }}" name="delete_product" value="delete-product"  onchange="setRequired('view-product-{{ $employee->employee_id }}','delete-product-{{ $employee->employee_id }}',['add-product-{{ $employee->employee_id }}','edit-product-{{ $employee->employee_id }}','delete-product-{{ $employee->employee_id }}','approve-product-{{ $employee->employee_id }}'])" @if(in_array('delete-product', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="delete-product-{{ $employee->employee_id }}">Delete Product</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-3">
                                                            <h6 class="">Sells</h6>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="view-sell-{{ $employee->employee_id }}" name="view_sell" value="view-sell" onchange="removeOptions('view-sell-{{ $employee->employee_id }}',['add-sell-{{ $employee->employee_id }}','edit-sell-{{ $employee->employee_id }}','delete-sell-{{ $employee->employee_id }}'])" @if(in_array('view-sell', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="view-sell-{{ $employee->employee_id }}">View Sell</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="add-sell-{{ $employee->employee_id }}" name="add_sell" value="add-sell" onchange="setRequired('view-sell-{{ $employee->employee_id }}','add-sell-{{ $employee->employee_id }}',['add-sell-{{ $employee->employee_id }}','edit-sell-{{ $employee->employee_id }}','delete-sell-{{ $employee->employee_id }}'])" @if(in_array('add-sell', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="add-sell-{{ $employee->employee_id }}">Add Sell</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="edit-sell-{{ $employee->employee_id }}" name="edit_sell" value="edit-sell" onchange="setRequired('view-sell-{{ $employee->employee_id }}','edit-sell-{{ $employee->employee_id }}',['add-sell-{{ $employee->employee_id }}','edit-sell-{{ $employee->employee_id }}','delete-sell-{{ $employee->employee_id }}'])" @if(in_array('edit-sell', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="edit-sell-{{ $employee->employee_id }}">Edit Sell</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="delete-sell-{{ $employee->employee_id }}" name="delete_sell" value="delete-sell"  onchange="setRequired('view-sell-{{ $employee->employee_id }}','delete-sell-{{ $employee->employee_id }}',['add-sell-{{ $employee->employee_id }}','edit-sell-{{ $employee->employee_id }}','delete-sell-{{ $employee->employee_id }}'])" @if(in_array('delete-sell', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="delete-sell-{{ $employee->employee_id }}">Delete Sell</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-3">
                                                            <h6 class="">Orders</h6>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="view-order-{{ $employee->employee_id }}" name="view_order" value="view-order" onchange="removeOptions('view-order-{{ $employee->employee_id }}',['add-order-{{ $employee->employee_id }}','edit-order-{{ $employee->employee_id }}','delete-order-{{ $employee->employee_id }}','manage-order-{{ $employee->employee_id }}'])" @if(in_array('view-order', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="view-order-{{ $employee->employee_id }}">View Order</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="add-order-{{ $employee->employee_id }}" name="add_order" value="add-order" onchange="setRequired('view-order-{{ $employee->employee_id }}','add-order-{{ $employee->employee_id }}',['add-order-{{ $employee->employee_id }}','edit-order-{{ $employee->employee_id }}','delete-order-{{ $employee->employee_id }}','manage-order-{{ $employee->employee_id }}'])"  @if(in_array('add-order', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="add-order-{{ $employee->employee_id }}">Add Order</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="edit-order-{{ $employee->employee_id }}" name="edit_order" value="edit-order" onchange="setRequired('view-order-{{ $employee->employee_id }}','edit-order-{{ $employee->employee_id }}',['add-order-{{ $employee->employee_id }}','edit-order-{{ $employee->employee_id }}','delete-order-{{ $employee->employee_id }}','manage-order-{{ $employee->employee_id }}'])"  @if(in_array('edit-order', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="edit-order-{{ $employee->employee_id }}">Edit Order</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="manage-order-{{ $employee->employee_id }}" name="manage_order" value="manage-order" onchange="setRequired('view-order-{{ $employee->employee_id }}','manage-order-{{ $employee->employee_id }}',['add-order-{{ $employee->employee_id }}','edit-order-{{ $employee->employee_id }}','delete-order-{{ $employee->employee_id }}','manage-order-{{ $employee->employee_id }}'])"  @if(in_array('manage-order', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="manage-order-{{ $employee->employee_id }}">Manage Order</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="delete-order-{{ $employee->employee_id }}" name="delete_order" value="delete-order"  onchange="setRequired('view-order-{{ $employee->employee_id }}','delete-order-{{ $employee->employee_id }}',['add-order-{{ $employee->employee_id }}','edit-order-{{ $employee->employee_id }}','delete-order-{{ $employee->employee_id }}','manage-order-{{ $employee->employee_id }}'])"  @if(in_array('delete-order', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="delete-order-{{ $employee->employee_id }}">Delete Order</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-3">
                                                            <h6 class="">Customers</h6>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="view-customer-{{ $employee->employee_id }}" name="view_customer" value="view-customer" onchange="removeOptions('view-customer-{{ $employee->employee_id }}',['add-customer-{{ $employee->employee_id }}','edit-customer-{{ $employee->employee_id }}','delete-customer-{{ $employee->employee_id }}'])"  @if(in_array('view-customer', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="view-customer-{{ $employee->employee_id }}">View Customer</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="add-customer-{{ $employee->employee_id }}" name="add_customer" value="add-customer" onchange="setRequired('view-customer-{{ $employee->employee_id }}','add-customer-{{ $employee->employee_id }}',['add-customer-{{ $employee->employee_id }}','edit-customer-{{ $employee->employee_id }}','delete-customer-{{ $employee->employee_id }}'])"  @if(in_array('add-customer', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="add-customer-{{ $employee->employee_id }}">Add Customer</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="edit-customer-{{ $employee->employee_id }}" name="edit_customer" value="edit-customer" onchange="setRequired('view-customer-{{ $employee->employee_id }}','edit-customer-{{ $employee->employee_id }}',['add-customer-{{ $employee->employee_id }}','edit-customer-{{ $employee->employee_id }}','delete-customer-{{ $employee->employee_id }}'])"  @if(in_array('edit-customer', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="edit-customer-{{ $employee->employee_id }}">Edit Customer</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="delete-customer-{{ $employee->employee_id }}" name="delete_customer" value="delete-customer"  onchange="setRequired('view-customer-{{ $employee->employee_id }}','delete-customer-{{ $employee->employee_id }}',['add-customer-{{ $employee->employee_id }}','edit-customer-{{ $employee->employee_id }}','delete-customer-{{ $employee->employee_id }}'])"  @if(in_array('delete-customer', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="delete-customer-{{ $employee->employee_id }}">Delete Customer</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-3">
                                                            <h6 class="">Employees</h6>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="view-employee-{{ $employee->employee_id }}" name="view_employee" value="view-employee" onchange="removeOptions('view-employee-{{ $employee->employee_id }}',['add-employee-{{ $employee->employee_id }}','edit-employee-{{ $employee->employee_id }}','delete-employee-{{ $employee->employee_id }}','approve-employee-{{ $employee->employee_id }}'])"   @if(in_array('view-employee', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="view-employee-{{ $employee->employee_id }}">View Employee</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="add-employee-{{ $employee->employee_id }}" name="add_employee" value="add-employee" onchange="setRequired('view-employee-{{ $employee->employee_id }}','add-employee-{{ $employee->employee_id }}',['add-employee-{{ $employee->employee_id }}','edit-employee-{{ $employee->employee_id }}','delete-employee-{{ $employee->employee_id }}','approve-employee-{{ $employee->employee_id }}'])" @if(in_array('add-employee', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="add-employee-{{ $employee->employee_id }}">Add Employee</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="edit-employee-{{ $employee->employee_id }}" name="edit_employee" value="edit-employee" onchange="setRequired('view-employee-{{ $employee->employee_id }}','edit-employee-{{ $employee->employee_id }}',['add-employee-{{ $employee->employee_id }}','edit-employee-{{ $employee->employee_id }}','delete-employee-{{ $employee->employee_id }}','approve-employee-{{ $employee->employee_id }}'])" @if(in_array('edit-employee', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="edit-employee-{{ $employee->employee_id }}">Edit Employee</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="approve-employee-{{ $employee->employee_id }}" name="approve_employee" value="approve-employee"  onchange="setRequired('view-employee-{{ $employee->employee_id }}','approve-employee-{{ $employee->employee_id }}',['add-employee-{{ $employee->employee_id }}','edit-employee-{{ $employee->employee_id }}','delete-employee-{{ $employee->employee_id }}','approve-employee-{{ $employee->employee_id }}'])" @if(in_array('approve-employee', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="approve-employee-{{ $employee->employee_id }}">Active/De-active Employee</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="delete-employee-{{ $employee->employee_id }}" name="delete_employee" value="delete-employee"  onchange="setRequired('view-employee-{{ $employee->employee_id }}','delete-employee-{{ $employee->employee_id }}',['add-employee-{{ $employee->employee_id }}','edit-employee-{{ $employee->employee_id }}','delete-employee-{{ $employee->employee_id }}','approve-employee-{{ $employee->employee_id }}'])" @if(in_array('delete-employee', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="delete-employee-{{ $employee->employee_id }}">Delete Employee</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-3">
                                                            <h6 class="">Website Carts</h6>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="view-cart-{{ $employee->employee_id }}" name="view_cart" value="view-cart" onchange="removeOptions('view-cart-{{ $employee->employee_id }}',['add-cart-{{ $employee->employee_id }}','edit-cart-{{ $employee->employee_id }}','delete-cart-{{ $employee->employee_id }}'])" @if(in_array('view-cart', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="view-cart-{{ $employee->employee_id }}">View cart</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="add-cart-{{ $employee->employee_id }}" name="add_cart" value="add-cart" onchange="setRequired('view-cart-{{ $employee->employee_id }}','add-cart-{{ $employee->employee_id }}',['add-cart-{{ $employee->employee_id }}','edit-cart-{{ $employee->employee_id }}','delete-cart-{{ $employee->employee_id }}'])"  @if(in_array('add-cart', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="add-cart-{{ $employee->employee_id }}">Add cart</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="edit-cart-{{ $employee->employee_id }}" name="edit_cart" value="edit-cart" onchange="setRequired('view-cart-{{ $employee->employee_id }}','edit-cart-{{ $employee->employee_id }}',['add-cart-{{ $employee->employee_id }}','edit-cart-{{ $employee->employee_id }}','delete-cart-{{ $employee->employee_id }}'])"  @if(in_array('edit-cart', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="edit-cart-{{ $employee->employee_id }}">Edit cart</label>
                                                            </div>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="delete-cart-{{ $employee->employee_id }}" name="delete_cart" value="delete-cart"  onchange="setRequired('view-cart-{{ $employee->employee_id }}','delete-cart-{{ $employee->employee_id }}',['add-cart-{{ $employee->employee_id }}','edit-cart-{{ $employee->employee_id }}','delete-cart-{{ $employee->employee_id }}'])"  @if(in_array('delete-cart', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="delete-cart-{{ $employee->employee_id }}">Delete cart</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-3">
                                                            <h6 class="">Website Settings</h6>
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox" id="site-setting-{{ $employee->employee_id }}" name="site_setting" value="site-setting"   @if(in_array('site-setting', json_decode($employee->permissions))) checked="true" @endif>
                                                                <label class="form-check-label" for="site-setting-{{ $employee->employee_id }}">Site Setting</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="submit" class="btn btn-warning col-12" value="Update Employee">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--            end edit customer modal--}}
                        @endif
                    @endforeach
                </tbody>
            </table>
        @else
            <h6 class="d-inline-flex mt-3 ms-3 ">Something went wrong...! Please refresh page now&nbsp;</h6>
            <a class="btn btn-warning d-inline-flex mt-0 mt-lg-3 ms-3 ms-lg-0" href="{{ route('dashboard', ['state' => 'employees']) }}">Refresh</a>
        @endif
    </div>
</div>

<script defer="defer">
    function setRequired(requirer_id,this_id,option_ids){
        if(document.getElementById(this_id).checked){
            document.getElementById(requirer_id).checked=true;
        }else{
            for(let index = 0; index< option_ids.length; index++){
                if(document.getElementById(option_ids[index]).checked){
                    option_checked = true;
                    document.getElementById(requirer_id).checked=true;
                }
            }
        }
    }
    function removeOptions(this_id,option_ids){
        if(document.getElementById(this_id).checked == false){
            for(let index = 0; index< option_ids.length; index++){
                document.getElementById(option_ids[index]).checked = false;
            }
        }
    }
</script>
