<div class="d-flex justify-content-end align-items-center mb-2" style="font-size: 0.875rem;">
    <a href="{{ request()->fullUrlWithQuery(['per_page' => 'all']) }}" class="text-primary text-decoration-none">Show all</a>
    <span class="mx-2 text-muted">|</span>
    <span class="mr-2">Number of rows:</span>
    <form action="{{ url()->current() }}" method="GET" class="d-inline">
        @foreach(request()->except('per_page') as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <select name="per_page" class="form-control form-control-sm d-inline-block" style="width: auto;" onchange="this.form.submit()">
            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request('per_page', 20) == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
            <option value="250" {{ request('per_page') == 250 ? 'selected' : '' }}>250</option>
        </select>
    </form>
</div>
