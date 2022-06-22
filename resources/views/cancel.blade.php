<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="SSLCommerz">
    <title>Cancel</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body class="bg-light">
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="container">
        <div class="container">
            <div class="py-5 text-center">
                <img src="{{ asset($shop->image) }}" style="height:70px;width:70px;">
                <h2>{{ $shop->name }}</h2>
                <p class="lead">
                    {{ $shop->address }}
                </p>
                <p class="lead">
                    {{ $shop->phone }}
                </p>
            </div>
        </div>

        <div class="py-5 text-center">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Payment Status: {{ $payment_status }}</h4>
                <p>{{ $tran_state }}</p>
                <br>
                @if ($online_market === true)
                    <a href="{{ route('customer.login') }}" class="btn btn-light btn-sm">Go To Shop</a>
                    <a href="{{ route('onlineMarket', ['shop_id'=>$shop->id]) }}" class="btn btn-light btn-sm">Continue
                        Shopping</a>
                @endif
            </div>
        </div>

        <footer class="my-5 text-muted text-center text-small">
            <p class="mb-1">&copy; {{ date("Y") }} {{ config('app.name') }}</p>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

</html>
