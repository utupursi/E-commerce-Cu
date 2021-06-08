@extends('admin.layouts.app')
@section('content')
    <div class="content-box">
        <div class="row">
            <div class="col-lg-6">
                <div class="element-wrapper">
                    <h6 class="element-header">
                        {{__('admin.create_localization')}}
                    </h6>
                    <div class="element-box">
                        {!! Form::open(['url' => route('localizationCreate',app()->getLocale()),'method' =>'post']) !!}
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
                                    class="form-group {{ $errors->has('abbreviation') ? ' has-error' : '' }}">
                                    {{ Form::label('abbreviation', __('admin.abbreviation'), []) }}
                                    {{ Form::text('abbreviation', '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_abbreviation')]) }}
                                    @if ($errors->has('abbreviation'))
                                        <span class="help-block">
                                            {{ $errors->first('abbreviation') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('native') ? ' has-error' : '' }}">
                                    {{ Form::label('native', __('admin.native'), []) }}
                                    {{ Form::text('native', '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_native')]) }}
                                    @if ($errors->has('native'))
                                        <span class="help-block">
                                    {{ $errors->first('native') }}
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('locale') ? ' has-error' : '' }}">
                                    {{ Form::label('locale', __('admin.locale'), []) }}
                                    {{ Form::text('locale', '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_locale')]) }}
                                    @if ($errors->has('locale'))
                                        <span class="help-block">
                                            {{ $errors->first('locale') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label"><input class="form-check-input" name="status"
                                                                   type="checkbox">{{__('admin.status')}}</label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label"><input class="form-check-input" name="default"
                                                                   type="checkbox">{{__('admin.default')}}</label>
                        </div>
                        @if ($errors->has('default'))
                            <span class="help-block">
                                    {{ $errors->first('default') }}
                                        </span>
                        @endif
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
