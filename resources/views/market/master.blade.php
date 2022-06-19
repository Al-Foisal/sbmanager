<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('backend/fontawesome-free/css/all.min.css') }}">
    @yield('css')
</head>

<body>

    @yield('content')

    <div class="content-fluide">
        <footer class="fixed-bottom bg-info">
            <div class="row text-center" style="padding: 10px 0">
                <div class="col-6">
                    <a href="{{ route('onlineMarket') }}">
                        <i class="fas fa-home" style="font-size: 30px;color:white;"></i>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('cartProduct') }}">
                        <i class="fas fa-shopping-cart" style="font-size: 30px;color:white;"></i>
                    </a>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    @yield('js')
</body>

</html>
