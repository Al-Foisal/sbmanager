@extends('customer.layouts.master')
@section('title', SHOP()->name)
@section('cssStyle')
    <style>
        .social-btn-sp #social-links {
            margin: 0 auto;
            max-width: 500px;
        }

        .social-btn-sp #social-links ul li {
            display: inline-block;
        }

        .social-btn-sp #social-links ul li a {
            padding: 15px;
            border: 1px solid #ccc;
            margin: 1px;
            font-size: 30px;
        }

        table #social-links {
            display: inline-table;
        }

        table #social-links ul li {
            display: inline;
        }

        table #social-links ul li a {
            padding: 5px;
            border: 1px solid #ccc;
            margin: 1px;
            font-size: 15px;
            background: #e3e3ea;
        }
    </style>
@endsection
@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header mmm">
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
                                value="{{ route('payment.consumerPayment', $shop->payment_link) }}" aria-describedby="validationTooltipUsernamePrepend" readonly>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm" style="padding:1% 10% 1% 10%;margin-top:2%;"
                                data-toggle="modal" data-target="#shareLink">Share Your
                                Link</button>
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
                                            @if ($payment->link !== null)
                                                <td style="vertical-align: middle;"
                                                    onclick="copyToClipboard('{{ route('payment.consumerPayment', $payment->link) }}')">
                                                    <button class="btn btn-info btn-xs">Copy payment link</button>
                                                </td>
                                            @else
                                                <td>Payment Ok</td>
                                            @endif
                                            <td style="vertical-align: middle;">
                                                <button class="btn btn-primary btn-xs @if($payment->status=='Pending') btn-danger @endif">{{ $payment->status }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $payments->links() }}
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
    <div class="modal fade" id="shareLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share Your Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="social-btn-sp mt-3">
                        {!! $socialShare !!}
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
            copyTextarea.focus();
            copyTextarea.select();

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
