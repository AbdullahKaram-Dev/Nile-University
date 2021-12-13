<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="index.html">
                    <img src="{{asset('admin/assets/img/90x90.jpg')}}" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="{{route('admin.home')}}" class="nav-link"> CORK </a>
            </li>
        </ul>

        <ul class="navbar-item flex-row ml-md-5">

            <li class="nav-item dropdown language-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('admin/assets/img/'.app()->getLocale().'.png')}}" class="flag-width" alt="flag">
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="dropdown-item d-flex"><img src="{{asset('admin/assets/img/'.$localeCode.'.png')}}" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;{{ $properties['native'] }}</span></a>
                    @endforeach
                </div>
            </li>

        </ul>


    </header>
</div>
