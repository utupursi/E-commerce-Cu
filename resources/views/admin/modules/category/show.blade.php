@extends('admin.layouts.app')
@section('content')
    <div class="content-i">
        <div class="content-box"><div class="element-wrapper">
                <h6 class="element-header">
                    {{ (count($category->availableLanguage) > 0) ? $category->availableLanguage[0]->title : ''}}
                </h6>

                <div class="row">
                    <div class="col-2">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>{{__('admin.title')}}</th>
                                <td>
                                    {{ (count($category->availableLanguage) > 0) ? $category->availableLanguage[0]->title : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.description')}}</th>
                                <td>
                                    {{ (count($category->availableLanguage) > 0) ? $category->availableLanguage[0]->description : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.slug')}}</th>
                                <td>{{$category->slug}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.position')}}</th>
                                <td>{{$category->position}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.status')}}</th>
                                <td>{{$category->status ? __('admin.on') : __('admin.off')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

        </div>
    </div>

@endsection
