@extends('admin.layouts.app')
@section('content')
<div class="content-box">
    <div class="row">
        <div class="col-lg-6">
            <div class="element-wrapper">
            <h6 class="element-header">
                @lang('admin.create_news')
            </h6>
            <form action="{{route('NewsStore', $locale)}}" enctype="multipart/form-data" method="POST" class="bg-white py-3 px-4 row w-full">
                @csrf
    
                <div class="col-lg-6 w-full ">
                    <label for="file">@lang('news.file')</label>
                    <input type="file"  name="file" class="text-xs form-control">
                    @error('file')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                <div class="col-lg-6 w-full ">
                    <label for="title">@lang('news.title')</label>
                    <input type="text" required name="title" class=" py-2 form-control" placeholder="@lang('news.title')">
                    @error('title')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                <div class="col-lg-12 w-full px-2 mt-2">
                    <label for="description">@lang('news.description')</label>
                    <textarea name="description" id="description" class="form-control" placeholder="@lang('news.description')" rows="3"></textarea>
                    @error('description')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                <div class="col-md-4">
                    
                    <label for="status">@lang('news.status')</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">@lang('news.active')</option>
                        <option value="0">@lang('news.nonactive')</option>
                    </select>
                    @error('status')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                
                <div class="col-md-4">
                    
                    <label for="position">@lang('news.position')</label>
                    <input type="text"  name="position" class=" py-2 form-control" placeholder="@lang('news.position')">
                    @error('position')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                
                <div class="col-md-4">
                    
                    <label for="slug">@lang('news.slug')</label>
                    <input type="text" required name="slug" class=" py-2 form-control" placeholder="@lang('news.slug')">
                    @error('slug')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                <div class="px-2 mt-3 w-full">
                    <textarea cols="50 w-full" id="ckeditor1" name="content"  rows="10"></textarea>
                    @error('content')
                     <p>{{$message}}</p>   
                    @enderror
                    <div style="margin-top: 20px">
                        <label for="section">{{__('news.section')}}</label>
                        <textarea class="form-control" name="section" ></textarea>
                        @error('content')
                        <p>{{$message}}</p>
                        @enderror
                    </div>
                <div class="border-t m-0 py-3 col-span-3">
                    <button class="btn btn-primary mt-2" type="submit">@lang('language.create')</button>
                </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection


         