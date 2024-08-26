@props(['cardTitle'])

<div class="card mx-auto mt-5 shadow p-3 mb-5 bg-body rounded">
    <div class="card-body">
        <h5 class="card-title mb-2 fs-3 text">{{ $cardTitle }}</h5>
        @yield('card-body')
    </div>
</div>
