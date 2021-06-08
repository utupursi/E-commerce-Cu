@extends('admin.layouts.app')
@section('content')
<div class="content-box">
    <div class="row">
        <div class="col-lg-6">
            <div class="element-wrapper">
            <h6 class="element-header">
                @lang('admin.create_news')
            </h6>
            <form action="{{route('NewsUpdate', [$locale, $news->id])}}" enctype="multipart/form-data" method="POST" class="bg-white py-3 px-4 row w-full">
                @csrf
                @method('PUT')
    
                <div class="col-lg-6 w-full ">
                    <label for="file">@lang('news.file')</label>
                    <input type="file"  name="file" class="text-xs form-control">
                    @error('file')
                    <p>{{$message}}</p>
                    @enderror 
                    @if($news->file)
                    <div class="relative p-3 mt-2">
                        <a href="{{route('removeImage', [$locale,$news->file->id])}}" class="absolute right-0 top-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#f52234" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                              </svg>
                        </a>
                        <img src="{{asset('../storage/'.$news->file->path.$news->file->name)}}" class="object-contain w-1/2" height="40" >
                    </div>
                    @endif
                </div>
                <div class="col-lg-6 w-full ">
                    <label for="title">@lang('news.title')</label>
                    <input type="text" required name="title" value="{{$news->language()->where('language_id', $localization)->first()->title ?? ''}}" class=" py-2 form-control" placeholder="@lang('news.title')">
                    @error('title')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                <div class="col-lg-12 w-full px-2 mt-2">
                    <label for="description">@lang('news.description')</label>
                    <textarea name="description" id="description" value="{{$news->language()->where('language_id', $localization)->first()->description ?? ''}}" class="form-control" placeholder="@lang('news.description')" rows="3"></textarea>
                    @error('description')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                <div class="col-md-4">
                    
                    <label for="status">@lang('news.status')</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{($news->status == 1) ? 'selected' : ''}}>@lang('news.active')</option>
                        <option value="0" {{($news->status == 0) ? 'selected' : ''}}>@lang('news.nonactive')</option>
                    </select>
                    @error('status')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                
                <div class="col-md-4">
                    
                    <label for="position">@lang('news.position')</label>
                    <input type="text"  name="position" value="{{$news->position}}" class=" py-2 form-control" placeholder="@lang('news.position')">
                    @error('position')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                
                <div class="col-md-4">
                    
                    <label for="slug">@lang('news.slug')</label>
                    <input type="text"  name="slug" value="{{$news->slug}}" class=" py-2 form-control" placeholder="@lang('news.slug')">
                    @error('slug')
                    <p>{{$message}}</p>
                    @enderror 
                </div>
                <div class="px-2 mt-3 w-full">
                    <textarea cols="50 w-full" id="ckeditor1"  name="content"  rows="10">{{$news->language()->where('language_id', $localization)->first()->content ?? ''}}</textarea>
                    @error('content')
                     <p>{{$message}}</p>   
                    @enderror
                    <div style="margin-top: 20px">
                        <label for="section">{{__('news.section')}}</label>
                        <textarea class="form-control" name="section">{{$news->language()->where('language_id', $localization)->first()->section}}</textarea>
                        @error('content')
                        <p>{{$message}}</p>
                        @enderror
                    </div>
                <div class="border-t m-0 py-3 col-span-3">
                    <button class="btn btn-primary mt-2" type="submit">@lang('language.update')</button>
                </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection


         