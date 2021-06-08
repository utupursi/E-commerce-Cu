@extends('admin.layouts.app')
@section('content')
<div class="content-box">
    <div class="row">
        <div class="col-lg-6">
            <div class="element-wrapper">
            <h6 class="element-header">
                @lang('admin.add_files')
            </h6>
            <form action="{{route('FileStore', $locale)}}" enctype="multipart/form-data" method="POST" class="bg-white py-3 px-4 row w-full">
                @csrf
                <div class="col-lg-12 w-full ">
                    <label for="file">@lang('news.file')</label>
                    <input required type="file"  name="file" class="text-xs form-control">
                    @error('file')
                    <p>{{$message}}</p>
                    @enderror 
                </div>

                <div class="px-2 m-0 py-3 col-span-12">
                    <button class="btn btn-primary mt-2" type="submit">@lang('admin.create')</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection


         