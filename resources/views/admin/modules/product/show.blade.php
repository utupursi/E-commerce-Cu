@extends('admin.layouts.app')
@section('content')
    <div class="content-i">
        <div class="content-box"><div class="element-wrapper">
                <h6 class="element-header">
                    {{ (count($product->availableLanguage) > 0) ? $product->availableLanguage[0]->title : ''}}
                </h6>

                <div class="row">
                    <div class="col-2">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>{{__('admin.title')}}</th>
                                <td>
                                    {{ (count($product->availableLanguage) > 0) ? $product->availableLanguage[0]->title : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.description')}}</th>
                                <td>
                                    {{ (count($product->availableLanguage) > 0) ? $product->availableLanguage[0]->description : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.content')}}</th>
                                <td>
                                    {{ (count($product->availableLanguage) > 0) ? $product->availableLanguage[0]->content : ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.position')}}</th>
                                <td>{{$product->position}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.slug')}}</th>
                                <td>{{$product->slug}}</td>
                            </tr>
                            <tr>
                                <th>{{__('client.price')}}</th>
                                <td>{{number_format($product->price/100,2)}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.status')}}</th>
                                <td>{{$product->status ? 'True' : 'False'}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin.view')}}</th>
                                <td>{{$product->view}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="image-container">
                            @if(count($product->files) >0 )
                                @foreach($product->files as $file)
                                    <div class="view-image" style="background-image: url('{{url('storage/product/'.$file->fileable_id.'/'.$file->name)}}')"></div>
                                @endforeach
                            @endif
                        </div>
                </div>

        </div>
    </div>

@endsection
