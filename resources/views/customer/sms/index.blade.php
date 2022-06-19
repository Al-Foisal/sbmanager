@extends('customer.layouts.master')
@section('title', SHOP()->name)
@section('cssStyle')
    <style>
        .vv:hover {
            background: black;
            color: white;
        }
    </style>
@endsection
@section('backend')
    <form action="" method="">
        <section class="content-header mmm">
            <div class="container">
                <div class="row p-5">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="mphone[]" placeholder="Enter phone number"
                                style="background: #f4f6f9;border:1px solid;">
                        </div>
                        <div class="form-group">
                            <label>Phone number</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter phone number"
                                style="background: #f4f6f9;border:1px solid;">
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <section class="content-header">
            <div class="container-fluid">
                <div class="">
                    <div class="text-center">
                        <h3>Mobile Number</h3>
                    </div>
                    <div class="d-flex justify-content-around pb-2 pt-3">
                        <button class="btn btn-light btn-sm pr-5 pl-5 vv" style="border:1px solid;">
                            Consumer
                        </button>
                        <button class="btn btn-light btn-sm pr-5 pl-5 vv" style="border:1px solid;">
                            Supplier
                        </button>
                        <button class="btn btn-light btn-sm pr-5 pl-5 vv" style="border:1px solid;">
                            Employee
                        </button>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content-header">
            <div class="container">
                <div class="row p-5">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea rows="4" class="form-control" name="sms" placeholder="Write message"
                                style="background: #f4f6f9;border:1px solid;"></textarea>
                            0 Characters | 1 SMS (70 Char./SMS )
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="text-center">
            <button class="btn btn-primary text-center mb-5" type="submit" style="padding: 5px 15% 5px 15%">Sent
                SMS</button>
        </div>
    </form>


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
                                        {{-- <datalist id="name">
                                            @foreach ($consumers as $consumer)
                                                <option value="{{ $consumer->name }}">{{ $consumer->name }}</option>
                                            @endforeach
                                        </datalist> --}}
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
