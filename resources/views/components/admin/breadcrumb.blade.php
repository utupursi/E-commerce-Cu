<div>
    <ul class="breadcrumb">
        @foreach(request()->breadcrumbs()->segments() as $key => $segment)
            @if(!isset(request()->breadcrumbs()->segments()[$key+1]))
                <li class="breadcrumb-item">
                    <a href="" onclick="return false;">{{is_numeric($segment->name()) ? $segment->name() : __('admin.'.$segment->name()) }}</a>
                </li>
            @else
                @if(!in_array($segment->name(),$languages['abbreviations']))
                    <li class="breadcrumb-item">
                        <a href="{{$segment->url()}}">{{is_numeric($segment->name()) ? $segment->name() : __('admin.'.$segment->name()) }}</a>
                    </li>
                @endif
            @endif
        @endforeach
    </ul>
</div>
