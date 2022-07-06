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
                        <div class="card-header bg-success">
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
            </div>
        </div>
    </section>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Expense Book</h4>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('customer.expense.expenseBookList') }}" class="btn btn-light">Expense Lists</a>
                    <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Add New Expense</button>
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
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Expense Book Name</th>
                                        <th>Total Expenses</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td style="vertical-align: middle;">
                                                <img src="{{ asset($expense->image ?? 'images/demo.png') }}" alt="">
                                            </td>
                                            <td>{{ $expense->name }}</td>
                                            @php
                                                $amount = 0;
                                                $amount = DB::table('expense_book_details')
                                                    ->where('expense_book_id', $expense->id)
                                                    ->where('shop_id', SID())
                                                    ->whereYear('created_at','=', now())
                                                    ->whereMonth('created_at','=', now())
                                                    ->select('amount')
                                                    ->sum('amount');
                                            @endphp
                                            <td style="vertical-align: middle;">৳
                                                {{ number_format($amount, 2) }}</td>
                                            <td style="vertical-align: middle;text-align:center;">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('customer.expense.createExpenseBookList', Crypt::encryptString($expense->id)) }}">Expence
                                                            List</a>
                                                        @if ($expense->shop_id !== null)
                                                            <a class="dropdown-item"
                                                                href="{{ route('customer.expense.editExpenseBook', Crypt::encryptString($expense->id)) }}">Edit</a>
                                                            <form
                                                                action="{{ route('customer.expense.deleteExpenseBook', $expense) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="dropdown-item" type="submit"
                                                                    onclick="return(confirm('Are you sure want to delete this item?'))">Delete</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
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

