@extends('admin.layouts.app')
@section('content')
    <div class="content-i">
        <div class="content-box"><div class="element-wrapper">
                <h6 class="element-header">
                    {{$localization->native}}
                </h6>

                <div class="row">
                    <div class="col-2">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>{{__('admin.title')}}</th>
                                <td>{{$localization->title}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.abbreviation')}}</th>
                                <td>{{$localization->abbreviation}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.native')}}</th>
                                <td>{{$localization->native}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.locale')}}</th>
                                <td>{{$localization->locale}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.status')}}</th>
                                <td>{{$localization->status ? 'True' : 'False'}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.default')}}</th>
                                <td>{{$localization->default ? 'True' : 'False'}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

        </div>
    </div>

@endsection
