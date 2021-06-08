@extends('admin.layouts.app')
@section('content')
    {!! Form::open(['url' => route('settingIndex',app()->getLocale()),'method' =>'get']) !!}
    <div class="controls-above-table">
        <div class="row">
            <div class="col-sm-2">
                <a class="btn btn-lg btn-success" href="{{route('settingCreateView',app()->getLocale())}}">@lang('admin.create_settings')</a>
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
                <th>@lang('admin.key')</th>
                <th>@lang('admin.value')</th>
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
                    {{ Form::text('title',Request::get('key'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('key'))
                        <span class="help-block">
                        {{ $errors->first('key') }}
                        </span>
                    @endif
                </th>
                <th>
                    {{ Form::text('value',Request::get('value'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('value'))
                        <span class="help-block">
                        {{ $errors->first('value') }}
                        </span>
                    @endif
                </th>
                <th></th>
            </tr>
            </thead>
            {!! Form::close() !!}
            <tbody>
            @if($settings)
                @foreach($settings as $setting)
                    <tr>
                        <td class="text-left">{{$setting->id}}</td>
                        <td class="text-center">{{$setting->key}}</td>
                        <td class="text-center">{{(count($setting->availableLanguage) > 0) ?  $setting->availableLanguage[0]->value : ''}}</td>
                        <td class="row-actions d-flex">
                            <a href="{{route('settingShow',[app()->getLocale(),$setting->id])}}">
                                <i class="os-icon os-icon-documents-07"></i>
                            </a>
                            <a href="{{route('settingEditView',[app()->getLocale(), $setting->id])}}">
                                <i class="os-icon os-icon-ui-49">

                                </i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    {{ $settings->links('admin.vendor.pagination.custom') }}

@endsection
