@if ($paginator->lastPage() > 1)
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
        <a href="{{ $paginator->url(1) }}" class="pagination-previous" {{ ($paginator->currentPage() == 1) ? 'disabled' : '' }}>Previous</a>
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="pagination-next" {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'disabled' : '' }}>Next page</a>
        <ul class="pagination-list">
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li>
                    <a href="{{ $paginator->url($i) }}" class="pagination-link {{ ($paginator->currentPage() == $i) ? ' is-current' : '' }}" aria-label="Page {{ $i }}" aria-current="page">{{ $i }}</a>
                </li>
            @endfor
        </ul>
    </nav>
@endif