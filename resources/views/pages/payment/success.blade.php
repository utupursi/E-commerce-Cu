@extends('layouts.base')
@section('head')
    <title>Volta - fail transaction</title>
@endsection
@section('content')
<main>

    <!-- section 1 -   --->
    <section id="success-fail">

        <div class="container">
            <div class="success-fail__wrapper">
                <img src="/img/success.png" alt="" class="success-fail__img">

                <h2 class="success-fail__heading">{{__('client.success_transaction')}}</h2>

                <p class="success-fail__p">
                    {{$message}}
                </p>

                <a href="{{route('welcome',app()->getLocale())}}" class="success-fail__link">
                    {{__('client.go_back')}}
                </a>
            </div>
        </div>
    </section>
</main>
<!-- footer-->


@endsection