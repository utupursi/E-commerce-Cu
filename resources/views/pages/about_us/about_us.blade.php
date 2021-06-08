@extends('layouts.base')
@section('head')
    <title>{{(count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->meta_title : ''}}</title>
@endsection
@section('content')
    <main>
        <!-- section 1 -   --->
        <section id="about-us">
            <div class="container">
                <h2 class="volta-multypage-heading">{{(count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->title : ''}}</h2>

                <div class="about-us__text">
                    {!! (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->content : '' !!}
                </div>


            </div>

        </section>
    </main>
@endsection