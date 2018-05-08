@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="mdl-button mdl-js-button mdl-button--primary disabled"><i class="material-icons">&#xE408;</i></div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="mdl-button mdl-js-button mdl-button--primary " rel="prev"><i class="material-icons">&#xE408;</i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <div class="mdl-button mdl-js-button mdl-button--primary disabled"><span>{{ $element }}</span></div>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <div class="mdl-button mdl-js-button mdl-button--primary" disabled>
                             {{ $page }}
                        </div>
                    @else
                        <a href="{{ $url }}" class="mdl-button mdl-js-button mdl-button--accent mdl-button--mini-fab" >
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <div class="mdl-button mdl-js-button mdl-button--primary"><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="material-icons">&#xE409;</i></a></div>
        @else
            <div class="disabled mdl-button mdl-js-button mdl-button--primary disabled"><span><i class="material-icons">&#xE408;</i></span></div>
        @endif
    </div>
@endif
