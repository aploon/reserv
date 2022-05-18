<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: Aploon
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<!-- Mirrored from preview.keenthemes.com/metronic/demo1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Apr 2022 17:22:02 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />

    <title>@yield('title')</title>

    <meta name="description"
        content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet"
        href="{{ asset('template/assets/fonts/fonts.googleapis.com/css/fonts.css?family=Poppins:300,400,500,600,700') }}" />
    <!--end::Fonts-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link
        href="{{ asset('template/assets/theme/html/demo1/dist/assets/plugins/global/plugins.bundle5883.css?v=7.2.9') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('template/assets/theme/html/demo1/dist/assets/plugins/custom/prismjs/prismjs.bundle5883.css?v=7.2.9') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/theme/html/demo1/dist/assets/css/style.bundle5883.css?v=7.2.9') }}"
        rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link
        href="{{ asset('template/assets/theme/html/demo1/dist/assets/css/themes/layout/header/base/light5883.css?v=7.2.9') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('template/assets/theme/html/demo1/dist/assets/css/themes/layout/header/menu/light5883.css?v=7.2.9') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('template/assets/theme/html/demo1/dist/assets/css/themes/layout/brand/dark5883.css?v=7.2.9') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('template/assets/theme/html/demo1/dist/assets/css/themes/layout/aside/dark5883.css?v=7.2.9') }}"
        rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon"
        href="{{ asset('template/assets/theme/html/demo1/dist/assets/media/logos/favicon.ico') }}" />
    <!-- Hotjar Tracking Code for keenthemes.com -->
    <script>
        (function(h, o, t, j, a, r) {
            h.hj = h.hj || function() {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {
                hjid: 1070954,
                hjsv: 6
            };
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>

    @yield('head-modules')


</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <div class="" id="splash"
        style="display: flex; align-item: center; position:fixed; top:0; left:0; width:100%; height:100%; background:linear-gradient(45deg,#222428,#444856);color:#fff;z-index:4000;">
        {{-- <div class="w-100 text-center text-light">
            <style>
                @keyframes r {
                    0% {
                        transform: rotate(0deg);
                    }

                    100% {
                        transform: rotate(45deg);
                    }
                }

                #splash {
                    transition: all .3s linear
                }

                #splash.hidden {
                    opacity: 0;
                    z-index: -1;
                    visibility: hidden;
                }

                svg.gear {
                    animation: r .5s infinite linear;
                }

            </style><svg class="gear" style="width:64px" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 100 100">
                <path id="p" fill="#fdb"
                    d="M94.1 58.8c.6-2.8.9-5.8.9-8.8s-.3-6-.9-8.8l-11.7-.4c-.7-2.6-1.7-5-3-7.3l8-8.5c-3.3-4.9-7.5-9.2-12.5-12.5l-8.5 8c-2.3-1.3-4.7-2.3-7.3-3l-.3-11.6C56 5.3 53 5 50 5s-6 .3-8.8.9l-.4 11.7c-2.6.7-5 1.7-7.3 3l-8.5-8c-4.9 3.3-9.2 7.5-12.5 12.5l8 8.5c-1.3 2.3-2.3 4.7-3 7.3l-11.6.3C5.3 44 5 47 5 50s.3 6 .9 8.8l11.7.4c.7 2.6 1.7 5 3 7.3l-8 8.5c3.3 4.9 7.5 9.2 12.5 12.5l8.5-8c2.3 1.3 4.7 2.3 7.3 3l.4 11.7c2.7.5 5.7.8 8.7.8s6-.3 8.8-.9l.4-11.7c2.6-.7 5-1.7 7.3-3l8.5 8c4.9-3.3 9.2-7.5 12.5-12.5l-8-8.5c1.3-2.3 2.3-4.7 3-7.3l11.6-.3zM50 66.9c-9.3 0-16.9-7.6-16.9-16.9S40.7 33.1 50 33.1 66.9 40.7 66.9 50 59.3 66.9 50 66.9z">
                </path>
            </svg><svg class="gear" style="width:64px;margin:64px 0 0 -12px;animation-direction:reverse"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                <use href="#p"></use>
            </svg>
            <h1 class="font-weight-bold text-shadow" style="font-family:Trebuchet MS,Helvetica,sans-serif">Loading.io
            </h1>
            <div class="text-muted">loading.io is now loading ...</div>
        </div> --}}
        <div class="m-auto w-100 text-center">
            <img class="" src="{{ asset("template/assets/img/preloader/eclipse_preloader_white.gif") }}" alt="">
            <div class="" style="font-family:Trebuchet MS,Helvetica,sans-serif; font-size: 30px; font-weight: bold;" backgound="{{ asset("template/assets/img/preloader/eclipse_preloader_white.gif") }}">Reserv</div>
        </div>
        
    </div>

    <!--begin::Main-->

    <!--begin::Header Mobile-->

    @component('layouts.components.header-mobile')
    @endcomponent

    <!--end::Header Mobile-->

    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">

            <!--begin::Aside-->

            @if (isset($categories))

                @if (isset($categorie_name))
                    @component('layouts.components.sidebar',
                        [
                            'categories' => $categories,
                            'categorie_name' => $categorie_name,
                        ])
                    @endcomponent
                @else
                    @component('layouts.components.sidebar',
                        [
                            'categories' => $categories,
                        ])
                    @endcomponent
                @endif
            @else
                @component('layouts.components.sidebar')
                @endcomponent
            @endif
            <!--end::Aside-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->

                @component('layouts.components.header')
                @endcomponent

                <!--end::Header-->


                <!--begin::Content-->

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    <!--begin::Subheader-->

                    @yield('subheader')

                    <!--end::Subheader-->

                    @yield('main-content')

                </div>

                <!--end::Content-->


                <!--begin::Footer-->

                @section('footer')

                    @component('layouts.components.footer')
                    @endcomponent

                @show

                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->

    <!--begin::User panel-->

    @section('tools')

        @component('layouts.components.tools')
        @endcomponent

    @show

    <!--end::User panel-->

    <script>
        var HOST_URL = "{{ asset('template/assets/theme/html/tools/preview/index.html') }}";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script
        src="{{ asset('template/assets/theme/html/demo1/dist/assets/plugins/global/plugins.bundle5883.js?v=7.2.9') }}">
    </script>
    <script
        src="{{ asset('template/assets/theme/html/demo1/dist/assets/plugins/custom/prismjs/prismjs.bundle5883.js?v=7.2.9') }}">
    </script>
    <script src="{{ asset('template/assets/theme/html/demo1/dist/assets/js/scripts.bundle5883.js?v=7.2.9') }}"></script>
    {{-- <script src="{{ asset("template/assets/keenthemes.com/metronic/assets/js/engage_code.js") }}"></script> --}}
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('template/assets/theme/html/demo1/dist/assets/js/pages/widgets5883.js?v=7.2.9') }}"></script>

    @yield('footer-modules')

    <!--end::Page Scripts-->
    <script type="text/javascript">

        jQuery(document).ready(function() {

            $("#splash").addClass("hidden")

        });
    </script>
</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic/demo1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Apr 2022 17:26:00 GMT -->

</html>
