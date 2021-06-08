@extends('admin.layouts.app')
@section('content')
    <div class="content-i">
        <div class="content-box"><div class="element-wrapper">
                <h6 class="element-header">
                    {{ $setting->key }}
                </h6>

                <div class="row">
                    <div class="col-2">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th>@lang('admin.key')</th>
                                <td>
                                    {{ $setting->key }}
                                </td>
                            </tr>
                            <tr>
                                <th>@lang('admin.value')</th>
                                <td>
                                    {{ (count($setting->availableLanguage) > 0) ? $setting->availableLanguage[0]->value : '' }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

        </div>
    </div>

@endsection
