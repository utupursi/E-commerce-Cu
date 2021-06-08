@extends('admin.layouts.app')
@section('content')
    {!! Form::open(['url' => route('pageIndex',app()->getLocale()),'method' =>'get']) !!}
    <div class="controls-above-table">
        <div class="row">
{{--            <div class="col-sm-2">--}}
{{--                <a class="btn btn-lg btn-success" href="{{route('pageCreateView',app()->getLocale())}}">@lang('admin.create_pages')</a>--}}
{{--            </div>--}}
            <div class="col-sm-12 per-page-column">
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
            @if($pages)
                @foreach($pages as $page)
                    <tr>
                        <td class="text-left">{{$page->id}}</td>
                        <td class="text-center">{{(count($page->availableLanguage) > 0) ?  $page->availableLanguage[0]->title : ''}}</td>
                        <td class="text-center">{{$page->slug}}</td>
                        <td class="text-center">
                            @if($page->status)
                                <span class="text-green">@lang('page.on')</span>
                            @else
                                <span class="text-red">@lang('page.off')</span>
                            @endif
                        </td>
                        <td class="row-actions d-flex">
                            <a href="{{route('pageShow',[app()->getLocale(),$page->id])}}">
                                <i class="os-icon os-icon-documents-07"></i>
                            </a>
                            <a href="{{route('pageEditView',[app()->getLocale(), $page->id])}}">
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
    {{ $pages->links('admin.vendor.pagination.custom') }}

@endsection
