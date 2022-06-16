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
                        <div class="card-header bg-success" style="height: 10%">
                            <p>
                            <h3>Total Balance</h3>
                            {{ date('F Y') }}
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
                            <form action="{{ route('customer.expense.expenseBookList') }}">
                            <input type="date" name="selected_date" required>
                            <button type="submit">Find</button>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <section class="content-header">
        <div class="container-fluid">
            <div class="">
                <div class="d-flex justify-content-around">
                    <a href="{{ route('customer.expense.expenseBookList', ['type' => 'all']) }}"
                        class="btn btn-light border pr-5 pl-5 @if($type === 'all') btn-dark @endif">ALL</a>
                    <a href="{{ route('customer.expense.expenseBookList', ['type' => 'today']) }}"
                        class="btn btn-light border pr-5 pl-5 @if($type === 'today') btn-dark @endif">Today</a>
                    <a href="{{ route('customer.expense.expenseBookList', ['type' => 'week']) }}"
                        class="btn btn-light border pr-5 pl-5 @if($type === 'week') btn-dark @endif">This Week</a>
                    <a href="{{ route('customer.expense.expenseBookList', ['type' => 'month']) }}"
                        class="btn btn-light border pr-5 pl-5 @if($type === 'month') btn-dark @endif">This Month</a>
                    <a href="{{ route('customer.expense.expenseBookList', ['type' => 'year']) }}"
                        class="btn btn-light border pr-5 pl-5 @if($type === 'year') btn-dark @endif">This Year</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped">

                                <tbody>
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td>
                                                {{ $expense->expenseBook->name }}
                                                <br>
                                                Reason: {{ $expense->reason }}
                                                <br>
                                                {{ $expense->created_at->format('l m Y') }}
                                            </td>
                                            <td style="vertical-align: middle;">৳
                                                {{ number_format($expense->amount, 2) }}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Create Expense Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer.expense.storeExpenseBook') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image(48x48)</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="image">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Expense Book Name</label>
                            <input type="text" class="form-control" id="exampleInputPassword1"
                                placeholder="Enter Expense Book Name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
