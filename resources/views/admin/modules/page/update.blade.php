@extends('admin.layouts.app')
@section('content')
    <input name="old-images[]" id="old_images" hidden disabled value="{{$page->files}}">

    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">
                @lang('admin.page_update')
            </h6>
            <div class="element-box">
                {!! Form::open(['url' => route('pageUpdate',[app()->getLocale(),$page->id]),'method' =>'put','files' => true]) !!}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-6">
                                    <div
                                            class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                        {{ Form::label('title', __('admin.title'), []) }}
                                        {{ Form::text('title', (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->title : '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_title')]) }}
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                    {{ $errors->first('title') }}
                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div
                                            class="form-group {{ $errors->has('meta_title') ? ' has-error' : '' }}">
                                        {{ Form::label('meta_title', __('admin.meta_title'), []) }}
                                        {{ Form::text('meta_title', (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->meta_title : '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_meta_title')]) }}
                                        @if ($errors->has('meta_title'))
                                            <span class="help-block">
                                            {{ $errors->first('meta_title') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div
                                            class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                                        {{ Form::label('slug', __('admin.slug'), []) }}
                                        {{ Form::text('slug', $page->slug, ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_slug')]) }}
                                        @if ($errors->has('slug'))
                                            <span class="help-block">
                                    {{ $errors->first('slug') }}
                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div
                                            class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                        {{ Form::label('description', __('admin.description'), []) }}
                                        {{ Form::text('description', (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->description : '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_description')]) }}
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                    {{ $errors->first('description') }}
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div
                                            class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                                        {{ Form::label('content', __('admin.content'), []) }}
                                        {{ Form::textarea('content', (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->content : '', ['class' => 'form-control 50 w-full','id'=>'ckeditor1', 'no','placeholder'=>__('admin.enter_content')]) }}
                                        @if ($errors->has('content'))
                                            <span class="help-block">
                                    {{ $errors->first('content') }}
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div
                                            class="form-group {{ $errors->has('content_2') ? ' has-error' : '' }}">
                                        {{ Form::label('content_2', __('admin.content') . ' 2', []) }}
                                        {{ Form::textarea('content_2', (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->content_2 : '', ['class' => 'form-control 50 w-full','id' => 'ckeditor2', 'no','placeholder'=>__('admin.enter_content') . ' 2']) }}
                                        @if ($errors->has('content_2'))
                                            <span class="help-block">
                                    {{ $errors->first('content_2') }}
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label"><input class="form-check-input" name="status"
                                                                       {{$page->status ? 'checked' : ''}}
                                                                       type="checkbox">{{__('admin.status')}}</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <div
                                            class="form-group {{ $errors->has('content_3') ? ' has-error' : '' }}">
                                        {{ Form::label('content_3', __('admin.content') . ' 3', []) }}
                                        {{ Form::textarea('content_3', (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->content_3 : '', ['class' => 'form-control 50 w-full','id' => 'ckeditor3', 'no','placeholder'=>__('admin.content') . ' 3']) }}
                                        @if ($errors->has('content_3'))
                                            <span class="help-block">
                                    {{ $errors->first('content_3') }}
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div
                                            class="form-group {{ $errors->has('content_4') ? ' has-error' : '' }}">
                                        {{ Form::label('content_4', __('admin.content') . ' 4', []) }}
                                        {{ Form::textarea('content_4', (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->content_4 : '', ['class' => 'form-control 50 w-full','id'=>'ckeditor4', 'no','placeholder'=>__('admin.enter_content') . ' 4']) }}
                                        @if ($errors->has('content_4'))
                                            <span class="help-block">
                                    {{ $errors->first('content_4') }}
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-images"></div>
                                @if ($errors->has('images'))
                                    <span class="help-block">
                                            {{ $errors->first('images') }}
                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="form-buttons-w">
                                <button class="btn btn-primary" type="submit"> {{__('admin.update')}}</button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
