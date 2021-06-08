@extends('layouts.base')
@section('head')
    <title>{{(count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->meta_title : ''}}</title>
@endsection
@section('content')
    <main>

        <!-- section 1 - privacy policy --->
        <section id="privacy-policy">
            <div class="container">
                <h2 class="volta-multypage-heading">{{(count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->description : ''}}</h2>

                <div class="privacy-policy__wrapper">
                    {!! (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->content : '' !!}
                </div>
            </div>
        </section>


    </main>

@endsection