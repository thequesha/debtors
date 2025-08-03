<li class="nav-item dropdown nav-notifications">
    <a class="nav-link text-light dropdown-toggle" href="#" id="notificationDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i data-feather="bell"></i>
        <div class="indicator ">
            <div class="circle bg-light"></div>
        </div>
    </a>
    <div class="dropdown-menu" aria-labelledby="notificationDropdown">
        <div class="dropdown-header d-flex align-items-center justify-content-between">
            <p class="mb-0 font-weight-medium">{{ __('general.6_new_notifications') }}</p>
            <a href="javascript:;" class="text-muted">{{ __('general.clear_all') }}</a>
        </div>
        <div class="dropdown-body">
            <a href="javascript:;" class="dropdown-item">
                <div class="icon">
                    <i data-feather="user-plus"></i>
                </div>
                <div class="content">
                    <p>{{ __('general.new_customer_registered') }}</p>
                     {{-- TODO: Agamjan suny perewwwwwwwod  edagada --}}
                    <p class="sub-text text-muted">2 sec ago</p>
                </div>
            </a>
            <a href="javascript:;" class="dropdown-item">
                <div class="icon">
                    <i data-feather="gift"></i>
                </div>
                <div class="content">
                    <p>{{ __('general.new_order_recieved') }}</p>
                     {{-- TODO: Agamjan suny perewwwwwwwod  edagada --}}
                    <p class="sub-text text-muted">30 min ago</p>
                </div>
            </a>
            <a href="javascript:;" class="dropdown-item">
                <div class="icon">
                    <i data-feather="alert-circle"></i>
                </div>
                <div class="content">
                    <p>{{ __('general.server_limit_reached!') }}</p>
                     {{-- TODO: Agamjan suny perewwwwwwwod  edagada --}}
                    <p class="sub-text text-muted">1 hrs ago</p>
                </div>
            </a>
            <a href="javascript:;" class="dropdown-item">
                <div class="icon">
                    <i data-feather="layers"></i>
                </div>
                <div class="content">
                    <p>{{ __('general.apps_are_ready_for_update') }}</p>
                    {{-- TODO: Agamjan suny perewwwwwwwod  edagada --}}
                    <p class="sub-text text-muted">5 hrs ago</p>
                </div>
            </a>
            <a href="javascript:;" class="dropdown-item">
                <div class="icon">
                    <i data-feather="download"></i>
                </div>
                <div class="content">
                    <p>{{ __('general.download_completed') }}</p>
                     {{-- TODO: Agamjan suny perewwwwwwwod  edagada --}}
                    <p class="sub-text text-muted">6 hrs ago</p>
                </div>
            </a>
        </div>
        <div class="dropdown-footer d-flex align-items-center justify-content-center">
            <a href="javascript:;">View all (Coming soon)</a> {{-- TODO: Agamjan suny perewwwwwwwod  edagada --}}
        </div>
    </div>
</li>
