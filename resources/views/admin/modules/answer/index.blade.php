



@extends('admin.layouts.app')
@section('content')
    {!! Form::open(['url' => route('AnswerIndex',$locale),'method' =>'get']) !!}
    <div class="controls-above-table">
        <div class="row">
            <div class="col-sm-2">
                <a class="btn btn-lg btn-success" href="{{route('AnswerCreate',$locale)}}">@lang('admin.create_answer')</a>
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
                <th>
                    @lang('admin.feature')
                </th>
                <th>
                    @lang('admin.title')
                </th>
                <th>
                    @lang('admin.position')
                </th>
                <th>
                    @lang('admin.slug')
                </th>
                <th>
                    @lang('admin.status')
                </th>
                <th>
                    @lang('admin.permission')
                </th>
            </tr>
            <tr>
                <th>
                    <select name="feature" class="w-full border p-1 font-normal text-xs" >
                        <option value="" selected></option>
                        @foreach ($features as $feature)
                        <option value="{{$feature->id}}" {{(\Request::get('feature') == $feature->id) ? 'selected' : ''}}>{{($feature->language()->where('language_id', $localization)->first()->title) ?? $feature->language()->first()->title}}</option>
                        @endforeach
                    </select>
                    @error('feature')
                        <span class="help-block">
                        {{ $message }}
                        </span>
                    @enderror
                </th>
                <th>
                    {{ Form::text('title',Request::get('title'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('title'))
                        <span class="help-block">
                        {{ $errors->first('title') }}
                        </span>
                    @endif
                </th>
                <th>
                    {{ Form::text('position',Request::get('position'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('position'))
                        <span class="help-block">
                        {{ $errors->first('position') }}
                        </span>
                    @endif
                </th>
                <th>
                    {{ Form::text('slug',Request::get('slug'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @if ($errors->has('slug'))
                        <span class="help-block">
                        {{ $errors->first('slug') }}
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
                <th></th>
            </tr>
            </thead>
            {!! Form::close() !!}
            <tbody>
            @if($answers)
                @foreach($answers as $item)
                    <tr>
                        <td>
                            {{ $item->feature ? ($item->feature->feature->language()->where('language_id', $localization)->first()->title ?? '') : ''}}
                        </td>
                        <td>
                            {{($item->language()->where('language_id', $localization)->first()->title) ?? ''}}
                        </td>
                        <td>
                            {{$item->position}}
                        </td>
                        <td>
                            {{$item->slug}}
                        </td>
                        <td class="text-center">
                            @if($feature->status)
                            <span class="text-green">@lang('admin.on')</span>
                        @else
                            <span class="text-red">@lang('admin.off')</span>
                            @endif
                        </td>
                        <td class="row-actions d-flex">
                            <a href="{{route('AnswerShow',[$locale,$item->id])}}">
                                <i class="os-icon os-icon-documents-07"></i>
                            </a>
                            <a href="{{route('AnswerEdit',[$locale, $item->id])}}">
                                <i class="os-icon os-icon-ui-49">

                                </i>
                            </a>

                            <form action="{{route('AnswerDestroy', [$locale, $item->id])}}"  method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" >
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                        <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                      </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    {{ $answers->links('admin.vendor.pagination.custom') }}

@endsection
