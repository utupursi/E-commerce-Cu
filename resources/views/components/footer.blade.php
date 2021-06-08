<footer id="footer">
    <div class="footer__top">
        <div class="footer__color"></div>
        <div class="footer__color"></div>
        <div class="footer__color"></div>
        <div class="footer__color"></div>
        <div class="footer__color"></div>
        <div class="footer__color"></div>
    </div>

    <div class="container">
        <div class="footer__col">

            <a href="{{route('welcome',app()->getLocale())}}" class="footer__brand">
                <img src="/img/icons/logovolta-fff.svg" alt="">
            </a>

            <p class="footer__about-site">
                {{__('client.the_largest_internet_mall_in_georgia')}}
            </p>

            <div class="footer__social">
                <a href="{{$siteFacebook}}" target="blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12.731" height="23.771" viewBox="0 0 12.731 23.771">
                        <path id="Icon_awesome-facebook-f" data-name="Icon awesome-facebook-f" d="M13.506,13.371l.66-4.3H10.039V6.277a2.151,2.151,0,0,1,2.425-2.324h1.877V.291A22.884,22.884,0,0,0,11.01,0C7.61,0,5.388,2.06,5.388,5.79V9.069H1.609v4.3H5.388v10.4h4.651v-10.4Z" transform="translate(-1.609)" />
                    </svg>
                    <span>
                        {{__('client.text_facebook')}}
                       </span>
                </a>
                <a href="{{$siteInstagram}}" target="blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18.788" height="18.784" viewBox="0 0 18.788 18.784">
                        <path id="Icon_awesome-instagram" data-name="Icon awesome-instagram" d="M9.391,6.814a4.816,4.816,0,1,0,4.816,4.816A4.808,4.808,0,0,0,9.391,6.814Zm0,7.947a3.131,3.131,0,1,1,3.131-3.131,3.137,3.137,0,0,1-3.131,3.131Zm6.136-8.144A1.123,1.123,0,1,1,14.4,5.493,1.121,1.121,0,0,1,15.527,6.617Zm3.19,1.14A5.559,5.559,0,0,0,17.2,3.821,5.6,5.6,0,0,0,13.264,2.3c-1.551-.088-6.2-.088-7.75,0A5.587,5.587,0,0,0,1.578,3.817,5.577,5.577,0,0,0,.061,7.753c-.088,1.551-.088,6.2,0,7.75a5.559,5.559,0,0,0,1.517,3.936,5.6,5.6,0,0,0,3.936,1.517c1.551.088,6.2.088,7.75,0A5.559,5.559,0,0,0,17.2,19.438,5.6,5.6,0,0,0,18.717,15.5c.088-1.551.088-6.195,0-7.746Zm-2,9.41a3.17,3.17,0,0,1-1.786,1.786c-1.236.49-4.17.377-5.537.377s-4.3.109-5.537-.377a3.17,3.17,0,0,1-1.786-1.786c-.49-1.236-.377-4.17-.377-5.537s-.109-4.3.377-5.537A3.17,3.17,0,0,1,3.854,4.307c1.236-.49,4.17-.377,5.537-.377s4.3-.109,5.537.377a3.17,3.17,0,0,1,1.786,1.786c.49,1.236.377,4.17.377,5.537S17.2,15.934,16.713,17.166Z" transform="translate(0.005 -2.238)" />
                    </svg>

                    <span>
                         {{__('client.text_instagram')}}
                    </span>
                </a>
            </div>
        </div>

        <div class="footer__col">
            <h2 class="footer__heading">{{__('client.company')}}</h2>
            <a href="{{route('AboutUs',app()->getLocale())}}">{{__('client.about_us')}}</a>
            <a href="{{route('ContactUs',app()->getLocale())}}">{{__('client.contact')}}</a>
{{--            <a href="{{route('Catalogue',app()->getLocale())}}">კატალოგი</a>--}}
        </div>

        <div class="footer__col">
            <h2 class="footer__heading">{{__('client.information')}}</h2>
            <a href="{{route('deliveryInfo',app()->getLocale())}}">{{__('client.delivery_terms')}}</a>
            <a href="{{route('privacyPolicy',app()->getLocale())}}">{{__('client.privacy_policy')}}</a>
            <a href="{{route('paymentInfo',app()->getLocale())}}">{{__('client.payment')}}</a>
            <a href="{{route('warranty',app()->getLocale())}}">{{__('client.warranty_conditions')}}</a>
        </div>

        <div class="footer__col">
            <h2 class="footer__heading">{{__('client.contact_us')}}</h2>

            <!-- info with icons -->
            <div class="info-flexbox">
                <i class="flex-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21.15" height="21.15" viewBox="0 0 21.15 21.15">
                        <path id="Icon_awesome-phone-alt" data-name="Icon awesome-phone-alt" d="M20.547,14.946,15.92,12.963a.991.991,0,0,0-1.157.285l-2.049,2.5a15.312,15.312,0,0,1-7.32-7.32L7.9,6.383a.989.989,0,0,0,.285-1.157L6.2.6A1,1,0,0,0,5.064.025l-4.3.991A.991.991,0,0,0,0,1.983,19.165,19.165,0,0,0,19.167,21.15a.991.991,0,0,0,.967-.768l.991-4.3a1,1,0,0,0-.579-1.14Z" transform="translate(0 0)"/>
                    </svg>
                </i>
                {{$phone }}
            </div>

            <div class="info-flexbox">
                <i class="flex-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22.5" height="15.577" viewBox="0 0 22.5 15.577">
                        <g id="Icon_ionic-ios-mail" data-name="Icon ionic-ios-mail" transform="translate(-3.375 -7.875)">
                            <path id="Path_171" data-name="Path 171" d="M25.691,10.347l-5.82,5.928a.1.1,0,0,0,0,.151l4.073,4.338a.7.7,0,0,1,0,1,.705.705,0,0,1-1,0l-4.056-4.322a.111.111,0,0,0-.157,0l-.99,1.006a4.355,4.355,0,0,1-3.1,1.309,4.442,4.442,0,0,1-3.169-1.347l-.952-.968a.111.111,0,0,0-.157,0L6.306,21.759a.705.705,0,0,1-1,0,.7.7,0,0,1,0-1l4.073-4.338a.115.115,0,0,0,0-.151L3.559,10.347a.107.107,0,0,0-.184.076V22.284a1.736,1.736,0,0,0,1.731,1.731H24.144a1.736,1.736,0,0,0,1.731-1.731V10.423A.108.108,0,0,0,25.691,10.347Z" transform="translate(0 -0.563)" />
                            <path id="Path_172" data-name="Path 172" d="M14.821,17.778a2.94,2.94,0,0,0,2.115-.887l8.486-8.638a1.7,1.7,0,0,0-1.071-.379H5.3a1.689,1.689,0,0,0-1.071.379l8.486,8.638A2.941,2.941,0,0,0,14.821,17.778Z" transform="translate(-0.196)" />
                        </g>
                    </svg>
                </i>
                {{$contact_email}}
            </div>

            <div class="info-flexbox">
                <i class="flex-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20.25" height="29.25" viewBox="0 0 20.25 29.25">
                        <path id="Icon_ionic-ios-pin" data-name="Icon ionic-ios-pin" d="M18,3.375c-5.59,0-10.125,4.212-10.125,9.4C7.875,20.088,18,32.625,18,32.625S28.125,20.088,28.125,12.776C28.125,7.587,23.59,3.375,18,3.375ZM18,16.8a3.3,3.3,0,1,1,3.3-3.3A3.3,3.3,0,0,1,18,16.8Z" transform="translate(-7.875 -3.375)" />
                    </svg>

                </i>
                {{$address}}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="footer__col">
            <div class="footer__copy" style="display: inline-flex">
                <h2 class="pr-5" style="margin: 4px 0">Created by</h2>
                <a href="https://insite.international/en/" target="_blank" style="margin: 0 10px">
                    <img class="insite_logo" src="insite_logo.png" style="width: 80px" alt="">
                </a>
            </div>
        </div>
    </div>
</footer>
