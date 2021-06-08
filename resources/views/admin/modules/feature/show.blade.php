@extends('admin.layouts.app')
@section('content')
    <div class="content-i">
        <div class="content-box"><div class="element-wrapper">
                <h6 class="element-header">
                    {{ (count($feature->availableLanguage) > 0) ? $feature->availableLanguage[0]->title : ''}}
                </h6>

                <div class="row">
                    <div class="col-2">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>{{__('admin.title')}}</th>
                                <td>
                                    {{ (count($feature->availableLanguage) > 0) ? $feature->availableLanguage[0]->title : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.position')}}</th>
                                <td>{{$feature->position}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.slug')}}</th>
                                <td>{{$feature->slug}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.type')}}</th>
                                <td>{{$feature->type}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.status')}}</th>
                                <td>{{$feature->status ? 'True' : 'False'}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

        </div>
    </div>

@endsection
