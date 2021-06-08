@extends('admin.layouts.app')
@section('content')
    <div class="content-box">
        <div class="row">
            <div class="col-lg-6">
                <div class="element-wrapper">
                    <h6 class="element-header">
                        @lang('admin.update_order')
                    </h6>
                    <form action="{{route('orderUpdate', [$locale, $order->id])}}" enctype="multipart/form-data"
                          method="POST" class="bg-white py-3 px-4 row w-full">
                        @csrf
                        @method('PUT')


                        <div class="row">
                            <div class="col-12">
                                {{ Form::label('status',__('admin.status')) }}
                                <select name="status" class="form-control">
                                    <option {{($order->status == 1) ? 'selected' : ''}} value="1">{{__('admin.success_status')}}</option>
                                    <option {{($order->status == 2) ? 'selected' : ''}} value="2">{{__('admin.failed_status')}}</option>
                                    <option {{($order->status == 3) ? 'selected' : ''}} value="3">{{__('admin.pending_status')}}</option>

                                </select>
                            </div>
                            <div class="col-2">
                                <div class="form-buttons-w">
                                    <button class="btn btn-primary" type="submit"> {{__('admin.update')}}</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


