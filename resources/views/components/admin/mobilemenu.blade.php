<div>
    <div class="menu-mobile menu-activated-on-click color-scheme-dark">
        <div class="mm-logo-buttons-w">
          <a class="mm-logo" href="{{route('productIndex',app()->getLocale())}}"><img src="/adm/img/logo.png"><span>Volta Admin</span></a>
          <div class="mm-buttons">
            <div class="content-panel-open">
              <div class="os-icon os-icon-grid-circles"></div>
            </div>
            <div class="mobile-menu-trigger">
              <div class="os-icon os-icon-hamburger-menu-1"></div>
            </div>
          </div>
        </div>
        <div class="menu-and-user">
          <div class="logged-user-w">
            <div class="avatar-w">
              <img alt="" src="/no-avatar.png">
            </div>
            <div class="logged-user-info-w">
              <div class="logged-user-name">
                  Administrator
              </div>
              <div class="logged-user-role">
                Administrator
              </div>
            </div>
          </div>
          <!--------------------
          START - Mobile Menu List
          -------------------->
          <ul class="main-menu">
              <li class="">
                  <a href="{{route('productIndex',app()->getLocale() )}}">
                      <div class="icon-w">
                          <div class="os-icon os-icon-life-buoy"></div>
                      </div>
                      <span>{{__('admin.products')}}</span></a>
              </li>
              <li class="">
                  <a href="{{route('categoryIndex',app()->getLocale() )}}">
                      <div class="icon-w">
                          <div class="os-icon os-icon-life-buoy"></div>
                      </div>
                      <span>{{__('admin.categories')}}</span></a>
              </li>

              <li class="">
                  <a href="{{route('localizationIndex',app()->getLocale() )}}">
                      <div class="icon-w">
                          <div class="os-icon os-icon-life-buoy"></div>
                      </div>
                      <span>{{__('admin.localizations')}}</span></a>
              </li>
              <li class="has-sub-menu">
                  <a href="">
                      <div class="icon-w">
                          <div class="os-icon os-icon-layout"></div>
                      </div>
                      <span>{{__('admin.site')}}</span>
                  </a>
                  <ul class="sub-menu">
                      <li style="padding:0"  class="">
                          <a href="{{route('pageIndex',app()->getLocale() )}}">
                              <span>{{__('admin.pages')}}</span></a>
                      </li>
                      <li style="padding:0" class="">
                          <a href="{{route('settingIndex',app()->getLocale() )}}">
                              <span>{{__('admin.settings')}}</span></a>
                      </li>
                      <li style="padding:0" class="">
                          <a href="{{route('brandIndex',app()->getLocale() )}}">
                              <span>{{__('admin.brands')}}</span></a>
                      </li>

                      <li style="padding:0" class="">
                          <a href="{{route('sliderIndex',app()->getLocale() )}}">
                              <span>{{__('admin.sliders')}}</span></a>
                      </li>
                  </ul>
              </li>


              <li class="">
                  <a href="{{route('featureIndex',app()->getLocale() )}}">
                      <div class="icon-w">
                          <div class="os-icon os-icon-life-buoy"></div>
                      </div>
                      <span>{{__('admin.features')}}</span></a>
              </li>


              <li>
                  <a href="/{{app()->getLocale()}}/admin/languages" >
                      <div class="icon-w">
                          <div class="os-icon os-icon-flag"></div>
                      </div>
                      <span>@lang('admin.language')</span></a>

              </li>

              <li>
                  <a href="/{{app()->getLocale()}}/admin/answers">
                      <div class="icon-w">
                          <div class="os-icon os-icon-flag"></div>
                      </div>
                      <span>@lang('admin.answers')</span></a>

              </li>

              <li class="">
                  <a href="{{route('orderIndex',app()->getLocale() )}}">
                      <div class="icon-w">
                          <div class="os-icon os-icon-life-buoy"></div>
                      </div>
                      <span>{{__('admin.orders')}}</span></a>
              </li>


              {{--            <li>--}}
              {{--              <a href="/{{app()->getLocale()}}/admin/news">--}}
              {{--                <div class="icon-w">--}}
              {{--                  <div class="os-icon os-icon-flag"></div>--}}
              {{--                </div>--}}
              {{--                <span>@lang('admin.news')</span></a>--}}

              {{--            </li>--}}
              {{--            <li>--}}
              {{--              <a href="/{{app()->getLocale()}}/admin/files">--}}
              {{--                <div class="icon-w">--}}
              {{--                  <div class="os-icon os-icon-flag"></div>--}}
              {{--                </div>--}}
              {{--                <span>@lang('admin.files')</span></a>--}}

              {{--            </li>--}}
              {{--            <li class="">--}}
              {{--                <a href="{{route('userIndex',app()->getLocale() )}}">--}}
              {{--                    <div class="icon-w">--}}
              {{--                        <div class="os-icon os-icon-life-buoy"></div>--}}
              {{--                    </div>--}}
              {{--                    <span>{{__('admin.users')}}</span></a>--}}
              {{--            </li>--}}




          </ul>
          <!--------------------
          END - Mobile Menu List
          -------------------->
        </div>
      </div>
</div>
