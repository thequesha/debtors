<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        @include('front.svg.' . LaravelLocalization::getCurrentLocale())<span class="font-weight-medium ml-1 mr-1 text-light">
            {{ LaravelLocalization::getCurrentLocaleNative() }}
        </span>
    </a>
    <div class="dropdown-menu" aria-labelledby="languageDropdown">
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            @php
                $locale = $localeCode == 'tk' ? 'tm' : $localeCode;
            @endphp
            <a rel="alternate" hreflang="{{ $localeCode }}"
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                class="dropdown-item py-2">
                @include('front.svg.' . $locale)
                <span class="ml-1">
                    {{ $properties['native'] }}
                </span>
            </a>
        @endforeach

    </div>
</li>
