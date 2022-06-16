<footer class="main-footer">
    <!-- To the right -->
    @foreach ($pages as $page)
        @if ($page->id !== 5)
            <div class="float-right d-none d-sm-inline mr-1">
                <a href="{{ route('customer.pageDetails', $page->slug) }}">
                    {{ $page->title }}
                </a>
            </div>
        @endif
    @endforeach
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date('Y') }} <a href="https://quicktech-ltd.com/">Quicktech It</a>.</strong> All
    rights
    reserved.
</footer>
