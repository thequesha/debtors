<li class="nav-item dropdown nav-profile">
    <a class="nav-link dropdown-toggle text-light" href="#" id="profileDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        @if (auth()->user()->getFirstMediaUrl('users'))
            <img src="{{ auth()->user()->getFirstMediaUrl('users') }}" alt="profile">
        @else
            <img src="{{ customAsset('admin/img/profile.png') }}" alt="profile">
        @endif
    </a>
    <div class="dropdown-menu" aria-labelledby="profileDropdown">
        <div class="dropdown-header d-flex flex-column align-items-center">
            <div class="figure mb-3">
                @if (auth()->user()->getFirstMediaUrl('users'))
                    <img src="{{ auth()->user()->getFirstMediaUrl('users') }}" alt="profile">
                @else
                    <img src="{{ customAsset('admin/img/profile.png') }}" alt="profile">
                @endif
            </div>
            <div class="info text-center">
                <p class="name font-weight-bold mb-0">{{ auth()->user()->name }}</p>
                <p class="email text-muted mb-3">{{ auth()->user()->username }}</p>
            </div>
        </div>
        <div class="dropdown-body">
            <ul class="profile-nav p-0 pt-3">
                {{-- <li class="nav-item">
                    <a href="pages/general/profile.html" class="nav-link">
                        <i data-feather="user"></i>
                        <span>{{ __('general.profile') }} (Coming soon)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                        <i data-feather="edit"></i>
                        <span>{{ __('general.edit_profile') }} (Coming soon)</span>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <a href="javascript:;" class="nav-link"
                            onclick="if (confirm('Вы уверены, что хотите выйти?')) this.parentElement.submit();">
                            <i data-feather="log-out"></i>
                            <span>Выход</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</li>
