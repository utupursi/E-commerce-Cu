<div>
    <div class="top-bar color-scheme-light">
        <!--------------------
        START - Top Menu Controls
        -------------------->
        <div class="top-menu-controls">
            @if(isset($languages['current']))
                <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                    <img class="flag" src="/adm/img/flags-icons/{{$languages['current']['img']}}">
                    @if(count($languages['data']) > 0)
                        <div class="os-dropdown">
                            <div class="icon-w">
                                <i class="os-icon os-icon-ui-46"></i>
                            </div>
                            <ul>
                                @foreach($languages['data'] as $data)
                                <li>
                                    <a href="{{$data['url']}}" class="d-flex"><img class="flag" src="/adm/img/flags-icons/{{$data['img']}}"><span>{{$data['title']}}</span></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                </div>
            @endif
          <!--------------------
          END - Messages Link in secondary top menu
          --------------------><!--------------------
          START - Settings Link in secondary top menu
          -------------------->
          <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
            <i class="os-icon os-icon-ui-46"></i>
            <div class="os-dropdown">
              <div class="icon-w">
                <i class="os-icon os-icon-ui-46"></i>
              </div>
              <ul>
                
                <li>
                  
                <a href="{{route('logout',app()->getLocale() )}}"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
                </li>
              </ul>
            </div>
          </div>
          <!--------------------
          END - Settings Link in secondary top menu
          -------------------->
        </div>
        <!--------------------
        END - Top Menu Controls
        -------------------->
      </div>
</div>
