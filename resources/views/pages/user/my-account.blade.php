@extends('layouts.base')

@section('content')

    <div class="my-account">
        <div class="container-fluid">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('danger'))
                <div class="alert alert-success">
                    {{ session()->get('danger') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="account-nav" data-toggle="pill" href="#account-tab" role="tab"><i
                                class="fa fa-user"></i>Account Details</a>
                        <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab"><i
                                class="fa fa-shopping-bag"></i>Orders</a>
                        <a class="nav-link" href="{{route('logout',app()->getLocale())}}"><i class="fa fa-sign-out-alt"></i>Logout</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show" id="dashboard-tab" role="tabpanel"
                             aria-labelledby="dashboard-nav">
                            <h4>Dashboard</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi
                                viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor
                                hendrerit finibus. Nulla tristique viverra nisl, sit amet bibendum ante suscipit non.
                                Praesent in faucibus tellus, sed gravida lacus. Vivamus eu diam eros. Aliquam et sapien
                                eget arcu rhoncus scelerisque.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>ტრანზაქციის ID</th>
                                        <th>გადახდის მეთოდი</th>
                                        <th>ფასი</th>
                                        <th>სტატუსი</th>
                                        <th>მოქმედება</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->transaction_id}}</td>
                                            <td>{{$order->paymentType->title}}</td>
                                            <td>$ {{round($order->total_price/100,2)}}</td>
                                            <td>
                                                @if($order->status==1)
                                                    Success
                                                @elseif($order->status==2)
                                                    Fail
                                                @else
                                                    Pending
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('userProducts',[app()->getLocale(),$order->id])}}" class="btn">ნახვა</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="payment-nav">
                            <h4>Payment Method</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi
                                viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor
                                hendrerit finibus. Nulla tristique viverra nisl, sit amet bibendum ante suscipit non.
                                Praesent in faucibus tellus, sed gravida lacus. Vivamus eu diam eros. Aliquam et sapien
                                eget arcu rhoncus scelerisque.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="address-tab" role="tabpanel" aria-labelledby="address-nav">
                            <h4>Address</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Payment Address</h5>
                                    <p>123 Payment Street, Los Angeles, CA</p>
                                    <p>Mobile: 012-345-6789</p>
                                    <button class="btn">Edit Address</button>
                                </div>
                                <div class="col-md-6">
                                    <h5>Shipping Address</h5>
                                    <p>123 Shipping Street, Los Angeles, CA</p>
                                    <p>Mobile: 012-345-6789</p>
                                    <button class="btn">Edit Address</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                            <h4>Account Details</h4>
                            <form action={{route('updateProfile',app()->getLocale())}} class="row" method="POST">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="col-md-6">
                                <label>სახელი</label>
                                    <input name="first_name" value="{{count(auth()->user()->availableLanguage)>0?auth()->user()->availableLanguage[0]->first_name:''}}" class="form-control" name="first_name" type="text" placeholder="First Name">
                                </div>
                                <div class="col-md-6">
                                <label>გვარი</label>
                                    <input class="form-control" name="last_name" value="{{count(auth()->user()->availableLanguage)>0?auth()->user()->availableLanguage[0]->last_name:''}}" name="last_name" type="text" placeholder="Last Name">
                                </div>
                                <div class="col-md-6">
                                <label>ელ.ფოსტა</label>
                                    <input disabled class="form-control" name="email" value="{{auth()->user()->email}}" type="text" placeholder="Email">
                                </div>
                                <div class="col-md-12">
                                <label>მისამართი</label>
                                    <input class="form-control" name="address" value="{{count(auth()->user()->availableLanguage)>0?auth()->user()->availableLanguage[0]->address:''}}" type="text" placeholder="Address">
                                </div>
                                <div class="col-md-12">
                                    <button class="btn">განახლება</button>
                                    <br><br>
                                </div>
                            </form>
                            <h4>Password change</h4>
                            <form action={{route('passwordChange',app()->getLocale())}} class="row" method="POST">
                            {{ method_field('PUT') }}
                            @csrf
                                <div class="col-md-12">
                                    <input value="{{old('password')}}" name="password" class="form-control" type="password" placeholder="Current Password">
                                    @error('password')
                                            <span class="error-text" role="alert">{{ $message }}</span>
                                     @enderror                                </div>
                                <div class="col-md-6">
                                    <input name="new_password" class="form-control" type="password" placeholder="New Password">
                                    @error('new_password')
                                            <span class="error-text" role="alert">{{ $message }}</span>
                                     @enderror
                                </div>
                                <div class="col-md-6">
                                    <input name="new_password_repeat" class="form-control" type="password" placeholder="Confirm Password">
                                    @error('new_password_repeat')
                                            <span class="error-text" role="alert">{{ $message }}</span>
                                     @enderror
                                </div>
                                <div class="col-md-12">
                                    <button class="btn">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
