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
    <section class="content-header mmm">
        <div class="container-fluid">
            <div class="card">
                <div class="p-3">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Widget: user widget style 2 -->
                            <div class="card card-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-success">
                                    <div class="">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="validationTooltipUsernamePrepend">
                                                    <i class="far fa-copy js-textareacopybtn"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control js-copytextarea"
                                                id="validationTooltipUsername" value="{{ $emi->link }}"
                                                aria-describedby="validationTooltipUsernamePrepend" readonly>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-light btn-sm"
                                                style="border:1px solid;padding:1% 10% 1% 10%;margin-top:2%;"
                                                data-toggle="modal" data-target="#exampleModal">Share Your
                                                Link</button>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer p-0">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                Name: <span class="float-right">{{ $emi->name }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                Phone: <span class="float-right">{{ $emi->phone }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                Present address: <span class="float-right">{{ $emi->address }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                Amount: <span class="float-right">৳ {{ $emi->amount }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                Bank name: <span class="float-right">{{ $emi->bank->name }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                EMI Month: <span class="float-right">{{ $emi->emi_month }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                EMI Parcentage: <span
                                                    class="float-right">{{ $emi->emi_parcentage }}%</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                EMI Extra Pay: <span class="float-right">৳ {{ $emi->emi_extra }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                EMI Monthly Payment: <span class="float-right">৳
                                                    {{ $emi->emi_monthly_amount }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                EMI Total with Extra: <span class="float-right">৳
                                                    {{ $emi->emi_paid_amount }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                EMI status: <span class="float-right">{{ $emi->status }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
