@extends('layouts.base')

@section('content')

                <div class="login">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <form class="login-form" method="POST" action="{{route('login',app()->getLocale())}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>E-mail / Username</label>
                                            <input name="email" class="form-control" type="text" value="{{old('email')}}" placeholder="E-mail / Username">
                                            @error('email')
                                            <span class="error-text" role="alert">{{ $message }}</span>
                                            @enderror
                                            @error('auth')
                                            <span class="error-text">{{$errors->first('auth')}}</span>
                                            @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label>Password</label>
                                            <input name="password" class="form-control" type="password" placeholder="Password">
                                            @error('password')
                                            <span class="error-text" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="custom-control custom-checkbox">--}}
{{--                                                <input name="password" type="checkbox" class="custom-control-input" value="{{old('password')}}" id="newaccount">--}}
{{--                                                <label class="custom-control-label" for="newaccount">Keep me signed in</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-md-12">
                                            <button class="btn">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
@endsection
