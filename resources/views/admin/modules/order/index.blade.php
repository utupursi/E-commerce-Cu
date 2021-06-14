@extends('admin.layouts.app')
@section('content')
    {!! Form::open(['url' => route('orderIndex', $locale),'method' =>'get']) !!}
    <div class="controls-above-table">
        <div class="row">
            <div class="col-sm-12 per-page-column">
                <div class="per-page-container">
                    {{ Form::select('per_page',[10 => 10,20 => 20,30 => 30,50 => 50,100=>100],(Request::get('per_page') != null ? Request::get('per_page') : 10),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-lg table-v2 table-striped">
            <thead>
            <tr>
                <th>@lang('admin.id')</th>
                <th>@lang('admin.full_name')</th>
                <th>@lang('admin.payment_type')</th>
                <th>@lang('admin.total_price')</th>
                <th>@lang('admin.status')</th>
                <th>@lang('admin.actions')</th>
            </tr>
            <tr>
                <th>
                    {{ Form::text('id',Request::get('id'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @error('id')
                    <span class="help-block">
                        {{$message}}
                        </span>
                    @enderror
                </th>
                <th>
                    {{ Form::text('fullname',Request::get('fullname'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @error('fullname')
                    <span class="help-block">
                        {{$message}}
                        </span>
                    @enderror
                </th>
                <th>
                    {{ Form::text('payment_type',Request::get('payment_type'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @error('payment_type')
                    <span class="help-block">
                        {{$message}}
                        </span>
                    @enderror
                </th>
                <th>
                    {{ Form::text('total_price',Request::get('total_price'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @error('total_price')
                    <span class="help-block">
                        {{$message}}
                        </span>
                    @enderror
                </th>

                <th>
                    {{ Form::select('status',['' => 'All','1' => __('admin.success_status'),'2' => __('admin.failed_status'),'3'=>__('admin.pending_status')],Request::get('status'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @error('status')
                    <span class="help-block">
                        {{$message}}
                        </span>
                    @enderror
                </th>
                <th></th>

            </tr>
            </thead>
            {!! Form::close() !!}
            <tbody>
            @if($orders)
                @foreach($orders as $order)
                    <tr>
                        <td class="text-center">
                            {{$order->id}}
                        </td>
                        <td class="text-center">
                            {{$order->full_name}}
                        </td>

                        <td class="text-center">
                            {{$order->paymentType->title}}
                        </td>
                        <td class="text-center">
                            {{$order->total_price/100}}
                        </td>
                        <td class="text-center">
                            @if($order->status==1)
                                <span class="badge badge-success">{{__('admin.success_status')}}</span>
                            @endif
                            @if($order->status==2)
                                <span class="badge badge-danger">{{__('admin.failed_status')}}</span>
                            @endif
                            @if($order->status==3)
                                <span class="badge badge-warning">{{__('admin.pending_status')}}</span>

                            @endif
                        </td>

                        <td class="row-actions ">
                            <div class="flex items-center">

                                <a href="{{route('orderShow',[$locale,$order->id])}}">
                                    <i class="os-icon os-icon-documents-07"></i>
                                </a>
                                <a href="{{route('orderEditView', [$locale, $order->id])}}">
                                    <i class="os-icon os-icon-ui-49">

                                    </i>
                                </a>
                            </div>

                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    {{ $orders->links('admin.vendor.pagination.custom') }}

@endsection
