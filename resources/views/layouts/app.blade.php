<?php
$path = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="" />
    <title>RiaCom - Web Application</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('theme/assets/media/logos/favicon.png')}}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('theme/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-header="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <div id="kt_app_header" class="app-header">
                <!--begin::Header container-->
                <div class="app-container container-fluid d-flex align-items-stretch flex-stack"
                    id="kt_app_header_container">
                    <!--begin::Sidebar toggle-->
                    <div class="d-flex align-items-center d-block d-lg-none ms-n3" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px me-2"
                            id="kt_app_sidebar_mobile_toggle">
                            <i class="ki-outline ki-abstract-14 fs-2"></i>
                        </div>
                        <!--begin::Logo image-->
                        <a href="index.html">
                            <img alt="Logo" src="{{ asset('theme/assets/media/logos/logo.png')}}" class="h-80px" />
                        </a>
                        <!--end::Logo image-->
                    </div>
                    <!--end::Sidebar toggle-->
                    <!--begin::Toolbar wrapper-->
                    <div class="app-navbar flex-lg-grow-1" id="kt_app_header_navbar">
                        <div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">
                            <!--begin::Search-->
                            {{-- <div id="kt_header_search" class="header-search d-flex align-items-center w-lg-200px">
                                <div class="d-none d-lg-block w-100 position-relative mb-5 mb-lg-0" autocomplete="off">
                                    <i
                                        class="ki-outline ki-magnifier search-icon fs-2 text-gray-500 position-absolute top-50 translate-middle-y ms-5"></i>
                                    <input type="text" class="search-input form-control form-control rounded-1 ps-13"
                                        name="search" value="" placeholder="Search..."
                                        data-kt-search-element="input" />
                                </div>
                            </div> --}}
                            <!--end::Search-->
                        </div>
                        <div class="app-navbar-item ms-1 ms-md-4">
                            <h1 class="m-0 fs-6 fs-lg-3 me-3">{{ __('layout.Welcome') }}, {{ Auth::user()->name }}
                                <span class="svg-icon svg-icon-1">
                                    <svg class="iconify iconify--emojione" width="800px" height="800px"
                                        aria-hidden="true" foxified="" role="img" viewBox="0 0 64 64"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g fill="#42ade2">
                                            <path
                                                d="M16.1 48.5c-.5-.1-.9-.2-1.4-.4c-.5-.2-.9-.3-1.3-.5c-.9-.4-1.7-.9-2.5-1.5C9.3 45 8 43.5 7 41.7C6 40 5.4 38 5.3 36.1c-.1-1 0-1.9.1-2.9c.1-.5.2-.9.3-1.4c.1-.5.3-.9.4-1.4l.1 1.4c0 .5.1.9.2 1.4c.1.9.3 1.8.5 2.6c.4 1.7 1 3.3 1.9 4.8c.9 1.5 1.9 2.9 3.2 4.2c.6.6 1.3 1.2 2 1.8c.3.3.7.6 1.1.9l1 1">
                                            </path>
                                            <path
                                                d="M15.8 52.1c-.3.2-.7.3-1.1.4c-.4.1-.7.2-1.1.2c-.7.1-1.5.2-2.3.1c-1.5-.1-3.1-.5-4.4-1.2c-1.4-.7-2.6-1.8-3.4-3.1c-.4-.6-.8-1.3-1.1-2c-.1-.3-.2-.7-.3-1.1c0-.3-.1-.6-.1-1c.3.3.5.6.7.8c.3.3.5.6.7.8c.5.5.9 1 1.4 1.4c1 .9 2 1.7 3.2 2.3c1.1.6 2.4 1.1 3.6 1.5c.6.2 1.3.3 2 .5c.3.1.7.1 1 .2c.5.1.8.1 1.2.2">
                                            </path>
                                            <path
                                                d="M38.4 3.5c.5.1.9.3 1.4.5c.5.2.9.4 1.3.6c.9.5 1.7 1 2.5 1.6c1.6 1.2 2.9 2.8 3.8 4.6c.9 1.8 1.4 3.8 1.4 5.7c0 1-.1 1.9-.3 2.9c-.1.5-.2.9-.4 1.4c-.2.5-.3.9-.5 1.3l-.1-1.4c0-.5 0-.9-.1-1.4l-.3-2.7c-.3-1.7-.9-3.4-1.7-5c-.8-1.6-1.8-3-3-4.3c-.6-.7-1.3-1.3-1.9-2c-.3-.3-.7-.6-1.1-.9l-1-.9">
                                            </path>
                                            <path
                                                d="M47.1 3.1c.4.1.7.2 1 .4c.3.1.7.3 1 .5c.6.4 1.2.8 1.8 1.3c1.1 1 2 2.2 2.5 3.6c.6 1.4.8 2.9.6 4.4c-.1.7-.3 1.4-.5 2.1c-.1.3-.3.7-.4 1c-.2.3-.3.6-.6.9v-2c0-.7-.1-1.3-.1-1.9c-.2-1.3-.4-2.5-.9-3.6c-.5-1.2-1.1-2.2-1.8-3.3c-.4-.5-.8-1.1-1.2-1.6c-.2-.3-.4-.5-.7-.8c-.2-.5-.5-.8-.7-1">
                                            </path>
                                        </g>
                                        <g fill="#ffdd67">
                                            <path
                                                d="M10 18c-2 .9-2.7 3.3-1.8 5.3l12.6 26.3l7-3.3l-12.6-26.4c-.9-2-3.2-2.9-5.2-1.9">
                                            </path>
                                            <path
                                                d="m43.1 38.9 7.4-3.5-14.4-30c-1-2-3.4-2.9-5.5-1.9-2 1-2.9 3.4-1.9 5.5l14.4 29.9">
                                            </path>
                                        </g>
                                        <path
                                            d="M30.7 3.4c-.2.1-.4.2-.6.4c1.9-.5 3.9.4 4.8 2.2l14.4 30l1.3-.6l-14.4-30c-1-2.1-3.4-3-5.5-2"
                                            fill="#eba352"></path>
                                        <path
                                            d="m27.8 46.2 7.7-3.7-14.7-30.6c-1-2.1-3.6-3.1-5.7-2.1s-3 3.6-2 5.7l14.7 30.7"
                                            fill="#ffdd67"></path>
                                        <path
                                            d="M15.1 9.9c-.2.1-.4.2-.6.4c1.9-.5 4.1.4 5 2.3l9.1 19.1l2.2 1.3l-10-21c-1-2.2-3.5-3.1-5.7-2.1"
                                            fill="#eba352"></path>
                                        <path
                                            d="m34.3 40.1 7.7-3.7-14.7-30.6c-1-2.1-3.6-3.1-5.7-2-2.1 1-3 3.6-2 5.7l14.7 30.6"
                                            fill="#ffdd67"></path>
                                        <g fill="#eba352">
                                            <path
                                                d="M21.6 3.7c-.2.1-.4.3-.6.4c1.9-.5 4.1.4 5 2.3L36.3 28l2.2 1.3L27.3 5.8c-1-2.2-3.6-3.1-5.7-2.1">
                                            </path>
                                            <path
                                                d="M10 18c-.2.1-.4.2-.6.4c1.8-.5 3.7.4 4.5 2.2l7.5 15.7l2.2 1.3L15.2 20c-.9-2.1-3.2-3-5.2-2">
                                            </path>
                                        </g>
                                        <path
                                            d="M60.8 15c-2.7-2.1-7.1.2-9.3 7.4c-1.5 5-1.7 6.5-4.9 8l-1.8-3.7S16.4 40.4 17.5 42.6c0 0 3.4 10.6 9.2 15.5c8.6 7.4 28.7-.5 29.6-19.6c.5-11.1 7.4-21.2 4.5-23.5"
                                            fill="#ffdd67"></path>
                                        <g fill="#eba352">
                                            <path
                                                d="M60.8 15c-.5-.4-1.1-.6-1.7-.7c.1.1.3.1.4.2c3 2.3-.1 7.6-1.8 12.4c-1.4 3.8-2.6 7.7-2.4 11.5c.8 16.6-15.9 24.5-25.9 21.5c9.8 4.1 28-3.7 27.2-21c-.2-3.8.9-7.5 2.4-11.5c1.6-4.8 4.7-10.1 1.8-12.4">
                                            </path>
                                            <path
                                                d="M47.5 30c-6.2.7-15.3 9.6-8.9 19.3c-4.7-9.8 3-16.4 7.9-18.7c.5-.4 1-.6 1-.6">
                                            </path>
                                        </g>
                                    </svg>
                                </span>
                            </h1>
                        </div>
                        <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                            <div class="cursor-pointer symbol symbol-35px"
                                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                data-kt-menu-placement="bottom-end">
                                <img src="{{ asset(Auth::user()->profile_picture) }}" class="rounded-3" alt="user">
                            </div>

                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-auto min-w-275px"
                                data-kt-menu="true" style="">
                                <div class="menu-item px-3">
                                    <div class="menu-content d-flex align-items-center px-3">
                                        <div class="symbol symbol-50px me-5">
                                            <img alt="Logo" src="{{ asset(Auth::user()->profile_picture) }}">
                                        </div>

                                        <div class="d-flex flex-column">
                                            <div class="fw-bold d-flex align-items-center fs-5">
                                                {{ Auth::user()->name }} <span
                                                    class="badge badge-light-primary fw-bold fs-8 px-2 py-1 ms-2">{{ Auth::user()->roles->first()->display_name }}</span>
                                            </div>

                                            <a href="#"
                                                class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="separator my-2"></div>

                                <div class="menu-item px-5 my-1">
                                    <a href="{{route('settings.create')}}" class="menu-link px-5">
                                        {{ __('layout.Account Settings') }}
                                    </a>
                                </div>

                                <div class="menu-item px-5">
                                    <a href="{{route('logout')}}" class="menu-link px-5">
                                        {{ __('layout.Sign Out') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--begin::Header menu toggle-->
                        <!--end::Header menu toggle-->
                    </div>
                    <!--end::Navbar-->
                </div>
                <!--end::Header container-->
            </div>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                @include('layouts.modal')
                @include('layouts.navigation')
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    {{ $slot }}
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i>
    </div>
    <!--end::Scrolltop-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{ asset('theme/assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{ asset('theme/assets/js/scripts.bundle.js')}}"></script>
    {{-- <script src="{{ asset('theme/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script> --}}
    {{-- <script src="{{ asset('theme/assets/js/custom/apps/calendar/calendar.js')}}"></script> --}}
    {{-- <script src="{{ asset('theme/assets/plugins/custom/fslightbox/fslightbox.bundle.js')}}"></script> --}}
    <script src="{{ asset('theme/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{ asset('theme/assets/js/widgets.bundle.js')}}"></script>
    <script src="{{ asset('theme/assets/js/custom/widgets.js')}}"></script>
    {{-- <script src="{{ asset('theme/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script> --}}
    {{-- <script src="{{ asset('theme/assets/plugins/custom/draggable/draggable.bundle.js')}}"></script> --}}
    {{-- <script src="{{ asset('theme/assets/plugins/custom/jkanban/jkanban.bundle.js')}}"></script> --}}
    <script src="{{ asset('theme/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    <script src="{{asset('theme/custom/main.js')}}"></script>
    <!--end::Javascript-->

    <!--begin::Custom Javascript-->
    <script>
        $(document).ready(function() {
            // Form Repeater
            $('.kt_docs_repeater_basic').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            // Date and Time Picker
            // -- Date Picker
            $(".kt_datepicker_2").flatpickr();

            // -- Date & Time Picker
            $(".kt_datepicker_3").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });

            // -- Date Range Picker
            $(".kt_daterangepicker_1").daterangepicker();

            // -- Time Picker
            $(".kt_datepicker_8").flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });

            // $(".kt_datatable_example_2").DataTable();
            // Datatables
            var table = $('.kt_datatable_example_1').DataTable({
                // order: [],
                // "scrollY": "500px",
                info: !1,
                "aaSorting": [],
                pageLength: 10,
                lengthChange: !1,
                columnDefs: [
                    // {
                    //     orderable: !1,
                    //     targets: 0
                    // },
                    {
                        orderable: !1,
                        targets: -1
                    },
                ],
            });
            var table2 = $('.kt_datatable_example_2').DataTable({
                info: !1,
                "aaSorting": [],
                pageLength: 10,
                lengthChange: !1,
                columnDefs: [{
                        orderable: !1,
                        targets: 0
                    },
                    {
                        orderable: !1,
                        targets: -1
                    },
                ],
            });
            $('.search').on('keyup', function() {
                table.search(this.value).draw();
                table2.search(this.value).draw();
            });
        });



        // Select2
        $('.js-example-basic-single').select2();

        $(".js-example-tags").select2({
            tags: true
        });

        // Phone
        Inputmask({
            "mask": "(999) 999-9999"
        }).mask(".kt_inputmask_2");
    </script>
    <!--end::Custom Javascript-->

</body>
<!--end::Body-->

</html>
