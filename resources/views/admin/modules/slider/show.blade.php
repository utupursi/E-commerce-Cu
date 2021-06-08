@extends('admin.layouts.app')
@section('content')
    <div class="content-i">
        <div class="content-box"><div class="element-wrapper">
                <h6 class="element-header">
                    {{ (count($slider->availableLanguage) > 0) ? $slider->availableLanguage[0]->title : ''}}
                </h6>

                <div class="row">
                    <div class="col-4">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>{{__('admin.title')}}</th>
                                <td>
                                    {{ (count($slider->availableLanguage) > 0) ? $slider->availableLanguage[0]->title : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.description')}}</th>
                                <td>
                                    {{ (count($slider->availableLanguage) > 0) ? $slider->availableLanguage[0]->description : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.slug')}}</th>
                                <td>{{$slider->slug}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.position')}}</th>
                                <td>{{$slider->position}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.status')}}</th>
                                <td>{{$slider->status ? __('admin.on') : __('admin.off')}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.url')}}</th>
                                <td>{{$slider->redirect_url}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.type')}}</th>
                                <td>{{$slider->type}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

        </div>
    </div>

@endsection
