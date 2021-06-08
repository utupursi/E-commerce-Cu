<div class="catalogue__pagination">
    @if($paginator->hasPages())
        @if ($paginator->onFirstPage())
            <a class="pagination-edge" href="" onclick="return false;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18.634" height="30.704"
                     viewBox="0 0 18.634 30.704">
                    <path id="Icon_awesome-chevron-left" data-name="Icon awesome-chevron-left"
                          d="M2.427,16.807,16.092,3.142a1.688,1.688,0,0,1,2.386,0l1.594,1.594a1.688,1.688,0,0,1,0,2.384L9.245,18l10.83,10.881a1.687,1.687,0,0,1,0,2.384l-1.594,1.594a1.688,1.688,0,0,1-2.386,0L2.427,19.193A1.688,1.688,0,0,1,2.427,16.807Z"
                          transform="translate(-1.933 -2.648)"/>
                </svg>
            </a>
        @else
            <a class="pagination-edge" href="{{ $paginator->previousPageUrl() }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18.634" height="30.704"
                     viewBox="0 0 18.634 30.704">
                    <path id="Icon_awesome-chevron-left" data-name="Icon awesome-chevron-left"
                          d="M2.427,16.807,16.092,3.142a1.688,1.688,0,0,1,2.386,0l1.594,1.594a1.688,1.688,0,0,1,0,2.384L9.245,18l10.83,10.881a1.687,1.687,0,0,1,0,2.384l-1.594,1.594a1.688,1.688,0,0,1-2.386,0L2.427,19.193A1.688,1.688,0,0,1,2.427,16.807Z"
                          transform="translate(-1.933 -2.648)"/>
                </svg>
            </a>
        @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="" class="active">{{$page}}</a>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @if ($paginator->hasMorePages())
                <a class="pagination-edge" href="{{ $paginator->nextPageUrl() }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18.634" height="30.705"
                         viewBox="0 0 18.634 30.705">
                        <path id="Icon_awesome-chevron-left" data-name="Icon awesome-chevron-left"
                              d="M20.073,16.807,6.408,3.142a1.688,1.688,0,0,0-2.386,0L2.427,4.736a1.688,1.688,0,0,0,0,2.384L13.255,18,2.425,28.881a1.687,1.687,0,0,0,0,2.384l1.594,1.594a1.688,1.688,0,0,0,2.386,0L20.073,19.193A1.688,1.688,0,0,0,20.073,16.807Z"
                              transform="translate(-1.933 -2.648)"/>
                    </svg>
                </a>
        @else
                <a class="pagination-edge" href="" onclick="return false;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18.634" height="30.705"
                         viewBox="0 0 18.634 30.705">
                        <path id="Icon_awesome-chevron-left" data-name="Icon awesome-chevron-left"
                              d="M20.073,16.807,6.408,3.142a1.688,1.688,0,0,0-2.386,0L2.427,4.736a1.688,1.688,0,0,0,0,2.384L13.255,18,2.425,28.881a1.687,1.687,0,0,0,0,2.384l1.594,1.594a1.688,1.688,0,0,0,2.386,0L20.073,19.193A1.688,1.688,0,0,0,20.073,16.807Z"
                              transform="translate(-1.933 -2.648)"/>
                    </svg>
                </a>
        @endif
    @endif
</div>
