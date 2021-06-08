
@extends('admin.layouts.app')
@section('content')
<div class="flex my-3 items-center justify-between">
    <a href="{{route('FileCreate', $locale)}}" class="font-bold text-xs bg-green-400 p-2 rounded-md text-white">
        @lang('admin.add_files')
    </a>
</div>
<div class="row gap-3">
    @if ($files)
        @foreach ($files as $item)
            <div class="col-md-2">
                <div class="bg-white p-3 relative">
                    <a href="{{route('removeImage', [$locale,$item->id])}}" class="absolute right-0 top-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#f52234" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                    </a>
                    <img src="{{asset('../storage/'.$item->path.$item->name)}}" class="w-full h-28 object-cover">

                <small>
                    <input type="text" class="text-xs w-full p-2" value="{{asset('../storage/'.$item->path.$item->name)}}">
                </small>
                </div>
            </div>
        @endforeach
        {{$files->links()}}
    @endif
</div>

@endsection
