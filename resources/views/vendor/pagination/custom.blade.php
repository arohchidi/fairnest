@if ($paginator->hasPages())
    <nav class="custom-pagination">
        <div class="pagination-wrapper">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="page disabled">‹</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="page">‹</a>
            @endif

            {{-- Pages --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="page dots">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="page active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="page">›</a>
            @else
                <span class="page disabled">›</span>
            @endif

        </div>
    </nav>
@endif