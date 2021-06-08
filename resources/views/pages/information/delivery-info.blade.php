@extends('layouts.base')
@section('head')
    <title>{{(count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->meta_title : ''}}</title>
@endsection
@section('content')
    <main>
        <!-- section 1 - delivery-info --->
        <section id="delivery-info">
            <div class="container">
                <h2 class="volta-multypage-heading">{{(count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->desription : ''}}</h2>
                <div class="delivery-info__text">
                    {!! (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->content : '' !!}
                </div>
            </div>
        </section>
    </main>
@endsection