@extends('market.master')

@section('content')
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
@endsection
