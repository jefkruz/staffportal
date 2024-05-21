@if ($paginator->hasPages())
    <div class="wide-block pt-2 pb-2">
        <nav>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @php
                            $totalPages = count($element);
                            $startPage = max(1, $paginator->currentPage() - 1);
                            $endPage = min($totalPages, $paginator->currentPage() + 1);
                        @endphp

                        {{-- Display first page --}}
                        @if ($startPage > 1)
                            <li class="page-item"><a class="page-link" href="{{ $element[1] }}">1</a></li>
                            @if ($startPage > 2)
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                            @endif
                        @endif

                        @foreach ($element as $page => $url)
                            @if ($page >= $startPage && $page <= $endPage)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endif
                        @endforeach

                        {{-- Display last page --}}
                        @if ($endPage < $totalPages)
                            @if ($endPage < $totalPages - 1)
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                            @endif
                            <li class="page-item"><a class="page-link" href="{{ $element[$totalPages] }}">{{ $totalPages }}</a></li>
                        @endif
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
