@extends('admin.layouts.app')
@section('content')
    {!! Form::open(['url' => route('userIndex',app()->getLocale()),'method' =>'get']) !!}
    <div class="controls-above-table">
        <div class="row">
            <div class="col-sm-2">
                <a class="btn btn-lg btn-success" href="{{route('userCreateView',app()->getLocale())}}">@lang('admin.create_users')</a>
            </div>
            <div class="col-sm-10 per-page-column">
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
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <tr>
                <th>
                    {{ Form::text('id',Request::get('id'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('id'))
                        <span class="help-block">
                        {{ $errors->first('id') }}
                        </span>
                    @endif
                </th>
                <th>
                    {{ Form::text('first_name',Request::get('first_name'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('first_name'))
                        <span class="help-block">
                        {{ $errors->first('first_name') }}
                        </span>
                    @endif
                </th>
                <th>
                    {{ Form::text('last_name',Request::get('last_name'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('last_name'))
                        <span class="help-block">
                        {{ $errors->first('last_name') }}
                        </span>
                    @endif
                </th>
                <th>
                    {{ Form::email('email',Request::get('email'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('email'))
                        <span class="help-block">
                        {{ $errors->first('email') }}
                        </span>
                    @endif
                </th>
                <th>
                    {{ Form::select('status',['' => 'All','1' => 'Active','0' => 'Not Active'],Request::get('status'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('status'))
                        <span class="help-block">
                        {{ $errors->first('status') }}
                        </span>
                    @endif
                </th>
                <th>
                    {{ Form::select('role',$rolesArray,Request::get('role'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('role'))
                        <span class="help-block">
                        {{ $errors->first('role') }}
                        </span>
                    @endif
                </th>
                <th></th>
            </tr>
            </thead>
            {!! Form::close() !!}
            <tbody>
            @if($users)
                @foreach($users as $user)
                    <tr>
                        <td class="text-left">{{$user->id}}</td>
                        <td class="text-center">{{(count($user->availableLanguage) > 0) ?  $user->availableLanguage[0]->first_name : ''}}</td>
                        <td class="text-center">{{(count($user->availableLanguage) > 0) ?  $user->availableLanguage[0]->last_name : ''}}</td>
                        <td class="text-center">{{$user->email}}</td>
                        <td class="text-center">
                            @if($user->status)
                                <span class="text-green">Active</span>
                            @else
                                <span class="text-red">Not Active</span>
                            @endif
                        </td>
                        <td class="text-center">
                                <span class="text-green">{{(count($user->roles) > 0) ? $user->roles[0]->name : ''}}</span>
                        </td>
                        <td class="row-actions d-flex">
                            <a href="{{route('userShow',[app()->getLocale(),$user->id])}}">
                                <i class="os-icon os-icon-documents-07"></i>
                            </a>
                            <a href="{{route('userEditView',[app()->getLocale(), $user->id])}}">
                                <i class="os-icon os-icon-ui-49">

                                </i>
                            </a>
                            {!! Form::open(['url' => route('userDestroy',[app()->getLocale(),$user->id]),'method' =>'delete']) !!}
                                <button class="delete-icon" onclick="return confirm('Are you sure, you want to delete this item?!');" type="submit">
                                    <i
                                        class="os-icon os-icon-ui-15">
                                    </i>
                                </button>
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    {{ $users->links('admin.vendor.pagination.custom') }}

@endsection
