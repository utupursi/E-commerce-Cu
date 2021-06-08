@extends('admin.layouts.app')
@section('content')
    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">


                <div class="row">
                    <div class="col-4">
                        <h3>{{__('admin.order_details')}}</h3>
                        <br>
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>{{__('admin.first_name')}}</th>
                                <td>
                                    {{$order->first_name}}
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('admin.last_name')}}</th>
                                <td>{{$order->last_name}}</td>
                            </tr>

                            <tr>
                                <th>{{__('client.email')}}</th>
                                <td>{{$order->email}}</td>
                            </tr>

                            <tr>
                                <th>{{__('client.phone')}}</th>
                                <td>{{$order->phone}}</td>
                            </tr>
                            @if($order->address)
                                <tr>
                                    <th>{{__('admin.address')}}</th>
                                    <td>{{$order->address}}</td>
                                </tr>
                            @endif

                            <tr>
                                <th>{{__('admin.shipment_price')}}</th>
                                <td>{{$order->shipment_price/100}}</td>
                            </tr>
                            @if($order->shipment_comment)
                                <tr>
                                    <th>{{__('admin.shipment_comment')}}</th>
                                    <td>{{$order->shipment_comment}}</td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                        @if($order->bank->title==="Volta Loan")
                            <br>
                            <h3>{{__('admin.volta_loan')}}</h3>
                            <br>
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <th>{{__('admin.first_name')}}</th>
                                    <td>
                                        {{$order->loan->first_name}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{__('admin.last_name')}}</th>
                                    <td>{{$order->loan->last_name}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.personal_number')}}</th>
                                    <td>{{$order->loan->personal_number}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.phone')}}</th>
                                    <td>{{$order->loan->phone}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.jurisdiction_address')}}</th>
                                    <td>{{$order->loan->jurisdiction_address}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.actual_address')}}</th>
                                    <td>{{$order->loan->actual_address}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.job')}}</th>
                                    <td>{{$order->loan->job}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.job_address')}}</th>
                                    <td>{{$order->loan->job_address}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.job_phone')}}</th>
                                    <td>{{$order->loan->job_phone}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('client.income')}}</th>
                                    <td>{{$order->loan->income}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.additional_income')}}</th>
                                    <td>{{$order->loan->additional_income}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.liabilities')}}</th>
                                    <td>{{$order->loan->liabilities}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.family_full_name')}}</th>
                                    <td>{{$order->loan->family_full_name}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.family_phone')}}</th>
                                    <td>{{$order->loan->family_phone}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.family_1_full_name')}}</th>
                                    <td>{{$order->loan->family_1_full_name}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.family_2_phone')}}</th>
                                    <td>{{$order->loan->family_2_phone}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.employee_full_name')}}</th>
                                    <td>{{$order->loan->employee_full_name}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.employee_phone')}}</th>
                                    <td>{{$order->loan->employee_phone}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.friend_full_name')}}</th>
                                    <td>{{$order->loan->friend_full_name}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.friend_phone')}}</th>
                                    <td>{{$order->loan->friend_phone}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.payment_day')}}</th>
                                    <td>{{$order->loan->payment_day}}</td>
                                </tr>

                                <tr>
                                    <th>{{__('client.month_total')}}</th>
                                    <td>{{$order->loan->month_total}}</td>
                                </tr>

                                </tbody>
                            </table>
                        @endif
                        <br>
                        <h3>{{__('admin.products')}}</h3>
                        <br>
                        <table class="table table-bordered  table-v2 table-striped">
                            <thead>
                            <tr>
                                <th>@lang('admin.image')</th>
                                <th>@lang('admin.title')</th>
                                <th>@lang('admin.total_price')</th>
                                <th>@lang('admin.quantity')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($order)
                                @foreach($order->products as $singleOrder)
                                    <tr>
                                        <td class="text-center">
                                            @if(isset($singleOrder->product->files[0]))
                                                <img style="width:100px"
                                                     src="/storage/product/{{$singleOrder->product->id}}/{{$singleOrder->product->files[0]->name}}">
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{count($singleOrder->product->availableLanguage)>0?$singleOrder->product->availableLanguage[0]->title:""}}
                                        </td>
                                        <td class="text-center">
                                            {{$singleOrder->total_price/100}}
                                        </td>
                                        <td class="text-center">
                                            {{$singleOrder->quantity}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
