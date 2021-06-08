@extends('layouts.base')
@section('head')
    <title>{{(count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->meta_title : ''}}</title>
@endsection
@section('content')
    <main>

        <!-- section 1 -  payment-infos --->
        <section id="payment-info">
            <div class="container">
                <h2 class="volta-multypage-heading">{{(count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->title : ''}}</h2>

                <h3 class="payment-info__subheading">{{(count($page->availableLanguage) > 0) ? $page->availableLanguage[0]->description : ''}}</h3>

                <div class="payment-info__methods">

                    <div class="payment-info__method">
                        <div class="payment-info__m-i">
                            <img src="/img/pay-infos-1.png" alt="">
                        </div>
                        <h3 class="payment-info__m-name">
                            {{__('client.pay_by_cash')}}
                        </h3>
                        <p class="payment-info__m-p">
                            {{$sitePayByCash}}
                        </p>

                    </div>

                    <div class="payment-info__method">
                        <div class="payment-info__m-i">
                            <img src="/img/pay-infos-2.png" alt="">
                        </div>
                        <h3 class="payment-info__m-name">
                            {{__('client.transfer')}}
                        </h3>
                        <p class="payment-info__m-p">
                            {{$siteTransfer}}
                        </p>

                    </div>

                    <div class="payment-info__method">
                        <div class="payment-info__m-i">
                            <img src="/img/pay-infos-3.png" alt="">
                        </div>
                        <h3 class="payment-info__m-name">
                            {{__('client.payment_by_card')}}
                        </h3>
                        <p class="payment-info__m-p">
                            {{$sitePaymentByCard}}
                        </p>

                    </div>

                    <div class="payment-info__method">
                        <div class="payment-info__m-i">
                            <img src="/img/pay-infos-4.png" alt="">
                        </div>
                        <h3 class="payment-info__m-name">
                            {{__('client.bank_installment')}}
                        </h3>
                        <p class="payment-info__m-p">
                            {{$siteBankInstallment}}
                        </p>

                    </div>

                    <div class="payment-info__method">
                        <div class="payment-info__m-i">
                            <img src="/img/pay-infos-5.png" alt="">
                        </div>
                        <h3 class="payment-info__m-name">
                            {{__('client.internal_installment')}}
                        </h3>
                        <p class="payment-info__m-p">
                            {{$siteInternalInstallment}}
                        </p>

                    </div>
                </div>

                <h2 class="volta-multypage-heading">{{__('client.our_partner_banks')}}</h2>

                <div class="partner-banks-wrap">

                    <div class="partner-banks__col ">
                        <div class="partner-banks__img tbc">
                            <img src="/img/info-tbc.png" alt="">
                        </div>
                        <h3 class="partner-banks__name">{{__('client.tbc_bank')}}</h3>
                    </div>

                    <div class="partner-banks__col ">
                        <div class="partner-banks__img credo">
                            <img src="/img/info-credo.png" alt="">
                        </div>
                        <h3 class="partner-banks__name">{{__('client.credo_bank')}}</h3>
                    </div>

                    <div class="partner-banks__col ">
                        <div class="partner-banks__img bog">
                            <img src="/img/info-bog.png" alt="">
                        </div>
                        <h3 class="partner-banks__name">{{__('client.bog_bank')}}</h3>
                    </div>

                </div>

                <h2 class="volta-multypage-heading">{{__('client.requisites')}}</h2>

                <!-- account numbers -->
                <div class="bank-acc-accordion">
                    <button class="bank-acc-accordion__btn open">
                        {{__('client.requisite')}} 1
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.465" height="11.733" viewBox="0 0 20.465 11.733">
                            <path id="Icon_feather-chevron-down" data-name="Icon feather-chevron-down" d="M9,13.5l8.111,8.111L25.223,13.5" transform="translate(-6.879 -11.379)" fill="none" stroke="#636363" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                        </svg>
                    </button>

                    <div class="bank-acc-accordion__content open">
                        {{$siteRequisiteOne}}
                    </div>
                </div>

                <div class="bank-acc-accordion">
                    <button class="bank-acc-accordion__btn">
                        {{__('client.requisite')}} 2
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.465" height="11.733" viewBox="0 0 20.465 11.733">
                            <path id="Icon_feather-chevron-down" data-name="Icon feather-chevron-down" d="M9,13.5l8.111,8.111L25.223,13.5" transform="translate(-6.879 -11.379)" fill="none" stroke="#636363" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                        </svg>
                    </button>

                    <div class="bank-acc-accordion__content ">
                        {{$siteRequisiteTwo}}
                    </div>
                </div>

            </div>

        </section>

    </main>
@endsection