@extends('layouts.base')

@section('content')

    <div class="login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <form class="register-form" method="POST" action="{{route('Register',app()->getLocale())}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>სახელი</label>
                                <input value="{{old('first_name')}}" class="form-control {{$errors->has('first_name')?"invalid":""}}" name="first_name" type="text" placeholder="სახელი">
                                @if ($errors->has('first_name'))
                                    <span
                                        class="error-text">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label>გვარი</label>
                                <input value="{{old('last_name')}}" class="form-control {{$errors->has('last_name')?"invalid":""}}" name="last_name" type="text" placeholder="გვარი">
                                @if ($errors->has('last_name'))
                                    <span
                                        class="error-text">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label>ელ.ფოსტა</label>
                                <input value="{{old('email')}}" name="email" class="form-control {{$errors->has('email')?"invalid":""}}" type="text" placeholder="ელ.ფოსტა">
                                @if ($errors->has('email'))
                                    <span
                                        class="error-text">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label>პაროლი</label>
                                <input name="password" class="form-control {{$errors->has('password')?"invalid":""}} " type="password" placeholder="პაროლი">
                                @if ($errors->has('password'))
                                    <span
                                        class="error-text">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label>გაიმეორე პაროლი</label>
                                <input  name="password_repeat" class="form-control {{$errors->has('password_repeat')?"invalid":""}}" type="password" placeholder="გაიომეორე პაროლი">
                                @if ($errors->has('password_repeat'))
                                    <span
                                        class="error-text">{{ $errors->first('password_repeat') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <button class="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
