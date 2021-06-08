@extends('admin.layouts.app')
@section('content')
    {!! Form::open(['url' => route('productCreate',app()->getLocale()),'method' =>'post','files'=>true]) !!}

    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">
                @lang('admin.products_create')
            </h6>
            <div class="element-box">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        @if(count($categories) > 0)
                            {{ Form::label('category',__('client.category')) }}
                            <select name="category" class="form-control select2">
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}">{{(count($category->availableLanguage) > 0) ? $category->availableLanguage[0]->title : $category->language[0]->title }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
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
                                    {{ $errors->first('slug') }}
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-4">
                                        <div
                                            class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                                            {{ Form::label('price', __('client.price'), []) }}
                                            {{ Form::number('price', '', ['class' => 'form-control', 'no','placeholder'=>__('client.price'),'min'=>0]) }}
                                            @if ($errors->has('price'))
                                                <span class="help-block">
                                            {{ $errors->first('price') }}
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="col-2" style="display: grid">
                                        {{ Form::label('sale', __('admin.sale'), []) }}
                                        {{ Form::checkbox('sale', true,false,['class' => 'form-control']) }}

                                    </div>
                                    <div class="col-1"></div>

                                    <div class="col-4">
                                        <div
                                            class="form-group {{ $errors->has('sale_price') ? ' has-error' : '' }}">
                                            {{ Form::label('sale_price', __('admin.sale_price'), []) }}
                                            {{ Form::number('sale_price', '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_sale_price'),'min' => 0]) }}
                                            @if ($errors->has('sale_price'))
                                                <span class="help-block">
                                            {{ $errors->first('sale_price') }}
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    {{ Form::label('description', __('admin.description'), []) }}
                                    {{ Form::textarea('description', '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_description')]) }}
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                    {{ $errors->first('description') }}
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div
                                    class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                                    {{ Form::label('content', __('admin.content'), []) }}
                                    {{ Form::textarea('content', '', ['class' => 'form-control', 'no','placeholder'=>__('admin.enter_content')]) }}
                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                            {{ $errors->first('content') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <label class="form-check-label"><input class="form-check-input" name="status"
                                                                           type="checkbox">{{__('admin.status')}}</label>
                                </div>
                                <div class="form-check" style="margin-top: 10px">
                                    <label class="form-check-label"><input class="form-check-input" name="vip"
                                                                           type="checkbox">{{__('admin.vip')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">

                        @if(count($features) > 0)
                            @foreach($features as $feature)
                                @if(count($feature->answer) > 0)
                                    {{ Form::label('featurs',(count($feature->availableLanguage) > 0) ? $feature->availableLanguage[0]->title :$feature->language[0]->title , []) }}
                                    <select name="features[{{$feature->id}}][]" class="form-control select2"
                                            multiple="true">
                                        @foreach($feature->answer as $answer)
                                            <option
                                                value="{{$answer->id}}">{{(count($answer->availableLanguage) > 0) ? $answer->availableLanguage[0]->title : $answer->language[0]->title }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            @endforeach
                        @endif
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
                            <button class="btn btn-primary" type="submit"> {{__('admin.create')}}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {!! Form::close() !!}
@endsection
