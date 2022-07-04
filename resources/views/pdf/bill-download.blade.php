<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="wbill_idth=device-wbill_idth, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YOWO | Bill{{ '-'.$bill->bill_id }}</title>
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

<h4>Hello @if(isset($user) && $user->name != null){{ ucwords($user->name). ', please double check your bill'}} @else Please double check your bill @endif</h4>

<h4 class="mt-3">Bill id: #{{ $bill->bill_id }}</h4>

<h4>Completed @: {{ date_format($bill->created_at, 'd-m-Y') }}</h4>

<table style="width: 100%;">
    <thead>
    <tr style="background-color: #ffc107;">
        <th style="font-size: 18px;">Product id</th>
        <th style="font-size: 18px;">Product Name</th>
        <th style="font-size: 18px;">Unit Price</th>
        <th style="font-size: 18px;">Quantity</th>
        <th style="font-size: 18px;">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($bill->bill) as $item)

        <tr style="text-align: center; background-color:#007bff;">
            <th style="font-size: 18px;">{{ $item->product_id }}</th>
            <td style="font-size: 18px;">{{ ucwords($item->name) }}</td>
            <td style="font-size: 18px;">{{ 'Rs.'.number_format($item->unit_price).'/=' }}</td>
            <td style="font-size: 18px;">{{ $item->quantity }}</td>
            <td style="font-size: 18px; background-color:#ffc107;">{{ 'Rs.'.number_format($item->quantity * $item->unit_price).'/=' }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="4" style="text-align: right; font-size: 18px;"> Order Total:</td>
        <td style="text-align: center; background-color:#28a745;">{{ 'Rs.'.number_format($bill->total).'/=' }}</td>
    </tr>
    </tbody>
</table>
</body>
</html>
