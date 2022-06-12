<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('customer.dashboard') }}" class="brand-link">
        <img src="{{ asset($company->logo ?? '') }}" alt="admin" class="brand-image  elevation-3" style="opacity: .8">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(shop()->image) }}" class="img-circle elevation-2" alt="AI">
            </div>
            <div class="info">
                <a href="{{ route('customer.dashboard') }}" class="d-block">{{ shop()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Transaction</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.quicksell') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Sell</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.due.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Due Book</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.expense.expenseBook') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Expense Book</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.consumers.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Contact</p>
                            </a>
                        </li>

                    </ul>
                </li>

                


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
                            <a href="{{ route('customer.products.indexList') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Product List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.digital_payments.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Digital Payment</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.sms.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
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
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.instructor.allCourses') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>All Courses</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('customer.emi.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>EMI</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.topup.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Top UP</p>
                            </a>
                        </li>
                    </ul>
                </li> 
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
