<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset($company->logo) }}" alt="admin" class="brand-image  elevation-3" style="opacity: .8">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(auth()->guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="AI">
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}"
                    class="d-block">{{ auth()->guard('admin')->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                {{-- admin --}}
                {{-- @if (auth()->guard('admin')->user()->admin_user == 1) --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Admin
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.adminList') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Admin List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.createAdmin') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Create New Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.customerList') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Customer List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.userList') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>User List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}



                {{-- category --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.category') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.subcategory') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Subcategory</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.emi_times.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>
                                    EMI Times
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.banks.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>
                                    Banks
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- instructor activities
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Instructor Deeds
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.instructor.allCourses') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>All Courses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.instructor.createCourses') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Create Courses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.coupons.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Coupon</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- Job activities
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Job
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.job.index') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Job List</p>
                            </a>
                        </li>
                    </ul>
                </li> 
                <li class="nav-item">
                    <a href="{{ route('admin.blogs.index') }}" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p>Blog</p>
                    </a>
                </li> --}}


                {{-- order
                @if (auth()->guard('admin')->user()->order_history == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p class="text">
                                Order
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-header">
                            <li class="nav-item">
                                <a href="{{ route('admin.cancelOrder') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Canceled Order</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.pendingOrder') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Pending Order</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.confirmOrder') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Confirm Order</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.shippedOrder') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle text-danger"></i>
                                    <p>Shipped Order</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif --}}



                <li class="nav-item">
                    <a href="{{ route('admin.showContact') }}" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p>Contact</p>
                    </a>
                </li>
                {{-- company info --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p class="text">
                            Company Info
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-header">
                        <li class="nav-item">
                            <a href="{{ route('admin.showCompanyInfo') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Company Information</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pageList') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Pages</p>
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
