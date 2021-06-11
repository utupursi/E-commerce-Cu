<div class="col-md-12">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
    @if($paginator->hasPages())
        @if ($paginator->onFirstPage())
                    <li class="page-item">
                        <a class="page-link" href="" onclick="return false">Previous</a>
                    </li>
        @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">Previous</a>
                    </li>
        @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="#">{{$page}}</a></li>

{{--                            <a href="" class="active">{{$page}}</a>--}}
                        @else
                            <li class="page-item"><a class="page-link" href="{{$url}}">{{$page}}</a></li>

{{--                            <a href="{{ $url }}">{{ $page }}</a>--}}
                        @endif
                    @endforeach
                @endif
            @endforeach
        @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
                </li>
        @else
                <li class="page-item">
                    <a class="page-link" href="" onclick="return false">Next</a>
                </li>
{{--                <a class="pagination-edge" href="" onclick="return false;">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="18.634" height="30.705"--}}
{{--                         viewBox="0 0 18.634 30.705">--}}
{{--                        <path id="Icon_awesome-chevron-left" data-name="Icon awesome-chevron-left"--}}
{{--                              d="M20.073,16.807,6.408,3.142a1.688,1.688,0,0,0-2.386,0L2.427,4.736a1.688,1.688,0,0,0,0,2.384L13.255,18,2.425,28.881a1.687,1.687,0,0,0,0,2.384l1.594,1.594a1.688,1.688,0,0,0,2.386,0L20.073,19.193A1.688,1.688,0,0,0,20.073,16.807Z"--}}
{{--                              transform="translate(-1.933 -2.648)"/>--}}
{{--                    </svg>--}}
{{--                </a>--}}
        @endif
    @endif
        </ul>
    </nav>
</div>
