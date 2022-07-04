<div class="m-0">
    <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px;">
        <div class="row">
            @if(in_array( 'add-category', json_decode($permissions)))
{{--            add category modal--}}
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add-category') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Category Name" required="required">
                                    @error('name')
                                    <div class="bg-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Category Description" id="description" name="description"></textarea>
                                        <label for="description">Category Description</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="parent" aria-label="Parent Category" required="required" name="parent_id">
                                            <option selected value="0">This Category is Parent</option>
                                            @if(isset($categories))
                                                @foreach($categories as $category)
                                                    @if($category->parent_id == 0)
                                                        <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <label for="parent">Select Parent Category</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="icon" placeholder="Icon Class">
                                </div>
                                <div class="mb-3 ms-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="show_menu" name="show_menu">
                                        <label class="form-check-label" for="show_menu">Show Website Menu</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-warning col-12" value="Add Category">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
{{--            end add category modal--}}
            @endif
            <h3 class="text-warning col-lg-10">Category</h3>
            @if(in_array( 'add-category', json_decode($permissions)))
            <div class="col-lg-2  pt-2">
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Category</button>
            </div>
            @endif
        </div>
    </div>
    <div class="ps-3 pe-3 table-responsive">
        @if(isset($categories) && in_array( 'view-category', json_decode($permissions)))
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">Category ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Parent</th>
                        <th scope="col">Web Menu</th>
                        <th scope="col">Status</th>
                        <th scope="col">Added By</th>
                        @if(in_array( 'approve-category', json_decode($permissions)) || in_array( 'edit-category', json_decode($permissions)) || in_array( 'delete-category', json_decode($permissions)))
                            <th scope="col">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->category_id }}</th>
                                <td>{{ ucwords($category->name) }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    @foreach($categories as $category_inner)
                                        @if($category->parent_id == $category_inner->category_id)
                                            @php $parent = $category_inner->name; @endphp
                                        @elseif($category->parent_id == 0)
                                            @php $parent = 'Main Category'; @endphp
                                        @endif
                                    @endforeach
                                    {{ ucwords($parent) }}
                                </td>
                                <td>
                                    @if($category->show_menu == 1)
                                        <h6><span class="badge bg-success">Show</span></h6>
                                    @else
                                        <h6><span class="badge bg-secondary">Hidden</span></h6>
                                    @endif
                                </td>
                                <td>
                                    @if($category->status == 1)
                                        <h6><span class="badge bg-success">Active</span></h6>
                                    @else
                                        <h6><span class="badge bg-secondary">Deactive</span></h6>
                                    @endif
                                </td>
                                <td>
                                    @foreach($employees as $employee)
                                        @if($employee->employee_id == $category->added_by)
                                            @php $added_by = $employee->name. '|' . $employee->email; @endphp
                                        @endif
                                    @endforeach
                                    {{ ucwords($added_by) }}
                                </td>
                                @if(in_array( 'approve-category', json_decode($permissions)) || in_array( 'edit-category', json_decode($permissions)) || in_array( 'delete-category', json_decode($permissions)))
                                    <td>
                                        @if(in_array( 'approve-category', json_decode($permissions)))
                                            <form action="{{ route('change-status-category') }}" method="post" class="d-inline-flex">
                                                @csrf
                                                <input type="hidden" name="category_id" value="{{ $category->category_id }}">
                                                <button type="submit" class="bg-white border-0">
                                                    @if($category->status == 0)
                                                        <i class="fas fa-check-circle text-success"></i>&nbsp;Active
                                                    @elseif($category->status == 1)
                                                        <i class="fas fa-times-circle text-danger"></i>&nbsp;Deactive
                                                    @else
                                                        <i class="fas fa-sync text-info"></i>&nbsp;Change Status
                                                    @endif
                                                </button>
                                            </form>
                                        @endif
                                        @if(in_array( 'edit-category', json_decode($permissions)))
                                            <span class="d-inline-flex">|
                                                <button class="bg-white border-0" data-bs-toggle="modal" data-bs-target="#editCategory-{{ $category->category_id }}"><i class="fas fa-edit text-primary"></i>&nbsp;Edit</button>
                                            </span>
                                        @endif
                                        @if(in_array( 'delete-category', json_decode($permissions)))
                                            <form action="{{ route('delete-category') }}" method="post" class="d-inline-flex">
                                                @csrf
                                                <input type="hidden" name="category_id" value="{{ $category->category_id }}">
                                                <span class="d-inline-flex">|</span>
                                                <button type="submit" class="bg-white border-0">
                                                    <i class="fas fa-trash-alt text-danger"></i>&nbsp;Delete
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                            @if(in_array( 'edit-category', json_decode($permissions)))
                                {{--            edit category modal--}}
                                <div class="modal fade" id="editCategory-{{ $category->category_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('edit-category') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="category_id" value="{{ $category->category_id }}">
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Category Name" required="required" value="{{ $category->name }}">
                                                        @error('name')
                                                        <div class="bg-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-floating">
                                                            <textarea class="form-control" placeholder="Category Description" id="description" name="description" value="{{ $category->description }}"></textarea>
                                                            <label for="description">Category Description</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="parent" aria-label="Parent Category" required="required" name="parent_id">
                                                                <option selected value="0">This Category is Parent</option>
                                                                @if(isset($categories))
                                                                    @foreach($categories as $category)
                                                                        @if($category->parent_id == 0)
                                                                            <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <label for="parent">Select Parent Category</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" name="icon" placeholder="Icon Class" value="{{ $category->icon }}">
                                                    </div>
                                                    <div class="mb-3 ms-4">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="show_menu" name="show_menu">
                                                            <label class="form-check-label" for="show_menu">Show Website Menu</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="submit" class="btn btn-warning col-12" value="Edit Category">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--            end add category modal--}}
                            @endif
                        @endforeach
                    </td>
                </tbody>
            </table>
        @else
            <h6 class="d-inline-flex mt-3 ms-3 ">Something went wrong...! Please refresh page now&nbsp;</h6>
            <a class="btn btn-warning d-inline-flex mt-0 mt-lg-3 ms-3 ms-lg-0" href="{{ route('dashboard', ['state' => 'categories']) }}">Refresh</a>
        @endif
    </div>
</div>
