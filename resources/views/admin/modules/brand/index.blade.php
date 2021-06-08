@extends('admin.layouts.app')
@section('content')
    {!! Form::open(['url' => route('brandIndex',app()->getLocale()),'method' =>'get']) !!}
    <div class="controls-above-table">
        <div class="row">
            <div class="col-sm-2">
                <a class="btn btn-lg btn-success" href="{{route('brandCreateView',app()->getLocale())}}">@lang('admin.create_brands')</a>
            </div>
            <div class="col-sm-10 per-page-column">
                <div class="per-page-container">
                    {{ Form::select('per_page',[10 => 10,20 => 20,30 => 30,50 => 50,100=>100],(Request::get('per_page') != null ? Request::get('per_page') : 10),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-lg table-v2 table-striped">
            <thead>
            <tr>
                <th>@lang('admin.id')</th>
                <th>@lang('admin.title')</th>
                <th>@lang('admin.slug')</th>
                <th>@lang('admin.status')</th>
                <th>@lang('admin.actions')</th>
            </tr>
            <tr>
                <th>
                    {{ Form::text('id',Request::get('id'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('id'))
                        <span class="help-block">
                        {{ $errors->first('id') }}
                        </span>
                    @endif
                </th>
                <th>
                    {{ Form::text('title',Request::get('title'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('title'))
                        <span class="help-block">
                        {{ $errors->first('title') }}
                        </span>
                    @endif
                </th>
                <th>
                    {{ Form::text('slug',Request::get('slug'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('slug'))
                        <span class="help-block">
                        {{ $errors->first('slug') }}
                        </span>
                    @endif
                </th>
                <th>
                    {{ Form::select('status',['' => 'All','1' => 'Active','0' => 'Not Active'],Request::get('status'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('status'))
                        <span class="help-block">
                        {{ $errors->first('status') }}
                        </span>
                    @endif
                </th>
                <th></th>
            </tr>
            </thead>
            {!! Form::close() !!}
            <tbody>
            @if($brands)
                @foreach($brands as $brand)
                    <tr>
                        <td class="text-left">{{$brand->id}}</td>
                        <td class="text-center">{{(count($brand->availableLanguage) > 0) ?  $brand->availableLanguage[0]->title : ''}}</td>
                        <td class="text-center">{{$brand->slug}}</td>
                        <td class="text-center">
                            @if($brand->status)
                                <span class="text-green">@lang('admin.on')</span>
                            @else
                                <span class="text-red">@lang('admin.off')</span>
                            @endif
                        </td>
                        <td class="row-actions d-flex">
                            <a href="{{route('brandShow',[app()->getLocale(),$brand->id])}}">
                                <i class="os-icon os-icon-documents-07"></i>
                            </a>
                            <a href="{{route('brandEditView',[app()->getLocale(), $brand->id])}}">
                                <i class="os-icon os-icon-ui-49">

                                </i>
                            </a>
                            {!! Form::open(['url' => route('brandDestroy',[app()->getLocale(),$brand->id]),'method' =>'delete']) !!}
                            <button class="delete-icon" onclick="return confirm('Are you sure, you want to delete this item?!');" type="submit">
                                <i
                                    class="os-icon os-icon-ui-15">
                                </i>
                            </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    {{ $brands->links('admin.vendor.pagination.custom') }}

@endsection
