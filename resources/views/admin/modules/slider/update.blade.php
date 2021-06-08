@extends('admin.layouts.app')
@section('content')
    <div class="content-box">
        <div class="row">
            <div class="col-lg-6">
                <div class="element-wrapper">
                    <h6 class="element-header">
                        @lang('admin.slider_update')
                    </h6>
                    <div class="element-box">
                        <input name="old-images[]" id="old_images" hidden disabled value="{{$slider->files}}">
                        {!! Form::open(['url' => route('sliderUpdate',[app()->getLocale(),$slider->id]),'method' =>'put','files'=>true]) !!}
                        <div class="row">
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    {{ Form::label('title', __('admin.title'), []) }}
                                    {{ Form::text('title', (count($slider->availableLanguage) > 0) ? $slider->availableLanguage[0]->title : '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_title')]) }}
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                    {{ $errors->first('title') }}
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    {{ Form::label('description', __('admin.description'), []) }}
                                    {{ Form::text('description', (count($slider->availableLanguage) > 0) ? $slider->availableLanguage[0]->description : '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_description')]) }}
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            {{ $errors->first('description') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('position') ? ' has-error' : '' }}">
                                    {{ Form::label('position', __('admin.position'), []) }}
                                    {{ Form::text('position', $slider->position, ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_position')]) }}
                                    @if ($errors->has('position'))
                                        <span class="help-block">
                                            {{ $errors->first('position') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                                    {{ Form::label('slug', __('admin.slug'), []) }}
                                    {{ Form::text('slug', $slider->slug, ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_slug')]) }}
                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                            {{ $errors->first('slug') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('redirect_url') ? ' has-error' : '' }}">
                                    {{ Form::label('redirect_url', __('admin.url'), []) }}
                                    {{ Form::text('redirect_url', $slider->redirect_url, ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_url')]) }}
                                    @if ($errors->has('redirect_url'))
                                        <span class="help-block">
                                            {{ $errors->first('redirect_url') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                {{ Form::label('type',__('admin.type')) }}
                                <select name="type" class="form-control select2">
                                    <option value="slider" {{($slider->type) == 'slider' ? 'selected' : ''}}>Slider</option>
                                    <option value="banner" {{($slider->type) == 'banner' ? 'selected' : ''}}>Banner</option>
                                    <option value="second_banner" {{($slider->type) == 'second_banner' ? 'selected' : ''}}>Second Banner</option>
                                </select>
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

                        <div class="form-check">
                            <label class="form-check-label"><input class="form-check-input" name="status"
                                                                   {{$slider->status ? 'checked' : ''}}
                                                                   type="checkbox">{{__('admin.status')}}</label>
                        </div>
                        <div class="form-buttons-w">
                            <button class="btn btn-primary" type="submit"> {{__('admin.update')}}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
