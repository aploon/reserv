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

<!-- Mirrored from preview.keenthemes.com/metronic/demo1/custom/pages/login/login-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Apr 2022 17:42:30 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

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
            j.src = '{{ asset('template/assets/www.googletagmanager.com/gtm5445.html') }}?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5FS8GGP');
    </script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8" />
    <title>Login Page 1 | Keenthemes</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet"
        href="{{ asset('template/assets/fonts/fonts.googleapis.com/css/fonts.css?family=Poppins:300,400,500,600,700') }}" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('template/assets/theme/html/demo1/dist/assets/css/pages/login/login-15883.css?v=7.2.9') }}"
        rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
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
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-1 login-forgot-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
            id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                    <!--begin::Aside header-->
                    <a href="#" class="text-center mb-10">
                        <img src="{{ asset('template/assets/theme/html/demo1/dist/assets/media/logos/logo-letter-1.png') }}"
                            class="max-h-70px" alt="" />
                    </a>
                    <!--end::Aside header-->
                    <!--begin::Aside title-->
                    <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">
                        Découvrez notre plateforme
                        <br />de réservation ultime
                    </h3>
                    <!--end::Aside title-->
                </div>
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                    style="background-image: url({{ asset('template/assets/theme/html/demo1/dist/assets/media/svg/illustrations/login-visual-5.svg') }})">
                </div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div
                class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-center">
                    <!--begin::Signin-->
                    <div class="login-form login-forgot">
                        <x-guest-layout>
                            <x-slot name="logo">
                            </x-slot>
            
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
            
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
                            <form class="form" method="POST" id="kt_login_forgot_form" action="{{ route('password.email') }}">
                                @csrf

                                <!--begin::Title-->
                                <div class="pb-13 pt-lg-0 pt-5">
                                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Mot de passe oublié ?</h3>
                                    <p class="text-muted font-weight-bold font-size-h4">Entrez votre e-mail pour la réinitialisation</p>
                                </div>
                                <!--end::Title-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" 
                                    type="email" placeholder="Email" name="email" required autofocus />
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                            <div class="form-group d-flex flex-wrap pb-lg-0">
                                <button type="button" id="kt_login_forgot_submit"
                                    class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                                <a href="{{ Route('login') }}"><button type="button" id="kt_login_forgot_cancel_off"
                                    class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Annuler</button></a>
                            </div>
                            <!--end::Form group-->
                            </form>
                        </x-guest-layout>
                    </div>
                    <!--end::Signin-->
                </div>
                <!--end::Content body-->
                <!--begin::Content footer-->
                <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                    <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                        <span class="mr-1">2022©</span>
                        <a href="http://keenthemes.com/metronic" target="_blank"
                            class="text-dark-75 text-hover-primary">Keenthemes</a>
                    </div>
                    <a href="#" class="text-primary font-weight-bolder font-size-lg">Terms</a>
                    <a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Plans</a>
                    <a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Contact Us</a>
                </div>
                <!--end::Content footer-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
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
    <script
        src="{{ asset('template/assets/theme/html/demo1/dist/assets/js/pages/custom/login/login-general5883.js?v=7.2.9') }}">
    </script>
    <!--end::Page Scripts-->
</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic/demo1/custom/pages/login/login-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Apr 2022 17:42:33 GMT -->

</html>
