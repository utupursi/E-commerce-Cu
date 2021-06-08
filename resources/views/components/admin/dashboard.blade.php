<div>
    <div>
        <div class="all-wrapper solid-bg-all" style="height: 87vh;">
            <div class="layout-w" style="height: 100%">
                <x-admin.mobilemenu/>

                <x-admin.sidemenu/>
                <div class="content-w">
                    <x-admin.navbar/>
                    <x-admin.breadcrumb/>
                    <x-admin.alert />
                    <div class="dashboard">
                        {{$slot}}
                    </div>
                    <div class="floated-colors-btn second-floated-btn">
                        <div class="os-toggler-w">
                          <div class="os-toggler-i">
                            <div class="os-toggler-pill"></div>
                          </div>
                        </div>
                        <span>Dark </span><span>Colors</span>
                      </div>
                </div>

            </div>
        </div>
    </div>
</div>
