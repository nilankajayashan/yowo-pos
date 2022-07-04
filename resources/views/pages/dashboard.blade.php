<div class="m-0">
 <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px;">
     @if(isset($out_of_stocks) && count($out_of_stocks)>0)
         <button type="button" class="btn btn-warning mt-0 ms-0 rounded-0" style="border-bottom-left-radius: 50% !important; border-bottom-right-radius: 50% !important;" data-bs-toggle="modal" data-bs-target="#stockwarningmodal" id="stockwarning">
             <i class="fas fa-cubes"></i>
         </button>
     @endif
     <a type="button" class="btn btn-warning mt-0 ms-0 rounded-0" style="border-bottom-left-radius: 50% !important; border-bottom-right-radius: 50% !important;" href="{{ route('dashboard', ['state' => 'add_bill']) }}">
         <i class="fa fa-cash-register " aria-hidden="true"></i>
     </a>
 </div>
    <div class="row position-relative text-center m-0" style="margin-top: -40px !important;">
        <div class="col-lg-3 m-0">
            <div class="card ms-5 me-5 bg-success text-light p-2">
                <div class=""><span class="">Total Web Orders </span><i class="fa fa-cart-arrow-down bg-dark p-2 rounded-circle" aria-hidden="true"></i></div>
                <div class="card-body p-0"><h4>@if(isset($order_count)){{ $order_count }} @else 0 @endif</h4></div>
            </div>
        </div>
        <div class="col-lg-3 m-0">
            <div class="card ms-5 me-5 bg-primary p-2 text-light">
                <div class=""><span class="">Total Shop Sales </span><i class="fa fa-cash-register bg-dark p-2 rounded-circle" aria-hidden="true"></i></div>
                <div class="card-body p-0"><h4>@if(isset($sells_count)){{ $sells_count }} @else 0 @endif</h4></div>
            </div>
        </div>
        <div class="col-lg-3 m-0">
            <div class="card ms-5 me-5 bg-info p-2 text-light">
                <div class=""><span class="">Total Customers </span><i class="fa fa-users bg-dark p-2 rounded-circle" aria-hidden="true"></i></div>
                <div class="card-body p-0"><h4>@if(isset($user_count)){{ $user_count }} @else 0 @endif</h4></div>
            </div>
        </div>
        <div class="col-lg-3 m-0">
            <div class="card ms-5 me-5 bg-warning p-2 text-light">
                <div class=""><span class="">Total Products </span><i class="fa fa-shopping-bag bg-dark p-2 rounded-circle" aria-hidden="true"></i></div>
                <div class="card-body p-0"><h4>@if(isset($product_count)){{ $product_count }} @else 0 @endif</h4></div>
            </div>
        </div>
    </div>
</div>
<div class="ps-3 pe-3">
    <div class="row mt-3 mb-3">
        <div class="col-lg-4">
            <h6>Web Orders</h6>
            <canvas id="orderStatusChart" width="400" height="400"></canvas>
        </div>
        <div class="col-lg-4">
            <h6>Web Payment</h6>
            <canvas id="paymentStatusChart" width="400" height="400"></canvas>
        </div>
        <div class="col-lg-4">
            <h6>Shop Vs Web Orders & Payment</h6>
            <canvas id="shopWebAnalyseChart" width="400" height="400"></canvas>
        </div>
    </div>
    <canvas id="yearOrderChart" class="bg-success mt-0" width="" height="0"></canvas>

</div>

<?php
function getColor($class){
    switch ($class){
        case 'btn-primary':
            return '#1266F1';
            break;
        case 'btn-secondary':
            return '#B23CFD';
            break;
        case 'btn-danger':
            return '#F93154';
            break;
        case 'btn-warning':
            return '#FFA900';
            break;
        case 'btn-info':
            return '#39C0ED';
            break;
        case 'btn-success':
            return '#00B74A';
            break;
        case 'btn-light':
            return '#FBFBFB';
            break;
        case 'btn-dark':
            return '#262626';
            break;
        default:
            return '#FFA900';
            break;
    }
    return '#FFA900';
}
?>
<?php
$pending = 0;
$processing = 0;
$processed = 0;
$shipped = 0;
$completed = 0;
$failed = 0;
?>
@if(isset($orders))
    @foreach($orders as $order)
        @switch(lcfirst($order->order_status))
            @case('pending')
            <?php $pending++; ?>
            @break
            @case('processing')
            <?php $processing++; ?>
            @break
            @case('processed')
            <?php $processed++; ?>
            @break
            @case('shipped')
            <?php $shipped++; ?>
            @break
            @case('completed')
            <?php $completed++; ?>
            @break
            @case('failed')
            <?php $failed++; ?>
            @break
        @endswitch
    @endforeach
@endif

<script>
    const ctx1 = document.getElementById('orderStatusChart');
    const orderStatusChart = new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Pending','Processing','Processed','Shipped','Completed','Failed'],
            datasets: [{
                label: 'Orders',
                data: [
                    <?php echo $pending; ?>,
                    <?php echo $processing; ?>,
                    <?php echo $processed; ?>,
                    <?php echo $shipped; ?>,
                    <?php echo $completed; ?>,
                    <?php echo $failed; ?>,
                ],
                backgroundColor: [
                    <?php  echo isset($pending_status_color)?"'".getColor($pending_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($processing_status_color)?"'".getColor($processing_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($processed_status_color)?"'".getColor($processed_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($shipped_status_color)?"'".getColor($shipped_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($completed_status_color)?"'".getColor($completed_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($failed_status_color)?"'".getColor($failed_status_color)."'":'#FFA900' ?>,
                ],
                hoverOffset: 4
            }]
        }
    });
</script>

<?php
$pending = 0;
$success = 0;
$failed = 0;
?>
@if(isset($orders))
    @foreach($orders as $order)
        @switch(lcfirst($order->payment_status))
            @case('success')
            <?php $success++; ?>
            @break
            @case('pending')
            <?php $pending++; ?>
            @break
            @case('failed')
            <?php $failed++; ?>
            @break
        @endswitch
    @endforeach
@endif
<script>
    const ctx2 = document.getElementById('paymentStatusChart');
    const paymentStatusChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: [
                'Pending',
                'Success',
                'Failed',
            ],
            datasets: [{
                label: 'Payments',
                data: [
                    <?php echo $pending; ?>,
                    <?php echo $success; ?>,
                    <?php echo $failed; ?>,
                ],
                backgroundColor: [
                    <?php  echo isset($pending_status_color)?"'".getColor($pending_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($success_status_color)?"'".getColor($success_status_color)."'":'#FFA900' ?>,
                    <?php  echo isset($failed_status_color)?"'".getColor($failed_status_color)."'":'#FFA900' ?>,
                ],
                hoverOffset: 4
            }]
        }
    });
</script>

<?php
$web_order_pending = 0;
$web_order_processing = 0;
$web_order_processed = 0;
$web_order_shipped = 0;
$web_order_completed = 0;
$web_order_failed = 0;
?>
    @if(isset($orders))
        @foreach($orders as $order)
            @switch(lcfirst($order->order_status))
                @case('pending')
                <?php $web_order_pending++; ?>
                @break
                @case('processing')
                <?php $web_order_processing++; ?>
                @break
                @case('processed')
                <?php $web_order_processed++; ?>
                @break
                @case('shipped')
                <?php $web_order_shipped++; ?>
                @break
                @case('completed')
                <?php $web_order_completed++; ?>
                @break
                @case('failed')
                <?php $web_order_failed++; ?>
                @break
            @endswitch
        @endforeach
    @endif
<?php
$web_payment_pending = 0;
$web_payment_success = 0;
$web_payment_failed = 0;
?>
@if(isset($orders))
    @foreach($orders as $order)
        @switch(lcfirst($order->payment_status))
            @case('success')
            <?php $web_payment_success++; ?>
            @break
            @case('pending')
            <?php $web_payment_pending++; ?>
            @break
            @case('failed')
            <?php $web_payment_failed++; ?>
            @break
        @endswitch
    @endforeach
@endif
<script>
    const ctx4 = document.getElementById('shopWebAnalyseChart');
    const shopWebAnalyseChart = new Chart(ctx4, {
        type: 'line',
        data: {
            labels: ['Pending','Processing','Processed','Shipped','Completed','Failed','Success'],
            datasets: [{
                label: 'Web Orders',
                data: [
                    <?php echo $web_payment_pending; ?>,
                    <?php echo $web_order_processing; ?>,
                    <?php echo $web_order_processed; ?>,
                    <?php echo $web_order_shipped; ?>,
                    <?php echo $web_order_completed; ?>,
                    <?php echo $web_order_failed; ?>,
                    0,
                ],
                fill: true,
                backgroundColor: '#ffbb33',
                borderColor: '#FF8800',
                pointBackgroundColor: '#ffbb33',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#ffbb33',
                pointHoverBorderColor: '#FF8800'
            },{
                label: 'Web Payments',
                data: [
                    <?php echo $web_payment_pending; ?>,
                    0,0,0,0,
                    <?php echo $web_payment_failed; ?>,
                    <?php echo $web_payment_success; ?>,
                ],
                fill: true,
                backgroundColor: '#00C851',
                borderColor: '#007E33',
                pointBackgroundColor: '#00C851',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#00C851',
                pointHoverBorderColor: '#007E33'
            },
                {
                    label: 'Shop Sales',
                    data: [0,0,0,0,0,0,
                        <?php if (isset($sells_count)) echo $sells_count;?>,
                    ],
                    fill: true,
                    backgroundColor: '#33b5e5',
                    borderColor: '#0099CC',
                    pointBackgroundColor: '#33b5e5',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#33b5e5',
                    pointHoverBorderColor: '#0099CC'
                },
                {
                    label: 'Shop Incomes',
                    data: [0,0,0,0,0,0,
                        <?php if (isset($sells_count))echo $sells_count; ?>,
                    ],
                    fill: true,
                    backgroundColor: '#ff4444',
                    borderColor: '#CC0000',
                    pointBackgroundColor: '#ff4444',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#ff4444',
                    pointHoverBorderColor: '#CC0000'
                }

            ]
        }
    });
</script>




<?php
$january = 0;
$february = 0;
$march = 0;
$april = 0;
$may = 0;
$june = 0;
$july = 0;
$august = 0;
$september = 0;
$october = 0;
$november = 0;
$december = 0;
?>
@if(isset($orders))
    @foreach($orders as $order)
        @switch(lcfirst(date_format($order->created_at, 'm')))
            @case('01')
            <?php $january++; ?>
            @break
            @case('02')
            <?php $february++; ?>
            @break
            @case('03')
            <?php $march++; ?>
            @break
            @case('04')
            <?php $april++; ?>
            @break
            @case('05')
            <?php $may++; ?>
            @break
            @case('06')
            <?php $june++; ?>
            @break
            @case('07')
            <?php $july++; ?>
            @break
            @case('08')
            <?php $august++; ?>
            @break
            @case('09')
            <?php $september++; ?>
            @break
            @case('10')
            <?php $october++; ?>
            @break
            @case('11')
            <?php $november++; ?>
            @break
            @case('12')
            <?php $december++; ?>
            @break
        @endswitch
    @endforeach
@endif
<?php
$sales_january = 0;
$sales_february = 0;
$sales_march = 0;
$sales_april = 0;
$sales_may = 0;
$sales_june = 0;
$sales_july = 0;
$sales_august = 0;
$sales_september = 0;
$sales_october = 0;
$sales_november = 0;
$sales_december = 0;
?>
@if(isset($sales))
    @foreach($sales as $sale)
        @switch(lcfirst(date_format($sale->created_at, 'm')))
            @case('01')
            <?php $sales_january++; ?>
            @break
            @case('02')
            <?php $sales_february++; ?>
            @break
            @case('03')
            <?php $sales_march++; ?>
            @break
            @case('04')
            <?php $sales_april++; ?>
            @break
            @case('05')
            <?php $sales_may++; ?>
            @break
            @case('06')
            <?php $sales_june++; ?>
            @break
            @case('07')
            <?php $sales_july++; ?>
            @break
            @case('08')
            <?php $sales_august++; ?>
            @break
            @case('09')
            <?php $sales_september++; ?>
            @break
            @case('10')
            <?php $sales_october++; ?>
            @break
            @case('11')
            <?php $sales_november++; ?>
            @break
            @case('12')
            <?php $sales_december++; ?>
            @break
        @endswitch
    @endforeach

@endif
<div class="d-flex justify-content-center">
    <div class="w-100 p-5 text-center">
        <h5>{{  date("Y") }}&nbsp;Web Orders Vs Shop Sales</h5>
        <canvas id="orderYearChart" width="1000" height="500"></canvas>
    </div>
</div>
<script>
    const ctx3 = document.getElementById('orderYearChart').getContext('2d');
    const myChart3 = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December',
            ],
            datasets: [{
                label: 'Web Orders',
                data: [
                    <?php echo $january; ?>,
                    <?php echo $february; ?>,
                    <?php echo $march; ?>,
                    <?php echo $april; ?>,
                    <?php echo $may; ?>,
                    <?php echo $june; ?>,
                    <?php echo $july; ?>,
                    <?php echo $august; ?>,
                    <?php echo $september; ?>,
                    <?php echo $october; ?>,
                    <?php echo $november; ?>,
                    <?php echo $december; ?>,
                ],
                fill: false,
                borderColor: '#ffc107',
                tension: 0.1
            },
                {
                    label: 'Shop Sales',
                    data: [
                        <?php echo $sales_january; ?>,
                        <?php echo $sales_february; ?>,
                        <?php echo $sales_march; ?>,
                        <?php echo $sales_april; ?>,
                        <?php echo $sales_may; ?>,
                        <?php echo $sales_june; ?>,
                        <?php echo $sales_july; ?>,
                        <?php echo $sales_august; ?>,
                        <?php echo $sales_september; ?>,
                        <?php echo $sales_october; ?>,
                        <?php echo $sales_november; ?>,
                        <?php echo $sales_december; ?>,
                    ],
                    fill: false,
                    borderColor: '#39C0ED',
                    tension: 0.1
                }
            ]
        },
        options: {
            transitions: {
                show: {
                    animations: {
                        x: {
                            from: 0
                        },
                        y: {
                            from: 0
                        }
                    }
                },
                hide: {
                    animations: {
                        x: {
                            to: 0
                        },
                        y: {
                            to: 0
                        }
                    }
                }
            }
        }

    });
</script>
@if(isset($out_of_stocks) && count($out_of_stocks)>0)
<!-- Button trigger modal -->

<div class="modal fade" id="stockwarningmodal" tabindex="-1" aria-labelledby="stockwarningmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content  bg-transparent border-0">
            <div class="modal-body">
                <button type="button" class="btn-close bg-danger float-end mt-1 me-1" data-bs-dismiss="modal" aria-label="Close"></button>
                <h6 class="text-light bg-dark p-3 rounded">{{ count($out_of_stocks) }}&nbsp;PRODUCTS REACH TO OUT OF STOCKS</h6>
                <div class="mt-2">
                    @foreach($out_of_stocks as $out_of_stock)
                        <div class="card bg-white p-2 mb-2">
                            <div class="row">
                                <img src="{{ asset('product_images/'.$out_of_stock->product_id.'/'.json_decode($out_of_stock->main_image))  }}" alt="" class="col-4 d-inline">
                                <div class="col-8 d-inline">
                                    <h6>Product ID: {{ $out_of_stock->product_id }}</h6>
                                    <h6>Product Name: {{ ucwords($out_of_stock->name) }}</h6>
                                    <h6>Only Available:&nbsp;<span class="badge rounded-pill @if($out_of_stock->quantity < 3) bg-danger @else bg-primary @endif fs-6"> @if($out_of_stock->quantity > 0){{ $out_of_stock->quantity }} @else Out Of Stock @endif</span></h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        document.getElementById('stockwarning').click();


</script>
    @endif
