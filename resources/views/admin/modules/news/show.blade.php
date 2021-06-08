@extends('admin.layouts.app')
@section('content')
    <div class="content-i">
        <div class="content-box"><div class="element-wrapper">


                <div class="row">
                    <div class="col-2">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>@lang('language.key')</th>
                                <td>
                                    {{$language->key}}
                                </td>
                            </tr>
                            <tr>
                                <th>@lang('language.module')</th>
                                <td>{{$language->module}}</td>
                            </tr>
                            @foreach ($langs as $lang)
                            <tr>
                                <th>{{$lang->abbreviation}}</th>
                                <td>{{$language->language()->where('language_id', $lang->id)->first()->value ?? ''}}</td>
                            </tr>
                            @endforeach
                           
                            </tbody>
                        </table>
                    </div>
                </div>

        </div>
    </div>

@endsection
