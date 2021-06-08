@extends('admin.layouts.app')
@section('content')
    <div class="content-i">
        <div class="content-box"><div class="element-wrapper">
                <h6 class="element-header">
                    {{ (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->title : ''}}
                </h6>

                <div class="row">
                    <div class="col-2">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>{{__('admin.title')}}</th>
                                <td>
                                    {{ (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->title : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.meta_title')}}</th>
                                <td>
                                    {{ (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->meta_title : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.description')}}</th>
                                <td>
                                    {{ (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->description : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.slug')}}</th>
                                <td>{{$page->slug}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.status')}}</th>
                                <td>{{$page->status ? __('page.on') : __('page.off')}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.content')}}</th>
                                <td>
                                    {{ (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->content : ''}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

        </div>
    </div>

@endsection
