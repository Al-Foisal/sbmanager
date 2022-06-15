<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href="{{ url('/') }}" role="button">
                <i class="fas fa-globe"></i> Visite Website
            </a>
        </li> --}}
        <li class="nav-item">
            <img src="{{ asset($company->logo) }}" style="height:70px;padding:5px 0 5px 8px">
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
        
        <li class="nav-item">
            <form action="{{ route('customer.logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-link">
                    <i class="fas fa-power-off text-danger"></i>
                </button>
            </form>
        </li>
    </ul>
</nav>
