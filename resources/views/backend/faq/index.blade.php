@extends('backend.layouts.master')
@section('title', 'FAQ')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Main FAQ List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
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
                            <a href="{{ route('admin.faqs.create') }}" class="btn btn-outline-primary">Add FAQ</a>
                            <br>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Name</th>
                                        <th>Details</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faq as $item)
                                        <tr>
                                            <td class="d-flex justify-content-between">

                                                <a class="btn btn-info"
                                                    href="{{ route('admin.faqs.edit', $item) }}">Edit</a>
                                                <form action="{{ route('admin.faqs.destroy', $item) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                </form>
                                            </td>

                                            <td>{{ $item->name }} </td>
                                            @if ($item->video)
                                                <td>
                                                    <video style="height: 200px;width:400px;" controls preload="auto" autoplay loop muted>
                                                        <source src="{{ asset($item->video) }}" type='video/mp4'>
                                                    </video>
                                                </td>
                                            @else
                                                <td>{{ \Illuminate\Support\Str::words(strip_tags($item->details), 10, '...') }}
                                                </td>
                                            @endif
                                            <td>{{ $item->created_at }}</td>
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
