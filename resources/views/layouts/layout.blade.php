<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
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
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&amp;l=' + l : '';
            j.async = true;
            j.src = '{{ asset("template/assets/www.googletagmanager.com/gtm5445.html") }}?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5FS8GGP');
    </script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8" />

    <title>@yield('title')</title>

    <meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="{{ asset("template/assets/fonts/fonts.googleapis.com/css/fonts.css?family=Poppins:300,400,500,600,700") }}" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset("template/assets/theme/html/demo1/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle5883.css?v=7.2.9") }}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset("template/assets/theme/html/demo1/dist/assets/plugins/global/plugins.bundle5883.css?v=7.2.9") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("template/assets/theme/html/demo1/dist/assets/plugins/custom/prismjs/prismjs.bundle5883.css?v=7.2.9") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("template/assets/theme/html/demo1/dist/assets/css/style.bundle5883.css?v=7.2.9") }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset("template/assets/theme/html/demo1/dist/assets/css/themes/layout/header/base/light5883.css?v=7.2.9") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("template/assets/theme/html/demo1/dist/assets/css/themes/layout/header/menu/light5883.css?v=7.2.9") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("template/assets/theme/html/demo1/dist/assets/css/themes/layout/brand/light5883.css?v=7.2.9") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("template/assets/theme/html/demo1/dist/assets/css/themes/layout/aside/light5883.css?v=7.2.9") }}" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset("template/assets/theme/html/demo1/dist/assets/media/logos/favicon.ico") }}" />
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

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!-- Google Tag Manager (noscript) -->
    <noscript>
			<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!--begin::Main-->

    <!--begin::Header Mobile-->
    
        @component('layouts.components.header-mobile')
        @endcomponent

    <!--end::Header Mobile-->

    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">

            <!--begin::Aside-->

                @component('layouts.components.sidebar')
                @endcomponent
            
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
        var HOST_URL = "{{ asset("template/assets/theme/html/tools/preview/index.html") }}";
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
    <script src="{{ asset("template/assets/theme/html/demo1/dist/assets/plugins/global/plugins.bundle5883.js?v=7.2.9") }}"></script>
    <script src="{{ asset("template/assets/theme/html/demo1/dist/assets/plugins/custom/prismjs/prismjs.bundle5883.js?v=7.2.9") }}"></script>
    <script src="{{ asset("template/assets/theme/html/demo1/dist/assets/js/scripts.bundle5883.js?v=7.2.9") }}"></script>
    {{-- <script src="{{ asset("template/assets/keenthemes.com/metronic/assets/js/engage_code.js") }}"></script> --}}
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset("template/assets/theme/html/demo1/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle5883.js?v=7.2.9") }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset("template/assets/theme/html/demo1/dist/assets/js/pages/widgets5883.js?v=7.2.9") }}"></script>

    @yield('footer-modules')

    <!--end::Page Scripts-->
</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic/demo1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Apr 2022 17:26:00 GMT -->

</html>