<aside class="control-sidebar control-sidebar-dark bg-success">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5 style="border-bottom: 1px solid;">Store Info</h5>
        <ul style="list-style-type: disclosure-closed;">
            <li style="background:white;" class="mb-1">
                <form action="{{ route('customer.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-link">Logoutd</button>
                </form>
            </li>
            <li style="background:white;">
                <form action="{{ route('customer.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-link">Logoutd</button>
                </form>
            </li>
        </ul>
    </div>
</aside>
