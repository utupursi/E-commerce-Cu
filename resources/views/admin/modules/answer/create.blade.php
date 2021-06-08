@extends('admin.layouts.app')
@section('content')
    <div class="content-box">
        <div class="row">
            <div class="col-lg-6">
                <div class="element-wrapper">
                    <h6 class="element-header">
                        @lang('admin.answer_create')
                    </h6>
                    <form action="{{route('AnswerStore', $locale)}}" method="POST"
                          class="bg-white py-3 px-4 grid w-full grid-cols-3 gap-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-span-1">
                            <label for="feature">@lang('admin.feature')</label>
                            <select name="feature" id="feature" class="form-control">
                                @foreach ($features as $feature)
                                    <option
                                        value="{{$feature->id}}">{{($feature->language()->where('language_id', $localization)->first()->title) ?? $feature->language()->first()->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-1 w-full ">
                            <label for="position">@lang('admin.position')</label>
                            <input type="text" id="position" name="position" class="form-control"
                                   placeholder="@lang('admin.enter_position')">
                        </div>
                        <div class="col-span-1 w-full">
                            <label for="slug">@lang('admin.slug')</label>
                            <input required id="slug" type="text" name="slug" class="form-control"
                                   placeholder="@lang('admin.enter_slug')">
                        </div>
                        <div class="col-span-2 w-full">
                            <label for="title">@lang('answer.title')</label>
                            <input required type="text" id="title" name="title" class="form-control"
                                   placeholder="@lang('admin.enter_title')"> <br>
                        </div>
                        <div class="col-span-1 w-full">
                            <label for="status">@lang('admin.status')</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">@lang('admin.on')</option>
                                <option value="0">@lang('admin.off')</option>
                            </select> <br>
                        </div>
                        <div class="col-span-2 w-full">
                            <div class="form-group">
                                <div class="input-images"></div>
                                @if ($errors->has('images'))
                                    <span class="help-block">
                                            {{ $errors->first('images') }}
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="border-t m-0 py-3 col-span-3">
                            <button class="btn btn-primary" type="submit"> @lang('admin.create')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


