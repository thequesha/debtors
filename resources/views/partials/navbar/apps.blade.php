<li class="nav-item dropdown nav-apps ">
    <a class="text-light nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i data-feather="grid"></i>
    </a>
    <div class="dropdown-menu " aria-labelledby="appsDropdown">
        <div class="dropdown-header d-flex align-items-center justify-content-between">
            <p class="mb-0 font-weight-medium">{{ __('general.web_apps') }}</p>
        </div>
        <div class="dropdown-body">
            <div class="d-flex align-items-center apps">
                <a href="#"><i data-feather="message-square" class="icon-lg"></i>
                    <p>{{ __('general.chat') }}</p>
                </a>
                <a href="#"><i data-feather="calendar" class="icon-lg"></i>
                    <p>{{ __('general.calendar') }}</p>
                </a>

                <a href="#"><i data-feather="instagram" class="icon-lg"></i>
                    <p>{{ __('general.profile') }}</p>
                </a>
            </div>
        </div>
    </div>
</li>
