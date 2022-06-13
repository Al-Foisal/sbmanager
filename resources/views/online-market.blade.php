<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <form class="row g-3">
                <div class="col-10">
                    <input type="text" id="categorys" class="form-control" list="category" placeholder="Search">
                    <datalist id="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}">
                        @endforeach
                    </datalist>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Confirm</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <p>Find what you want</p>
            @foreach ($categories as $category)
                <div class="card bg-light mb-3"
                    style="max-width: 20rem;text-align:center;margin-right:2rem;text-decoration:none;">
                    <a href="{{ route('categoryProduct', $category->slug) }}"
                        style="text-decoration:none;color:black;">
                        <div class="card-body">
                            <img src="{{ asset($category->image ?? 'images/demo.png') }}"
                                style="height:70px;width:70px">
                            <h5 class="card-title">
                                {{ $category->name }}"
                            </h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row">
            @foreach ($products as $key => $product)
                <div class="card mb-3"
                    style="max-width: 48%; @if ($key % 2 === 0) margin-right:4%; @endif">
                    <div class="row no-gutters">
                        <div class="col-md-4 mt-3 mb-3">
                            <img src="{{ asset($product->image) }}" style="height:200px;width:180px">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $product->name }}
                                </h5>
                                <p class="card-text">
                                    {{ \Illuminate\Support\Str::words(strip_tags($product->details), 10, '...') }}
                                </p>
                                <p class="card-text">
                                    <a href="{{ route('productDetails', $product->slug) }}"
                                        class="btn btn-info btn-block btn-sm" style="float: right;">View Details</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
