@if ($paginator->hasPages())
    <div class="controls-below-table">
        <div class="table-records-info">
            {{__('admin.showing_record')}} {{$paginator->perPage()}} - {{$paginator->total()}}
        </div>
        <div class="table-records-pages">
            <ul>
                @if ($paginator->onFirstPage())
                    <li>
                        <a href="" onclick="return false;">{{__('admin.previous')}}</a>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                           aria-label="@lang('pagination.previous')">{{__('admin.previous')}}</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <a class="current" href="" onclick="return false;">{{$page}}</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                           aria-label="@lang('pagination.next')">{{__('admin.next')}}</a>
                    </li>
                @else
                    <li>
                        <a href="" rel="next" aria-label="@lang('pagination.next')" onclick="return false;">{{__('admin.next')}}</a>
                    </li>
                @endif
            </ul>
        </div>
        @else
            <div class="controls-below-table">
                <div class="table-records-info">
                    {{__('admin.showing_record')}} {{$paginator->total()}} - {{$paginator->total()}}
                </div>
                <div class="table-records-pages">
                    <ul>
                        <li>
                            <a href="" onclick="return false;">{{__('admin.previous')}}</a>
                        </li>
                        <li>
                            <a class="current" href="" onclick="return false;">1</a>
                        </li>
                        <li>
                            <a href="" rel="next" aria-label="@lang('pagination.next')" onclick="return false;">{{__('admin.next')}}</a>
                        </li>
                    </ul>
                </div>

@endif
