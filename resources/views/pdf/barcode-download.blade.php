<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="wbill_idth=device-wbill_idth, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YOWO</title>
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
    <div style="text-align: center">
        <h4>QR CODE: {{ $product->product_id.' | '.$product->name }}</h4>
      {!! DNS2D::getBarcodeHTML((string) $product->product_id, 'QRCODE') !!}
        <h4>BAR CODE: {{ $product->product_id.' | '.$product->name }}</h4>
        {!! DNS1D::getBarcodeHTML((string) $product->product_id, 'C128') !!}
    </div>
</div>

</body>
</html>
