@extends('layouts.layout', [
    'categorie_name' => $categorie_name,
    'categories' => $categories
])

@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Path-->
                <a href="{{ Route('dashboard') }}">
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-3">Accueil</h5>
                </a>

                <!-- Barre verticale -->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-3 bg-gray-200"></div>

                <a href="{{ Route('materiaux.index') }}" style="color: #3F4254;">
                    <div class="text-grey font-weight-bold mt-2 mb-2 mr-3">Tous les matériaux</div>
                </a>

                <!-- Barre verticale -->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-3 bg-gray-200"></div>

                <div class="text-grey font-weight-bold mt-2 mb-2 mr-3">{{$categorie_name}}</div>
                <!--end::Page Path-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="#" class="btn btn-clean btn-sm font-weight-bold font-size-base mr-1">Today</a>
                <a href="#" class="btn btn-clean btn-sm font-weight-bold font-size-base mr-1">Month</a>
                <a href="#" class="btn btn-clean btn-sm font-weight-bold font-size-base mr-1">Year</a>
                <!--end::Actions-->
                <!--begin::Daterange-->
                <a href="#" class="btn btn-sm btn-light font-weight-bold mr-2" id="kt_dashboard_daterangepicker"
                    data-toggle="tooltip" title="Select dashboard daterange" data-placement="left">
                    <span class="text-muted font-size-base font-weight-bold mr-2"
                        id="kt_dashboard_daterangepicker_title">Today</span>
                    <span class="text-primary font-size-base font-weight-bolder" id="kt_dashboard_daterangepicker_date">Aug
                        16</span>
                </a>
                <!--end::Daterange-->
                <!--begin::Dropdowns-->
                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                    <a href="#" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="svg-icon svg-icon-success svg-icon-lg">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Files/File-plus.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path
                                        d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right py-3">
                        <!--begin::Navigation-->
                        <ul class="navi navi-hover py-5">
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-drop"></i>
                                    </span>
                                    <span class="navi-text">New Group</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-list-3"></i>
                                    </span>
                                    <span class="navi-text">Contacts</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-rocket-1"></i>
                                    </span>
                                    <span class="navi-text">Groups</span>
                                    <span class="navi-link-badge">
                                        <span class="label label-light-primary label-inline font-weight-bold">new</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-bell-2"></i>
                                    </span>
                                    <span class="navi-text">Calls</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-gear"></i>
                                    </span>
                                    <span class="navi-text">Settings</span>
                                </a>
                            </li>
                            <li class="navi-separator my-3"></li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-magnifier-tool"></i>
                                    </span>
                                    <span class="navi-text">Help</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-bell-2"></i>
                                    </span>
                                    <span class="navi-text">Privacy</span>
                                    <span class="navi-link-badge">
                                        <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                </div>
                <!--end::Dropdowns-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
@endsection

@section('main-content')

    <div class="container">

        <div class="row d-flex justify-content-center">

            <div class="col-lg-8">
                <div class="form-group">
                    <label>Recherchez un matériel</label>
                    <div class="input-icon input-icon-right">
                        <input type="text" class="form-control p-7" placeholder="Recherche..." />
                        <span>
                            <i class="flaticon2-search-1 icon-md"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <!--begin::List Widget 1-->
                <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Matériaux</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-8">

                        @foreach ($materiaux as $materiel)
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-10">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-100 mr-5">
                                    <img src="{{ asset($materiel->image->chemin) }}" alt="" srcset="">
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div class="div_materiel_hover d-flex flex-column font-weight-bold" style="position: relative">
                                    <a href="#"
                                        class="text-dark text-hover-primary mb-1 font-size-lg">{{ $materiel['nom'] }}</a>
                                    <span class="text-muted">{{ $materiel['description'] }}</span>
                                    <?php
                                    $current_reserv = DB::table('reservations')
                                        ->where('materiel_id', $materiel->id)
                                        ->Where(function ($query) {
                                            $query
                                                ->where('date_debut', '>=', date('Y-m-d H:i:s', strtotime(now())))
                                                ->where('date_debut', '<=', date('Y-m-d H:i:s', strtotime(now() . '+2 hours')))
                                                ->orWhere(function ($query) {
                                                    $query->where('date_fin', '>=', date('Y-m-d H:i:s', strtotime(now())))->where('date_debut', '<=', date('Y-m-d H:i:s', strtotime(now() . '+2 hours')));
                                                });
                                        })
                                        ->get();
                                    
                                    $materiel_dispo = $materiel->qte - $current_reserv->count();
                                    
                                    ?>
                                    <div class="div_btn_reserv row d-flex justify-content-end"
                                        style="position: absolute; bottom: 5px; right: 15px; display: none !important;">
                                        <button class="btn btn-light btn-text-primary btn-hover-text-primary">{{ $materiel_dispo }}</button>
                                            <form method="POST" action="{{ Route('reservations.create') }}" class="m-0">
                                                @csrf
                                                <input type="text" name="materiel_id" hidden value="{{$materiel->id}}">
                                                <button type="submit"
                                                    class="btn btn-primary" style="margin-left: 10px">Réserver</button>
                                            </form>
                                    </div>
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->
                        @endforeach

                    </div>
                    <!--end::Body-->
                </div>
                <!--end::List Widget 1-->
            </div>

        </div>

    </div>
@endsection

</div>

@section('footer')
@endsection

@section('tools')
    @parent
@endsection

@section('footer-modules')
    <script>
        var div_materiel_hover = document.getElementsByClassName('div_materiel_hover');
        var div_btn_reserv = document.getElementsByClassName('div_btn_reserv');

        for (let i = 0; i < div_materiel_hover.length; i++) {

            div_materiel_hover[i].addEventListener('mouseover', function(event) {

                div_btn_reserv[i].style.setProperty('display', 'inline-block');

            });

            div_materiel_hover[i].addEventListener('mouseout', function(event) {

                div_btn_reserv[i].style.setProperty('display', 'none', 'important');

            });

        }
    </script>
@endsection 
