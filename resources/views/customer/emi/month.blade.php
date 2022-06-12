@extends('customer.layouts.master')
@section('title', 'Add EMI')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add EMI</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach ($emi_time as $emi)
                    @php
                        $paid_amount = 0;
                        $emi_amount = 0;
                        
                        $extra = ($request['amount'] * $emi->emi_parcentage) / 100;
                        $paid_amount = $request['amount'] + $extra;
                        $emi_amount=$paid_amount/$emi->emi_month;
                    @endphp
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <form action="{{ route('customer.emi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <input type="hidden" name="name" value="{{ $request['name'] }}">
                                    <input type="hidden" name="phone" value="{{ $request['phone'] }}">
                                    <input type="hidden" name="address" value="{{ $request['address'] }}">
                                    <input type="hidden" name="amount" value="{{ $request['amount'] }}">
                                    <input type="hidden" name="bank_id" value="{{ $request['bank_id'] }}">
                                    <input type="hidden" name="emi_month" value="{{ $emi->emi_month }}">
                                    <input type="hidden" name="emi_parcentage" value="{{ $emi->emi_parcentage }}">
                                    <input type="hidden" name="emi_extra" value="{{ $extra }}">
                                    <input type="hidden" name="emi_monthly_amount" value="{{ $emi_amount }}">
                                    <input type="hidden" name="emi_paid_amount" value="{{ $paid_amount }}">

                                    <button type="submit" class="btn btn-light btn-block p-2">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <h4><b>{{ $emi->emi_month }}</b> Month of EMI </h4>
                                                <p>Total paid amount: ৳ {{ $paid_amount }}({{ $emi->emi_parcentage }}%)</p>
                                            </div>
                                            <div class="col-md-6 text-right" style="vertical-align: middle;">
                                                <h5>৳ {{ $emi_amount }}/Month</h5>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('jsScript')
    {{-- submenu dependency --}}
    <script type="text/javascript">
        $(".js-example-tags").select2({
            tags: true
        });
    </script>
@endsection
