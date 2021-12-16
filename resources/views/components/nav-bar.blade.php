<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="{{ asset('front/images/logo.png') }}"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="nav-item">
                        <a class="nav-link active" rel="alternate" hreflang="{{ $localeCode }}"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">تطبيق</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">الأحداث</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">وظائف</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('web.site.deals')}}">صفقات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_deals">اضافة صفقة</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link register" href="{{route('logout')}}">{{__('dashboard.logout')}}</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link register" href="#" data-bs-toggle="modal"
                       data-bs-target="#registerModal">التسجيل</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
