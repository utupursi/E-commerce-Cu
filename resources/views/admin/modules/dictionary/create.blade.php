@extends('admin.layouts.app')
@section('content')
<div class="content-box">
    <div class="row">
        <div class="col-lg-6">
            <div class="element-wrapper">
            <h6 class="element-header">
                @lang('admin.create_dictionary')
            </h6>
            <form action="{{route('DictionaryStore', $locale)}}" method="POST" class="bg-white py-3 px-4 grid w-full grid-cols-2 gap-3">
                @csrf
    
                <div class="col-span-1 w-full ">
                    <small>@lang('admin.key')</small>
                    <input type="text" required name="key" class="form-control" placeholder="@lang('admin.enter_key')">
                    @error('key')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                <div class="col-span-1 w-full">
                    <small>@lang('admin.module')</small>
                    <input required type="text" name="module" class="form-control" placeholder="@lang('admin.enter_module')">
                    @error('module')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                    @foreach ($langs as $lang)
                    <div class="text-left col-span-2">
                        <small>{{$lang->title}}</small>
                        <input type="text" name="translates[]"  class="form-control" placeholder="{{$lang->abbreviation}} "> <br>
                    </div>
                @endforeach
                <div class="border-t m-0 py-3 col-span-3">
                    <button class="btn btn-primary" type="submit">@lang('admin.create')</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection


         