<style>
    [class*=sidebar-dark-] {
        background-color: #28a745;
    }

    [class*=sidebar-dark-] .sidebar a {
        color: #ffffff;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background-color: #ffffff;
    }

    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link {
        color: #ffffff;
    }

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
    .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
        background-color: #17a2b8;
        color: #fff;
    }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel pb-3 mb-3 d-flex" style="border: none;">
            <div class="image">
                <img src="{{ asset(shop()->image) }}" class="img-circle elevation-2" alt="AI">
            </div>
            <div class="info">
                <form action="{{ route('customer.dashboard') }}" method="POST">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ SID() }}">
                    {{-- <a href="{{ route('customer.dashboard') }}" class=""></a> --}}
                    <button type="submit" class="d-block btn btn-link text-light">
                        {{ shop()->name }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <form action="{{ route('customer.dashboard') }}" method="POST">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ SID() }}">
                        <button type="submit" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>

                            Dashboard</button>
                    </form>
                </li>



                {{-- tally --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Tally
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('customer.transaction') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-dark"></i>
                                <p>Transaction</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.quicksell') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-dark"></i>
                                <p>Sell</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.due.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-dark"></i>
                                <p>Due Book</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.expense.expenseBook') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-dark"></i>
                                <p>Expense Book</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.consumers.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-dark"></i>
                                <p>Contact</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('onlineMarket', ['shop_id' => SID()]) }}" target="_blank"
                                class="nav-link">
                                <i class="nav-icon far fa-circle text-dark"></i>
                                <p>Online Market</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if (SHOP()->end_date >= today())
                    {{-- standard --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p class="text">
                                Standard
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-header">
                            <li class="nav-item">
                                <a href="{{ route('customer.products.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-dark"></i>
                                    <p>Product List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customer.digital_payments.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-dark"></i>
                                    <p>Digital Payment</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customer.sms.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-dark"></i>
                                    <p>
                                        SMS Marketting
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- instructor activities --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p class="text">
                                Advanced
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-header">
                            <li class="nav-item">
                                <a href="{{ route('customer.shop.onlineShop') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-dark"></i>
                                    <p>Online Shop</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customer.emi.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-dark"></i>
                                    <p>EMI</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customer.topup.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-dark"></i>
                                    <p>Top UP</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p>Standard</p>
                            <i class="fas fa-lock right"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p>Advanced</p>
                            <i class="fas fa-lock right"></i>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
