<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo flex-shrink-0 d-none d-md-flex align-items-center px-8" id="kt_app_sidebar_logo">
        <!--begin::Logo-->
        <a href="index.html">
            <img alt="Logo" src="{{ asset('theme/assets/media/logos/logo.png')}}" class="w-100 d-none d-sm-inline app-sidebar-logo-default theme-light-show" />
            <img alt="Logo" src="{{ asset('theme/assets/media/logos/white-logo.png')}}" class="w-100 theme-dark-show" />
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-1"></i>
            </div>
        </div>
        <!--end::Aside toggle-->
    </div>
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold px-1" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <div class="menu-item">
                    @if(Auth::user()->hasRole('admin'))
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Admin</span>
                    </div>
                    @else
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">User</span>
                    </div>
                    @endif
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::currentRouteName() == 'dashboard'  ? 'active' : '' }}" href="{{route('dashboard')}}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-chart-simple-2 fs-2"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::currentRouteName() == 'contract.index'  ? 'active' : '' }}" href="{{route('contract.index')}}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-document fs-2"></i>
                        </span>
                        <span class="menu-title">Contracts</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::currentRouteName() == 'client.index'  ? 'active' : '' }}" href="{{route('client.index')}}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-user-tick fs-2"></i>
                        </span>
                        <span class="menu-title">Clients</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::currentRouteName() == 'lead.index'  ? 'active' : '' }}" href="{{route('lead.index')}}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-data fs-2"></i>
                        </span>
                        <span class="menu-title">Leads</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::currentRouteName() == 'provider.index'  ? 'active' : '' }}" href="{{route('provider.index')}}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-office-bag fs-2"></i>
                        </span>
                        <span class="menu-title">Providers</span>
                    </a>
                </div>
                @if(Auth::user()->hasRole('admin'))
                <div class="menu-item">
                    <a class="menu-link {{ Route::currentRouteName() == 'user.index'  ? 'active' : '' }}" href="{{route('user.index')}}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-people fs-2"></i>
                        </span>
                        <span class="menu-title">Users</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::currentRouteName() == 'admin'  ? 'active' : '' }}" href="{{route('admin')}}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-security-user fs-2"></i>
                        </span>
                        <span class="menu-title">Admins</span>
                    </a>
                </div>
                @endif
                <div class="menu-item pt-5">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Account</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::currentRouteName() == 'settings.create'  ? 'active' : '' }}" href="{{route('settings.create')}}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-setting-4 fs-2"></i>
                        </span>
                        <span class="menu-title">Account Settings</span>
                    </a>
                </div>
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>