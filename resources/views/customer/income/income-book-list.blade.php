@extends('customer.layouts.master')
@section('title', SHOP()->name)
@section('cssStyle')

@endsection
@section('backend')
    <!-- Content Header (Page header) -->


    <section class="content mmm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success d-flex justify-content-between" style="height: 10%">
                            <p class="d-flex justify-content-start">
                            <h3>Total Balance <br>{{ date('F Y') }}</h3>
                            </p>
                            <h2>
                                <b>৳ {{ number_format($total_balance, 2) }}</b>
                            </h2>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-success" style="height: 10%">
                            <p>
                            Select Date
                            </p>
                            <form action="{{ route('customer.income.expenseBookList') }}">
                            <input type="date" name="selected_date" required>
                            <button type="submit">Find</button>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Income</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($incomes as $income)
                                        <tr>
                                            <td>
                                                {{ $income->incomeBook->name }}
                                                <br>
                                                Reason: {{ $income->reason }}
                                                <br>
                                                {{ $income->created_at->format('l m Y') }}
                                            </td>
                                            <td style="vertical-align: middle;">৳
                                                {{ number_format($income->amount, 2) }}</td>
                                                <td style="vertical-align: middle;font-weight:bold">{{ $income->created_at->format('d F, Y') }} <br>{{ $income->created_at->format('H:i:s A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Income Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer.income.storeIncomeBook') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image(48x48)</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="image">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Income Book Name</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"
                                placeholder="Enter Income Book Name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
