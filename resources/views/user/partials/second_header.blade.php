<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
        <ul class="navbar-nav flex-row ml-auto ">
            <li class="nav-item more-dropdown">
                <div class="dropdown  custom-dropdown-icon">
                    <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>Settings</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">
                        <a href="{{route('logout')}}" class="dropdown-item">{{__('dashboard.logout')}}</a>
                        <a href="{{route('admin.edit.info')}}" class="dropdown-item">{{__('dashboard.edit_account_information')}}</a>
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                             <a class="dropdown-item {{($localeCode == app()->getLocale()) ? 'active' : ''}}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"><img src="{{asset('admin/assets/img/'.$localeCode.'.png')}}" class="flag-width w-25" alt="flag"> <span class="align-self-center">&nbsp;{{ $properties['native'] }}</span></a>
                        @endforeach
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
