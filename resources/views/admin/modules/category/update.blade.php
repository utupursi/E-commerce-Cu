@extends('admin.layouts.app')
@section('content')
    <div class="content-box">
        <div class="row">
            <div class="col-lg-6">
                <div class="element-wrapper">
                    <h6 class="element-header">
                        @lang('admin.category_update')
                    </h6>
                    <div class="element-box">
                        <input name="old-images[]" id="old_images" hidden disabled value="{{$category->files}}">
                        {!! Form::open(['url' => route('categoryUpdate',[app()->getLocale(),$category->id]),'method' =>'put','files'=>true]) !!}
                        <div class="row">
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    {{ Form::label('title', __('admin.title'), []) }}
                                    {{ Form::text('title', (count($category->availableLanguage) > 0) ? $category->availableLanguage[0]->title : '', ['class' => 'form-control', 'no','placeholder'=>'Enter Title']) }}
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
                                    {{ Form::text('description', (count($category->availableLanguage) > 0) ? $category->availableLanguage[0]->description : '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_description')]) }}
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
                                    {{ Form::text('position', $category->position, ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_position')]) }}
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
                                    {{ Form::label('slug', 'Slug', []) }}
                                    {{ Form::text('slug', $category->slug, ['class' => 'form-control', 'no','placeholder'=>'Enter Slug']) }}
                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                            {{ $errors->first('slug') }}
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

                        <div class="form-check">
                            <label class="form-check-label"><input class="form-check-input" name="status"
                                                                   {{$category->status ? 'checked' : ''}}
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
