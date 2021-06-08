@extends('admin.layouts.app')
@section('content')
    <div class="content-i">
        <div class="content-box"><div class="element-wrapper">
                <h6 class="element-header">
                    {{ (count($brand->availableLanguage) > 0) ? $brand->availableLanguage[0]->title : ''}}
                </h6>

                <div class="row">
                    <div class="col-2">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>{{__('admin.title')}}</th>
                                <td>
                                    {{ (count($brand->availableLanguage) > 0) ? $brand->availableLanguage[0]->title : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.description')}}</th>
                                <td>
                                    {{ (count($brand->availableLanguage) > 0) ? $brand->availableLanguage[0]->description : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.slug')}}</th>
                                <td>{{$brand->slug}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.position')}}</th>
                                <td>{{$brand->position}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.status')}}</th>
                                <td>{{$brand->status ? __('admin.on') : __('admin.off')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

        </div>
    </div>

@endsection
