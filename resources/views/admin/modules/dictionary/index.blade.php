@extends('admin.layouts.app')
@section('content')
    {!! Form::open(['url' => route('DictionaryIndex', $locale),'method' =>'get']) !!}
    <div class="controls-above-table">
        <div class="row">
            <div class="col-sm-2">
                <a class="btn btn-lg btn-success"
                   href="{{route('DictionaryCreate',$locale)}}">@lang('admin.create_dictionary')</a>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-lg btn-warning"
                   href="{{route('languageScanner', $locale)}}">@lang('admin.rescan')</a>
            </div>
            <div class="col-sm-8 per-page-column">
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
                <th>@lang('admin.key')</th>
                <th>@lang('admin.module')</th>
                <th>@lang('admin.translations')</th>
                <th>
                    @lang('admin.actions')
                </th>
            </tr>
            <tr>
                <th>
                    {{ Form::text('key',Request::get('key'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @error('key')
                    <span class="help-block">
                        {{$message}}
                        </span>
                    @enderror
                </th>
                <th>
                    {{ Form::text('module',Request::get('module'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @error('module')
                    <span class="help-block">
                        {{$message}}
                        </span>
                    @enderror
                </th>
                <th>
                    {{ Form::text('language',Request::get('language'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @error('language')
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
            @if($dictionaries)
                @foreach($dictionaries as $item)
                    <tr>
                        <td class="text-center">
                            {{$item->key}}
                        </td>
                        <td class="text-center">
                            {{$item->module}}
                        </td>
                        <td>
                            <div class="os-tabs-w">
                                <div class="os-tabs-controls">
                                    <ul class="nav nav-tabs smaller">
                                        @foreach ($langs as $key => $lang)
                                            <?php $dictionary = $item->language()->where('language_id', $lang->id)->first(); ?>
                                            <li class="nav-item">
                                                <a class="nav-link {{($key == 0) ? 'active' : ''}}" data-toggle="tab"
                                                   href="#{{$lang->abbreviation}}-{{($dictionary != null) ? $dictionary->id : '-'}}">{{$lang->abbreviation}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    @foreach($langs as $key => $lang)
                                        <?php $dictionary = $item->language()->where('language_id', $lang->id)->first(); ?>
                                        <div class="tab-pane {{($key == 0) ? 'active' : ''}}" id="{{$lang->abbreviation}}-{{($dictionary != null) ? $dictionary->id : '-'}}">
                                            <div class="el-tablo">
                                                {{($dictionary != null) ? $dictionary->value : ''}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                        <td class="row-actions ">
                            <div class="flex items-center">

                                <a href="{{route('DictionaryShow',[$locale,$item->id])}}">
                                    <i class="os-icon os-icon-documents-07"></i>
                                </a>
                                <a href="{{route('DictionaryEdit', [$locale, $item->id])}}">
                                    <i class="os-icon os-icon-ui-49">

                                    </i>
                                </a>
                                <form action="{{route('DictionaryDestroy', [$locale, $item->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" type="submit">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                            <path fill-rule="evenodd"
                                                  d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    {{ $dictionaries->links('admin.vendor.pagination.custom') }}

@endsection
