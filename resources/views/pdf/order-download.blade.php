<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YOWO | Order{{ '-'.$order->id }}</title>
    <style>
        .bg-dark {
            background-color: #343a40 !important;
        }

        a.bg-dark:hover, a.bg-dark:focus,
        button.bg-dark:hover,
        button.bg-dark:focus {
            background-color: #1d2124 !important;
        }
        .m-0 {
            margin: 0 !important;
        }

        .border {
            border: 1px solid #dee2e6 !important;
        }
        .border-1{border-width:1px!important}

        .border-dark {
            border-color: #343a40 !important;
        }
        .text-white{--bs-text-opacity:1;color:rgba(var(--bs-white-rgb),var(--bs-text-opacity))!important}
        .mt-3,
        .my-3 {
            margin-top: 1rem !important;
        }
        @media (prefers-reduced-motion: reduce) {
            .badge {
                transition: none;
            }
        }
    </style>
</head>
<body>
<div class="m-0">
    <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px; border-bottom-left-radius: 50px; margin-top: 0px !important; ">

        <h1 style="color: #fff !important; text-align: center; padding-top: 25px;">YOWO</h1>


    </div>
</div>


<h4 class="mt-3">Order ID: #{{ $order->id }}</h4>

<h4>Ordered @: {{ date_format($order->created_at, 'd-m-Y') }}</h4>

<h4 style="border-radius: 3px !important;">Status:&nbsp; <span style=" border-radius: 3px !important; padding: 5px !important; @switch($order->order_status)
    @case('pending')
        background-color:#17a2b8;
    @break
    @case('processing')
        background-color:#dc3545;
    @break
    @case('processed')
        background-color:#007bff;
    @break
    @case('shipped')
        background-color:#007bff;
    @break
    @case('completed')
        background-color:#28a745;
    @break
    @case('failed')
        background-color:#dc3545;
    @break
    @default
        background-color:#ffc107;
    @break
    @endswitch">{{ ucwords($order->order_status) }}</span></h4>
     <div style=" margin-top: 15px;margin-bottom: 15px;  border: 1px solid #ffc107;  border-radius: 10px; padding-bottom: 15px;">
         <h3 style="background-color:#ffc107; margin-top: 0px; padding: 5px;  border-top-left-radius: 10px; border-top-right-radius: 10px;"> Shipped to: </h3>
         <div style="margin-top: 1px; padding-left: 15px; text-align: left;">

             <h4 style="display: inline-flex; margin: 0px;">Name:&nbsp;</h4>
             <span style="display: inline-flex; margin: 0px;">{{ ucwords($order->shipping_name) }}</span>
             <br>
             <h4 style="display: inline-flex; margin: 0px;">Shipping Address:&nbsp;</h4>
             <span style="display: inline-flex;  margin: 0px;">{{ ucwords($order->shipping_address1).',' }}</span>

             <span style="">{{ ucwords($order->shipping_city) .' - '. $order->shipping_postal_code.',' }}</span>

             <span >{{ ucwords($order->shipping_district).','}}</span>

             <span>{{ ucwords($order->shipping_country).','}}</span>
             <br>
             @if($order->shipping_address2 != null)
                 <span>OR</span>
                 <br>
                 <h4 style="display: inline-flex; margin: 0px;">Shipping Address:&nbsp;</h4>
                 <span style="display: inline-flex;  margin: 0px;">{{ ucwords($order->shipping_address2).',' }}</span>

                 <span>{{ ucwords($order->shipping_city) .' - '. $order->shipping_postal_code.',' }}</span>

                 <span>{{ ucwords($order->shipping_district).','}}</span>

                 <span>{{ ucwords($order->shipping_country).','}}</span>
                 <br>
             @endif

             <h4 style="display: inline-flex; margin: 0px;">Contact Number:&nbsp;</h4>
             <span style="display: inline-flex; margin: 0px;">{{ ucwords($order->shipping_mobile) }}</span>
             <br>
             <h4 style="display: inline-flex; margin: 0px;">Contact Email:&nbsp;</h4>
             <span style="display: inline-flex; margin: 0px;">{{ ucwords($order->shipping_email) }}</span>
             <hr style="margin-right: 15px;">
             <h4 style="display: inline-flex; margin: 0px;">Shipping Method:&nbsp;</h4>
             <span style="display: inline-flex; margin: 0px;">{{ ucwords(str_replace('_', ' ',$order->shipping_method)) }}</span>

         </div>
     </div>

     <div style=" margin-top: 15px;margin-bottom: 15px;  border: 1px solid #ffc107;  border-radius: 10px; padding-bottom: 15px;">
         <h3 style="background-color:#ffc107; margin-top: 0px; padding: 5px;  border-top-left-radius: 10px; border-top-right-radius: 10px;"> Payed by: </h3>
         <div style="margin-top: 1px; padding-left: 15px; text-align: left;">

             <h4 style="display: inline-flex; margin: 0px;">Name:&nbsp;</h4>
             <span style="display: inline-flex; margin: 0px;">{{ ucwords($order->payment_name) }}</span>
             <br>
             <h4 style="display: inline-flex; margin: 0px;">Payment Address:&nbsp;</h4>
             <span style="display: inline-flex;  margin: 0px;">{{ ucwords($order->payment_address).',' }}</span>

             <span>{{ ucwords($order->payment_city).',' }}</span>


             <span>{{ ucwords($order->payment_country).'.'}}</span>
             <br>

             <h4 style="display: inline-flex; margin: 0px;">Contact Number:&nbsp;</h4>
             <span style="display: inline-flex; margin: 0px;">{{ ucwords($order->payment_mobile) }}</span>
             <br>
             <h4 style="display: inline-flex; margin: 0px;">Contact Email:&nbsp;</h4>
             <span style="display: inline-flex; margin: 0px;">{{ ucwords($order->payment_email) }}</span>
             <hr style="margin-right: 15px;">
             <h4 style="display: inline-flex; margin: 0px;">Payment Method:&nbsp;</h4>
             <span style="display: inline-flex; margin: 0px;">@if($order->payment_method == 'cod') {{ ucwords('cash on delivery') }}@else{{ ucwords($order->payment_method) }}@endif</span>
         </div>
     </div>

{{--{{ dd(json_decode($order->cart)) }}--}}
<table style="width: 100%;">
    <thead>
    <tr style="background-color: #ffc107;">
        <th style="font-size: 18px;">Product ID</th>
        <th style="font-size: 18px;">Product Name</th>
        <th style="font-size: 18px;">Unit Price</th>
        <th style="font-size: 18px;">Quantity</th>
        <th style="font-size: 18px;">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($order->cart) as $item)

        <tr style="text-align: center; background-color:#007bff;">
            <th style="font-size: 18px;">{{ $item->product_id }}</th>
            <td style="font-size: 18px;">{{ ucwords($item->name) }}</td>
            <td style="font-size: 18px;">{{ 'Rs.'.number_format($item->unit_price).'/=' }}</td>
            <td style="font-size: 18px;">{{ $item->quantity }}</td>
            <td style="font-size: 18px; background-color:#ffc107;">{{ 'Rs.'.number_format($item->quantity * $item->unit_price).'/=' }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="4" style="text-align: right; font-size: 18px;" > Shipping Fee:</td>
        <td style="text-align: center; background-color:#ffc107;">{{ 'Rs.'.number_format($order->shipping_price).'/=' }}</td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: right; font-size: 18px;"> Order Total:</td>
        <td style="text-align: center; background-color:#28a745;">{{ 'Rs.'.number_format($order->total).'/=' }}</td>
    </tr>
    </tbody>
</table>
</body>
</html>
