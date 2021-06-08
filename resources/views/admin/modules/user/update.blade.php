@extends('admin.layouts.app')
@section('content')
    <input name="old-images[]" id="old_images" hidden disabled value="{{$user->files}}">
    {!! Form::open(['url' => route('userUpdate',[app()->getLocale(),$user->id]),'method' =>'put','files'=>true]) !!}
    <div class="content-box">
        <div class="row">
            <div class="col-lg-6">
                <div class="element-wrapper">
                    <h6 class="element-header">
                        @lang('admin.update_user')
                    </h6>
                    <div class="element-box">
                        <div class="row">
                            <div class="col-6">
                                <div
                                        class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    {{ Form::label('first_name', 'First Name', []) }}
                                    {{ Form::text('first_name',(count($user->availableLanguage) > 0) ? $user->availableLanguage[0]->first_name : '', ['class' => 'form-control', 'no','placeholder'=>'Enter First Name']) }}
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                    {{ $errors->first('first_name') }}
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div
                                        class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    {{ Form::label('last_name', 'Last Name', []) }}
                                    {{ Form::text('last_name', (count($user->availableLanguage) > 0) ? $user->availableLanguage[0]->last_name : '', ['class' => 'form-control', 'no','placeholder'=>'Enter Last Name']) }}
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            {{ $errors->first('last_name') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div
                                        class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    {{ Form::label('phone', 'Phone', []) }}
                                    {{ Form::text('phone', $user->phone, ['class' => 'form-control', 'no','placeholder'=>'Enter Phone']) }}
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                    {{ $errors->first('phone') }}
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div
                                        class="form-group {{ $errors->has('id_number') ? ' has-error' : '' }}">
                                    {{ Form::label('id_number', 'Personal ID', []) }}
                                    {{ Form::text('id_number', $user->id_number, ['class' => 'form-control', 'no','placeholder'=>'Enter Personal ID']) }}
                                    @if ($errors->has('id_number'))
                                        <span class="help-block">
                                            {{ $errors->first('id_number') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div
                                        class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                    {{ Form::label('address', 'Address', []) }}
                                    {{ Form::text('address', (count($user->availableLanguage) > 0) ? $user->availableLanguage[0]->address : '', ['class' => 'form-control', 'no','placeholder'=>'Enter Address']) }}
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            {{ $errors->first('address') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div
                                        class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                                    {{ Form::label('role', 'Role', []) }}
                                    {{ Form::select('role',(count($rolesArray) > 0) ? $rolesArray : [],$user->roles[0]->id,  ['class' => 'form-control', 'no']) }}
                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                            {{ $errors->first('role') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div
                                        class="form-group {{ $errors->has('phone_1') ? ' has-error' : '' }}">
                                    {{ Form::label('phone_1', 'Phone 1', []) }}
                                    {{ Form::text('phone_1',($user->profile != null ? $user->profile->phone_1 : ''),  ['class' => 'form-control', 'no']) }}
                                    @if ($errors->has('phone_1'))
                                        <span class="help-block">
                                            {{ $errors->first('phone_1') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div
                                        class="form-group {{ $errors->has('phone_2') ? ' has-error' : '' }}">
                                    {{ Form::label('phone_2', 'Phone 2', []) }}
                                    {{ Form::text('phone_2',($user->profile != null ? $user->profile->phone_2 : ''),  ['class' => 'form-control', 'no']) }}
                                    @if ($errors->has('phone_2'))
                                        <span class="help-block">
                                            {{ $errors->first('phone_2') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div
                                        class="form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                    {{ Form::label('birthday', 'Birthday', []) }}
                                    {{ Form::text('birthday', ($user->profile != null ? \Carbon\Carbon::parse($user->profile->birthday)->format('m/d/Y') : ''), ['class' => 'form-control single-daterange', 'no','placeholder'=>'Enter Birthday']) }}
                                    @if ($errors->has('birthday'))
                                        <span class="help-block">
                                    {{ $errors->first('birthday') }}
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div
                                        class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    {{ Form::label('email', 'Email', []) }}
                                    {{ Form::email('email', $user->email, ['class' => 'form-control', 'no','placeholder'=>'Enter Email']) }}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div
                                        class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    {{ Form::label('password', 'Password', []) }}
                                    {{ Form::password('password', ['class' => 'form-control', 'no','autocomplete' => 'off']) }}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                    {{ $errors->first('password') }}
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div
                                        class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    {{ Form::label('password_confirmation', 'Password Confirmation', []) }}
                                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'no','autocomplete' => 'off']) }}
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            {{ $errors->first('password_confirmation') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <label class="form-check-label"><input class="form-check-input" name="status" {{($user->status) ? 'checked' : ''}}
                                                                           type="checkbox">Status</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-buttons-w">
                            <button class="btn btn-primary" type="submit"> Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="element-wrapper">
                    <h6 class="element-header" style="padding-top: 16px;">
                    </h6>
                    <div class="element-box">
                        <div class="form-group">
                            <div class="input-images"></div>
                            @if ($errors->has('images'))
                                <span class="help-block">
                                            {{ $errors->first('images') }}
                                        </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
