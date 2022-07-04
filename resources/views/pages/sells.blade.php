<div class="m-0">
    <div class="bg-dark col-12 row" style="min-height: 100px; border-bottom-right-radius: 50px;">
            <h3 class="text-warning col-lg-10">Sales</h3>
        @if(in_array( 'add-sell', json_decode($permissions)))
            <div class="col-lg-2  pt-2">
                <a href="{{ route('dashboard', ['state' => 'add_bill']) }}" class="btn btn-warning">Make Bill</a>
            </div>
        @endif
    </div>
    <div class="ps-3 pe-3 table-responsive">
        @if(isset($sells) || in_array( 'view-sell', json_decode($permissions)))
            <table class="table mt-3">
                <thead>
                <tr>
                    <th scope="col">Bill ID</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Total</th>
                    <th scope="col">Added By</th>
                    @if(in_array( 'delete-sell', json_decode($permissions))|| in_array( 'edit-sell', json_decode($permissions)))
                        <th scope="col">Actions</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($sells as $sell)
                    <tr>
                        <th scope="row">{{ $sell->bill_id }}</th>
                        <td>
                            @php $customer = 'No Customer'; @endphp
                            @foreach($users as $user)
                                @if($user->user_id == $sell->user_id)
                                    @php $customer = $user->name @endphp
                                    @break
                                @endif
                            @endforeach
                            {{ ucwords($customer) }}
                        </td>
                        <td>{{ 'Rs.'.number_format($sell->total).'/=' }}</td>
                        <td>
                            @foreach($employees as $employee)
                                @if($employee->employee_id == $sell->employee_id)
                                    {{ ucwords($employee->name) }}
                                    @break
                                @endif
                            @endforeach
                        </td>
                        @if( in_array( 'delete-sell', json_decode($permissions))|| in_array( 'edit-sell', json_decode($permissions)))
                            <td>
                                @if(in_array( 'edit-sell', json_decode($permissions)))

                                <form action="{{ route('bill-download') }}" method="post" class="d-inline-flex">
                                    @csrf
                                    <input type="hidden" name="bill_id" value="{{ $sell->bill_id }}">
                                    <button type="submit" class="btn bg-transparent"><i class="fas fa-file-pdf text-warning"></i>&nbsp;View</button>
                                </form>
                                @endif
                                @if(in_array( 'delete-sell', json_decode($permissions)))
                                <form action="{{ route('delete-bill') }}" method="post" class="d-inline-flex">
                                    @csrf
                                    <span class="d-inline-flex">|</span>
                                    <input type="hidden" name="bill_id" value="{{ $sell->bill_id }}">
                                    <button type="submit" class="bg-white border-0">
                                        <i class="fas fa-trash-alt text-danger"></i>&nbsp;Delete
                                    </button>
                                </form>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h6 class="d-inline-flex mt-3 ms-3 ">Something went wrong...! Please refresh page now&nbsp;</h6>
            <a class="btn btn-warning d-inline-flex mt-0 mt-lg-3 ms-3 ms-lg-0" href="{{ route('dashboard', ['state' => 'sell']) }}">Refresh</a>
        @endif
    </div>
</div>
