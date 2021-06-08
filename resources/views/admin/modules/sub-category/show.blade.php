@extends('admin.layouts.app')
@section('content')
    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">
                    {{ (count($category->availableLanguage) > 0) ? $category->availableLanguage[0]->title : ''}}
                </h6>

                <div class="row">
                    <div class="col-4">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>Title</th>
                                <td>
                                    {{ (count($category->availableLanguage) > 0) ? $category->availableLanguage[0]->title : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>
                                    {{ (count($category->availableLanguage) > 0) ? $category->availableLanguage[0]->description : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>slug</th>
                                <td>{{$category->slug}}</td>
                            </tr>
                            <tr>
                                <th>position</th>
                                <td>{{$category->position}}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{$category->getCategoryNameById($category->parent_id)}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{$category->status ? __('brand.on') : __('brand.off')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

@endsection
