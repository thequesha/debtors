<li class="nav-item dropdown nav-messages">
    <a class="nav-link text-light dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i data-feather="mail"></i>
    </a>
    <div class="dropdown-menu" aria-labelledby="messageDropdown">
        <div class="dropdown-header d-flex align-items-center justify-content-between">
            <p class="mb-0 font-weight-medium">{{ __('general.9_new_messages') }}</p>
            <a href="javascript:;" class="text-muted">{{ __('general.clear_all') }}</a>
        </div>
        <div class="dropdown-body">
            <a href="javascript:;" class="dropdown-item">
                <div class="figure">
                    <img src="{{ asset('admin/img/profile.png') }}" alt="userr">
                </div>
                <div class="content"> {{-- TODO: Agamjan suny perewwwwwwwod  edagada --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Leonardo Payne</p>
                        <p class="sub-text text-muted">2 min ago</p>
                    </div>
                    <p class="sub-text text-muted">{{ __('general.project_status') }}</p>
                </div>
            </a>
            <a href="javascript:;" class="dropdown-item">
                <div class="figure">
                    <img src="{{ asset('admin/img/profile.png') }}" alt="userr">
                </div>
                <div class="content">
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Carl Henson</p>{{-- TODO: Agamjan suny perewwwwwwwod  edagada --}}
                        <p class="sub-text text-muted">30 min ago</p>
                    </div>
                    <p class="sub-text text-muted">{{ __('general.client_meeting') }}</p>
                </div>
            </a>
            <a href="javascript:;" class="dropdown-item">
                <div class="figure">
                    <img src="{{ asset('admin/img/profile.png') }}" alt="userr">
                </div>
                <div class="content">
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Jensen Combs</p>{{-- TODO: Agamjan suny perewwwwwwwod  edagada --}}
                        <p class="sub-text text-muted">1 hrs ago</p>
                    </div>
                    <p class="sub-text text-muted">{{ __('general.project_updates') }}</p>
                </div>
            </a>
            <a href="javascript:;" class="dropdown-item">
                <div class="figure">
                    <img src="{{ asset('admin/img/profile.png') }}" alt="userr">
                </div>
                <div class="content">
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Amiah Burton</p>{{-- TODO: Agamjan suny perewwwwwwwod  edagada --}}
                        <p class="sub-text text-muted">2 hrs ago</p>
                    </div>
                    <p class="sub-text text-muted">{{ __('general.project_deadline') }}</p>
                </div>
            </a>
            <a href="javascript:;" class="dropdown-item">
                <div class="figure">
                    <img src="{{ asset('admin/img/profile.png') }}" alt="userr">
                </div>
                <div class="content">
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Yaretzi Mayo</p>{{-- TODO: Agamjan suny perewwwwwwwod  edagada --}}
                        <p class="sub-text text-muted">5 hr ago</p>
                    </div>
                    <p class="sub-text text-muted">{{ __('general.new_record') }}</p>
                </div>
            </a>
        </div>
        <div class="dropdown-footer d-flex align-items-center justify-content-center">
            <a href="javascript:;">View all (Coming soon)</a>{{-- TODO: Agamjan suny perewwwwwwwod  edagada --}}
        </div>
    </div>
</li>
