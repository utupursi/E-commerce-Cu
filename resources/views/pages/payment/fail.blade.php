@extends('layouts.base')
@section('head')
    <title>Volta - Success transaction</title>
@endsection
@section('content')
    <!-- header -->
    <main>
        <!-- section 1 -   --->
        <section id="success-fail">

            <div class="container">
                <div class="success-fail__wrapper fail">
                    <img src="/img/failure.png" alt="" class="success-fail__img">

                    <h2 class="success-fail__heading">{{__('client.fail_transaction')}}</h2>

                    <p class="success-fail__p">
                        {{__('client.fail_transaction_message')}}
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