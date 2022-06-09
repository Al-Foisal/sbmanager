@extends('customer.layouts.master')
@section('title', SHOP()->name)

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row p-5 text-center" style="border: 1px dashed #22a25a;border-radius:15px;background: aliceblue;">
                <div class="col-12">
                    <p>How to use digital payment</p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/share.svg') }}" alt="share">
                    <p>Share payment<br>link</p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/share_2.svg') }}" alt="share">
                    <p>Ensure customer payment<br>by using payment link</p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/share_3.svg') }}" alt="share">
                    <p>Payment will add<br>your digital balance</p>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="p-3">
                    <div class="d-flex justify-content-between pb-2">
                        <h4>Your digital payment link</h4>
                        <button class="btn btn-primary pl-5 pr-5" data-toggle="modal" data-target="#exampleModal">Make
                            Payment
                            Link</button>
                    </div>
                    <div class="">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="validationTooltipUsernamePrepend">
                                    <i class="far fa-copy js-textareacopybtn"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control js-copytextarea" id="validationTooltipUsername"
                                value="Username" aria-describedby="validationTooltipUsernamePrepend">
                        </div>
                    </div>
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
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Customer Information</th>
                                        <th>Amount</th>
                                        <th>Link</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('customer.digital_payments.edit', $payment) }}"
                                                    class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('customer.digital_payments.destroy', $payment) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        onclick="return(confirm('Are you sure want to delete this item?'))"
                                                        class="btn btn-danger btn-xs"> <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                {{ $payment->name }}
                                                <br>
                                                {{ $payment->phone }}
                                                <br>
                                                {{ $payment->created_at->format('l m Y, H:i:s A') }}
                                            </td>
                                            <td style="vertical-align: middle;">{{ $payment->amount }}</td>
                                            <td style="vertical-align: middle;"
                                                onclick="copyToClipboard('{{ $payment->link }}')">
                                                <button class="btn btn-info btn-xs">Copy payment link</button>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <button class="btn btn-primary btn-xs">{{ $payment->status }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $products->links() }} --}}
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Make payment link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('customer.digital_payments.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group consumer_body">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" list="name" required>
                                        <datalist id="name">
                                            @foreach ($consumers as $consumer)
                                                <option value="{{ $consumer->name }}">{{ $consumer->name }}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone number</label>
                                        <input type="number" class="form-control" name="phone"
                                            placeholder="Enter phone number">
                                    </div>
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" class="form-control" name="amount"
                                            placeholder="Enter due amount" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsScript')

    <script></script>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

        copyTextareaBtn.addEventListener('click', function(event) {
            var copyTextarea = document.querySelector('.js-copytextarea');
            // copyTextarea.focus();
            // copyTextarea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                Toast.fire({
                    icon: 'success',
                    title: 'Payment link copyed.'
                })
            } catch (err) {
                Toast.fire({
                    icon: 'error',
                    title: 'Payment link copyed.'
                })
            }
        });

        function copyToClipboard(text) {
            const elem = document.createElement('textarea');
            elem.value = text;
            document.body.appendChild(elem);
            elem.select();
            document.execCommand('copy');

            Toast.fire({
                icon: 'success',
                title: 'Payment link copyed.'
            })
        }
    </script>

    {{-- submenu dependency --}}
    <script type="text/javascript">
        $(".js-example-tags").select2({
            tags: true
        });
    </script>
@endsection