<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="SSLCommerz">
    <title>Example - Hosted Checkout | SSLCommerz</title>

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

        <div class="row">
            <div class="col-md-12 order-md-1">
                <h4 class="mb-3">Payment Information</h4>
                <form action="{{ url('/pay') }}" method="POST" class="needs-validation">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <input type="hidden" name="link" value="{{ $consumer->link }}">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="firstName">Full name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ $consumer->name ?? '' }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mobile">Mobile</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+88</span>
                            </div>
                            <input type="text" name="phone" class="form-control" id="mobile"
                                placeholder="01711xxxxxx" value="{{ $consumer->phone ?? '' }}" required>
                        </div>
                    </div>



                    <div class="mb-3">
                        <label for="">Amount</label>
                        <input type="number" name="amount" class="form-control" id=""
                            value="{{ $consumer->amount ?? '' }}" readonly required>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="you@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St"
                            name="address" required>
                    </div>

                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout
                        (Hosted)</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2019 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
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
