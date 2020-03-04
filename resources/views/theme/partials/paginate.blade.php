@if ($paginator->hasPages())
  @if ($paginator->count() > 0)
    <nav>
        <ul class="pagination my-3 justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><i class="fa fa-chevron-left"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-chevron-left"></i></a>
                </li>
            @endif

            <li class="page-item">
              <span class="page-link current-page">{{ $paginator->currentPage() }}</span>
            </li>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-chevron-right"></i></a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><i class="fa fa-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
    @else
    <p>
      <a href="{{ route('theme.home') }}">Quay lại trang chủ</a>
    </p>
    @endif
@endif
