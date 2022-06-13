@extends('backend.layouts.master')
@section('title', 'Category')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Main Category List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.createCategory') }}" class="btn btn-outline-primary">Add Category</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Online?</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if ($category->status === 0)
                                                            <form action="{{ route('admin.activeCategory', $category) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit"
                                                                    onclick="return(confirm('Are you sure want to Active this item?'))">Active
                                                                    Category</button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('admin.inactiveCategory', $category) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit"
                                                                    onclick="return(confirm('Are you sure want to INACTIVE this item?'))">Inactive
                                                                    Category</button>
                                                            </form>
                                                        @endif
                                                        @if ($category->online === 0)
                                                            <form
                                                                action="{{ route('admin.setOnlineCategory', $category) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit"
                                                                    onclick="return(confirm('Are you sure want to Active this item?'))">Set
                                                                    to Online Market</button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('admin.removeOnlineCategory', $category) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit"
                                                                    onclick="return(confirm('Are you sure want to remove from online market?'))">Remove
                                                                    from Online Market</button>
                                                            </form>
                                                        @endif
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.editCategory', $category) }}">Edit</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="{{ asset($category->image ?? 'images/demo.png') }}"
                                                    style="height:50px;width:50px;">
                                            </td>
                                            <td>{{ $category->name }} <br> Sub={{ $category->subcategories_count }}</td>
                                            <td>{{ $category->is_active }}</td>
                                            <td>{{ $category->online === 1 ? 'Y' : 'N' }}</td>
                                            <td>{{ $category->created_at }}</td>
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
    <!-- /.content -->
@endsection
