
@extends('admin.layouts.app')
@section('content')
    {!! Form::open(['url' => route('NewsIndex', $locale),'method' =>'get']) !!}
    <div class="controls-above-table">
        <div class="row">
            <div class="col-sm-2">
                <a class="btn btn-lg btn-success" href="{{route('NewsCreate',$locale)}}">@lang('admin.create_news')</a>
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
                <th>@lang('news.id')</th>
                <th>@lang('news.positon')</th>
                <th>@lang('news.slug')</th>
                <th>@lang('news.title')</th>
                <th>@lang('news.description')</th>

            <th>
                @lang('admin.permissions')
            </th>
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
                    {{ Form::text('position',Request::get('position'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @error('position')
                        <span class="help-block">
                        {{$message}}
                        </span>
                    @enderror
                </th>
                <th>
                    {{ Form::text('slug',Request::get('slug'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @error('slug')
                        <span class="help-block">
                        {{$message}}
                        </span>
                    @enderror
                </th>
                <th>
                    {{ Form::text('title',Request::get('title'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @error('title')
                        <span class="help-block">
                        {{$message}}
                        </span>
                    @enderror
                </th>
                <th>
                    {{ Form::text('module',Request::get('description'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
                    @error('description')
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
            @if($news)
                @foreach($news as $item)
                    <tr>
                        <td class="text-center">
                            {{$item->id}}
                        </td>
                        <td class="text-center">
                            {{$item->position}}
                        </td>
                        <td class="text-center">
                            {{$item->slug}}
                        </td>
                        <td class="text-center">
                            {{$item->language()->where('language_id', $localization)->first()->title ?? ''}}
                        </td>
                        <td class="text-center">
                            {{$item->language()->where('language_id', $localization)->first()->description ?? ''}}
                        </td>
                      
                        <td class="row-actions ">
                           <div class="flex items-center">
                               
                            <a href="{{route('NewsShow',[$locale,$item->id])}}">
                                <i class="os-icon os-icon-documents-07"></i>
                            </a>
                            <a href="{{route('NewsEdit', [$locale, $item->id])}}">
                                <i class="os-icon os-icon-ui-49">

                                </i>
                            </a>
                            <form action="{{route('NewsDestroy', [$locale, $item->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"  type="submit">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                        <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
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
    {{ $news->links('admin.vendor.pagination.custom') }}

@endsection
