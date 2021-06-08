@extends('layouts.base')
@section('head')
    <title>{{(count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->meta_title : ''}}</title>
@endsection
@section('content')
    <main>

        <!-- section 1 - delivery-info --->
        <section id="contact-us">

            <div class="container">

                <h2 class="volta-multypage-heading">{{(count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->title : ''}}</h2>

                <div class="contact-us__wrapper">

                    <div class="contact-us__left">
                        <h2>{{(count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->description : ''}}</h2>

                        <p class="contact-us__left-p">{!! (count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->content : '' !!}</p>

                        <div class="contact-info-box">
                            <i class="flex-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21.15" height="21.15"
                                     viewBox="0 0 21.15 21.15">
                                    <path id="Icon_awesome-phone-alt" data-name="Icon awesome-phone-alt"
                                          d="M20.547,14.946,15.92,12.963a.991.991,0,0,0-1.157.285l-2.049,2.5a15.312,15.312,0,0,1-7.32-7.32L7.9,6.383a.989.989,0,0,0,.285-1.157L6.2.6A1,1,0,0,0,5.064.025l-4.3.991A.991.991,0,0,0,0,1.983,19.165,19.165,0,0,0,19.167,21.15a.991.991,0,0,0,.967-.768l.991-4.3a1,1,0,0,0-.579-1.14Z"
                                          transform="translate(0 0)"></path>
                                </svg>
                            </i>
                            {{$phone}}
                        </div>

                        <div class="contact-info-box">
                            <i class="flex-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.5" height="15.577"
                                     viewBox="0 0 22.5 15.577">
                                    <g id="Icon_ionic-ios-mail" data-name="Icon ionic-ios-mail"
                                       transform="translate(-3.375 -7.875)">
                                        <path id="Path_171" data-name="Path 171"
                                              d="M25.691,10.347l-5.82,5.928a.1.1,0,0,0,0,.151l4.073,4.338a.7.7,0,0,1,0,1,.705.705,0,0,1-1,0l-4.056-4.322a.111.111,0,0,0-.157,0l-.99,1.006a4.355,4.355,0,0,1-3.1,1.309,4.442,4.442,0,0,1-3.169-1.347l-.952-.968a.111.111,0,0,0-.157,0L6.306,21.759a.705.705,0,0,1-1,0,.7.7,0,0,1,0-1l4.073-4.338a.115.115,0,0,0,0-.151L3.559,10.347a.107.107,0,0,0-.184.076V22.284a1.736,1.736,0,0,0,1.731,1.731H24.144a1.736,1.736,0,0,0,1.731-1.731V10.423A.108.108,0,0,0,25.691,10.347Z"
                                              transform="translate(0 -0.563)"></path>
                                        <path id="Path_172" data-name="Path 172"
                                              d="M14.821,17.778a2.94,2.94,0,0,0,2.115-.887l8.486-8.638a1.7,1.7,0,0,0-1.071-.379H5.3a1.689,1.689,0,0,0-1.071.379l8.486,8.638A2.941,2.941,0,0,0,14.821,17.778Z"
                                              transform="translate(-0.196)"></path>
                                    </g>
                                </svg>
                            </i>
                            {{$contact_email}}
                        </div>

                        <div class="contact-info-box">
                            <i class="flex-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20.25" height="29.25"
                                     viewBox="0 0 20.25 29.25">
                                    <path id="Icon_ionic-ios-pin" data-name="Icon ionic-ios-pin"
                                          d="M18,3.375c-5.59,0-10.125,4.212-10.125,9.4C7.875,20.088,18,32.625,18,32.625S28.125,20.088,28.125,12.776C28.125,7.587,23.59,3.375,18,3.375ZM18,16.8a3.3,3.3,0,1,1,3.3-3.3A3.3,3.3,0,0,1,18,16.8Z"
                                          transform="translate(-7.875 -3.375)"></path>
                                </svg>

                            </i>
                            {{$address}}
                        </div>

                    </div>
                    {!! Form::open(['url' => route('ContactUs',[app()->getLocale()]),'method' =>'post','class' =>'contact-us__form']) !!}

                    <input type="text" name="full_name" placeholder="{{__('client.full_name')}}">
                    @if ($errors->has('full_name'))
                        <div class="error-message show"><h2>{{ $errors->first('full_name') }}</h2></div>
                    @endif <input type="text" name="email" placeholder="{{__('client.email')}}">
                    @if ($errors->has('email'))
                        <div class="error-message show"><h2>{{ $errors->first('email') }}</h2></div>
                    @endif
                    <input type="text" name="subject" placeholder="{{__('client.subject')}}">
                    @if ($errors->has('subject'))
                        <div class="error-message show"><h2>{{ $errors->first('subject') }}</h2></div>
                    @endif
                    <textarea placeholder="{{__('client.message')}}" name="message" id="" cols="30"
                              rows="10"></textarea>
                    @if ($errors->has('message'))
                        <div class="error-message show"><h2>{{ $errors->first('message') }}</h2></div>
                    @endif
                    <button class="contact-form-submit">
                        {{__('client.send')}}
                    </button>
                    {!! Form::close() !!}
                </div>

            </div>

        </section>


    </main>
@endsection