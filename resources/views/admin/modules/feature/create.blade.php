@extends('admin.layouts.app')
@section('content')
<div class="content-box">
    <div class="row">
        <div class="col-lg-6">
            <div class="element-wrapper">
                <h6 class="element-header">
                    @lang('admin.feature_create')
                </h6>
                    <div class="element-box">
                        {!! Form::open(['url' => route('featureCreate',app()->getLocale()),'method' =>'post']) !!}
                        <div class="row">
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    {{ Form::label('title', __('admin.title'), []) }}
                                    {{ Form::text('title', '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_title')]) }}
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                    {{ $errors->first('title') }}
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('position') ? ' has-error' : '' }}">
                                    {{ Form::label('position', __('admin.position'), []) }}
                                    {{ Form::text('position', '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_position')]) }}
                                    @if ($errors->has('position'))
                                        <span class="help-block">
                                            {{ $errors->first('position') }}
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
                                    {{ Form::text('slug', '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_slug')]) }}
                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                    {{ $errors->first('native') }}
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('locale') ? ' has-error' : '' }}">
                                    {{ Form::label('type', 'Type', []) }}
                                    {{ Form::select('type',[
                                        'input' => 'Input',
                                        'textarea' => 'Text Area',
                                        'checkbox' => 'Checkbox',
                                        'radio' => 'Radio',
                                        'select' => 'Select'
                                    ],'',  ['class' => 'form-control', 'no']) }}
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            {{ $errors->first('type') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label"><input class="form-check-input" name="status"
                                                                   type="checkbox">{{__('admin.status')}}</label>
                        </div>
                        <div class="form-buttons-w">
                            <button class="btn btn-primary" type="submit"> {{__('admin.create')}}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
