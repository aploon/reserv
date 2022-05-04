@extends('layouts.layout', ['categories' => $categories])

@section('head-modules')
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <style>
        .ts-control {
            border-radius: 5.04px !important;
            background-color: #F3F6F9 !important;
            border-color: #F3F6F9 !important;
        }

        .fade {
            transition: opacity .15s linear !important;
        }

        .modal.fade .modal-dialog {
            transition: transform .3s ease-out !important;
        }

    </style>
@endsection

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

                <div class="text-grey font-weight-bold mt-2 mb-2 mr-3">Réservations</div>

                <!--end::Page Path-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <form method="POST" action="{{ Route('reservations.create') }}" class="m-0">
                    @csrf
                    <input type="text" name="materiel" hidden value="">
                    <button type="submit"
                        class="btn btn-sm btn-primary font-weight-bold font-size-base mr-1">Réserver</button>
                </form>
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

        @if (isset($statut_insert_reserv))
            @if ($statut_insert_reserv == 'insérer')
                <input type="text" hidden id="statut_insert_reserv_success">
            @else
                <input type="text" hidden id="statut_insert_reserv_failled">
            @endif
        @endif

        <div class="row">

            <?php $compte_materiel_select = 0; ?>

            <div class="col-md-4 col-lg-3" style="height: fit-content">
                <!--begin::List Widget 9-->
                <div class="card card-custom card-stretch gutter-b"
                    style="background-color: #dee2e6; border-radius: 8px !important;">
                    <!--begin::Header-->
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="font-weight-bolder text-dark">Aujourd'hui</span>
                        </h3>
                        <div class="card-toolbar">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <!--end::Navigation-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body" style="padding: 0 15px !important;">

                        <?php $materiaux_reserv = []; ?>
                        @foreach ($materiaux as $materiel)
                            @foreach ($materiel->reservations as $reservation)
                                @if (date('Y-m-d', strtotime($reservation->date_debut)) == date('Y-m-d', strtotime(now())))
                                    <?php $materiaux_reserv[] = $materiel; ?>
                                @endif
                            @endforeach
                        @endforeach

                        @foreach (array_unique($materiaux_reserv) as $materiel)
                            <div class="card card-custom mb-5" style="box-shadow: 0px 0px 0px 0px !important;">
                                <!--begin::Header-->
                                <div class="border-0 px-5 pt-5">
                                    <h6 class="">
                                        <span class="font-weight-bolder text-dark">{{ $materiel->nom }}</span>
                                    </h6>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body px-5 py-1">
                                    <!--begin: Item-->
                                    <div class="d-flex flex-lg-fill">
                                        <div class="symbol-group symbol-hover">
                                            @foreach ($materiel->reservations as $reservation)
                                                @if (date('Y-m-d', strtotime($reservation->date_debut)) == date('Y-m-d', strtotime(now())))
                                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                                        title="{{ $reservation->user->name }}">
                                                        <img alt="Pic"
                                                            src="{{ asset($reservation->user->image->chemin) }}" />
                                                    </div>

                                                    {{-- <div class="symbol symbol-30 symbol-circle symbol-light"
                                                    data-toggle="tooltip" title="More users">
                                                    <span class="symbol-label font-weight-bold">5+</span>
                                                    </div> --}}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                    <div class="card-meta d-flex justify-content-between my-3">
                                        <div class="d-flex align-items-center">
                                            <i class="flaticon-network icon-2x text-muted font-weight-bold"></i>
                                        </div>

                                        <!--begin::Actions-->

                                        <button type="submit" data-toggle="modal"
                                            data-target="#modalReserv{{ $materiel->id }}"
                                            class="btn btn-sm btn-clean font-weight-bold font-size-base mr-1">Réserver
                                            ></button>

                                        <!-- begin::Modal -->
                                        <div class="modal fade" id="modalReserv{{ $materiel->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalReservTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable w-100" role="document">
                                                <div class="modal-content" style="min-width: 600px">
                                                    <form method="POST" class="form"
                                                        action="{{ Route('reservations.store') }}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                Réservation</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <i aria-hidden="true" class="ki ki-close"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">


                                                            @csrf
                                                            <div class="form-reserv-body">
                                                                <div class="form-group">
                                                                    <label>Nom de la réservation *</label>
                                                                    <?php
                                                                    $name_reserv = Auth::user()->name . '-reserv';
                                                                    ?>
                                                                    <input type="text" name="nom"
                                                                        value="{{ $name_reserv }}"
                                                                        class="form-control form-control-solid"
                                                                        placeholder="Entrez un nom pour votre réservation" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea name="description" class="form-control form-control-solid" rows="3"
                                                                        placeholder="Réservation de vidéo-projecteur pour soutenance Année-académique 2021-2022 (Informatique de gestion)"></textarea>
                                                                    <span class="form-text text-muted">Une description
                                                                        textuelle de l'utilité de la
                                                                        réservation (Facultatif)</span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <?php $compte_materiel_select++; ?>
                                                                    <label>Matériel à réserver *</label><select
                                                                        id="materiaux_select{{ $compte_materiel_select }}"
                                                                        name="materiel_id" class="materiaux_select"
                                                                        placeholder="Choisissez le matériel...">
                                                                        <option value="">Select a materiel...</option>
                                                                        @foreach ($materiaux as $materiel_in_option)
                                                                            <option <?php echo $materiel->id == $materiel_in_option->id ? 'selected' : ''; ?>
                                                                                value="{{ $materiel_in_option->id }}">
                                                                                {{ $materiel_in_option->nom }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <label>Date de réservation *</label>
                                                                <div class="form-group row">
                                                                    <div class="col">
                                                                        <div class="date_reserv_1 input-group date"
                                                                            id="datetimepicker_reserv_1{{ $materiel->reservations->first->get()->id }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_debut"
                                                                                value="{{ date('m/d/Y', strtotime(now())) . ' 7:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de début"
                                                                                data-target="#datetimepicker_reserv_1{{ $materiel->reservations->first->get()->id }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_1{{ $materiel->reservations->first->get()->id }}"
                                                                                data-toggle="datetimepicker">
                                                                                <span class="input-group-text">
                                                                                    <i class="ki ki-calendar"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="date_reserv_2 input-group date"
                                                                            id="datetimepicker_reserv_2{{ $materiel->reservations->first->get()->id }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_fin"
                                                                                value="{{ date('m/d/Y', strtotime(now())) . ' 10:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de fin"
                                                                                data-target="#datetimepicker_reserv_2{{ $materiel->reservations->first->get()->id }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_2{{ $materiel->reservations->first->get()->id }}"
                                                                                data-toggle="datetimepicker">
                                                                                <span class="input-group-text">
                                                                                    <i class="ki ki-calendar"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="user_id"
                                                                    value="{{ Auth::user()->id }}">

                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="reset" class="btn btn-secondary"
                                                                data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary">Réserver</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end::Modal -->

                                        <!--end::Actions-->

                                    </div>
                                </div>
                                <!--end: Card Body-->
                            </div>
                        @endforeach


                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end: List Widget 9-->
            </div>

            <div class="col-md-4 col-lg-3" style="height: fit-content">
                <!--begin::List Widget 9-->
                <div class="card card-custom card-stretch gutter-b"
                    style="background-color: #dee2e6; border-radius: 8px !important;">
                    <!--begin::Header-->
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="font-weight-bolder text-dark">Demain</span>
                        </h3>
                        <div class="card-toolbar">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <!--end::Navigation-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body" style="padding: 0 15px !important;">

                        <?php $materiaux_reserv = []; ?>
                        @foreach ($materiaux as $materiel)
                            @foreach ($materiel->reservations as $reservation)
                                @if (date('Y-m-d', strtotime($reservation->date_debut)) == date('Y-m-d', strtotime(now() . '+1 day')))
                                    <?php $materiaux_reserv[] = $materiel; ?>
                                @endif
                            @endforeach
                        @endforeach

                        @foreach (array_unique($materiaux_reserv) as $materiel)
                            <div class="card card-custom mb-5" style="box-shadow: 0px 0px 0px 0px !important;">
                                <!--begin::Header-->
                                <div class="border-0 px-5 pt-5">
                                    <h6 class="">
                                        <span class="font-weight-bolder text-dark">{{ $materiel->nom }}</span>
                                    </h6>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body px-5 py-1">
                                    <!--begin: Item-->
                                    <div class="d-flex flex-lg-fill">
                                        <div class="symbol-group symbol-hover">
                                            @foreach ($materiel->reservations as $reservation)
                                                @if (date('Y-m-d', strtotime($reservation->date_debut)) == date('Y-m-d', strtotime(now() . '+1 day')))
                                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                                        title="{{ $reservation->user->name }}">
                                                        <img alt="Pic"
                                                            src="{{ asset($reservation->user->image->chemin) }}" />
                                                    </div>

                                                    {{-- <div class="symbol symbol-30 symbol-circle symbol-light"
                                                    data-toggle="tooltip" title="More users">
                                                    <span class="symbol-label font-weight-bold">5+</span>
                                                    </div> --}}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                    <div class="card-meta d-flex justify-content-between my-3">
                                        <div class="d-flex align-items-center">
                                            <i class="flaticon-network icon-2x text-muted font-weight-bold"></i>
                                        </div>

                                        <!--begin::Actions-->

                                        <button type="submit" data-toggle="modal"
                                            data-target="#modalReserv{{ $materiel->id }}"
                                            class="btn btn-sm btn-clean font-weight-bold font-size-base mr-1">Réserver
                                            ></button>

                                        <!-- begin::Modal -->
                                        <div class="modal fade" id="modalReserv{{ $materiel->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalReservTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content" style="min-width: 600px">
                                                    <form method="POST" class="form"
                                                        action="{{ Route('reservations.store') }}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                Réservation</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <i aria-hidden="true" class="ki ki-close"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">


                                                            @csrf
                                                            <div class="form-reserv-body">
                                                                <div class="form-group">
                                                                    <label>Nom de la réservation *</label>
                                                                    <?php
                                                                    $name_reserv = Auth::user()->name . '-reserv';
                                                                    ?>
                                                                    <input type="text" name="nom"
                                                                        value="{{ $name_reserv }}"
                                                                        class="form-control form-control-solid"
                                                                        placeholder="Entrez un nom pour votre réservation" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea name="description" class="form-control form-control-solid" rows="3"
                                                                        placeholder="Réservation de vidéo-projecteur pour soutenance Année-académique 2021-2022 (Informatique de gestion)"></textarea>
                                                                    <span class="form-text text-muted">Une description
                                                                        textuelle de l'utilité de la
                                                                        réservation (Facultatif)</span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <?php $compte_materiel_select++; ?>
                                                                    <label>Matériel à réserver *</label><select
                                                                        id="materiaux_select{{ $compte_materiel_select }}"
                                                                        name="materiel_id" class="materiaux_select"
                                                                        placeholder="Choisissez le matériel...">
                                                                        <option value="">Select a materiel...</option>
                                                                        @foreach ($materiaux as $materiel_in_option)
                                                                            <option <?php echo $materiel->id == $materiel_in_option->id ? 'selected' : ''; ?>
                                                                                value="{{ $materiel_in_option->id }}">
                                                                                {{ $materiel_in_option->nom }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <label>Date de réservation *</label>
                                                                <div class="form-group row">
                                                                    <div class="col">
                                                                        <div class="date_reserv_1 input-group date"
                                                                            id="datetimepicker_reserv_1{{ $materiel->reservations->first->get()->id }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_debut"
                                                                                value="{{ date('m/d/Y', strtotime(now() . '+1 days')) . ' 7:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de début"
                                                                                data-target="#datetimepicker_reserv_1{{ $materiel->reservations->first->get()->id }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_1{{ $materiel->reservations->first->get()->id }}"
                                                                                data-toggle="datetimepicker">
                                                                                <span class="input-group-text">
                                                                                    <i class="ki ki-calendar"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="date_reserv_2 input-group date"
                                                                            id="datetimepicker_reserv_2{{ $materiel->reservations->first->get()->id }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_fin"
                                                                                value="{{ date('m/d/Y', strtotime(now() . '+1 days')) . ' 10:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de fin"
                                                                                data-target="#datetimepicker_reserv_2{{ $materiel->reservations->first->get()->id }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_2{{ $materiel->reservations->first->get()->id }}"
                                                                                data-toggle="datetimepicker">
                                                                                <span class="input-group-text">
                                                                                    <i class="ki ki-calendar"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="user_id"
                                                                    value="{{ Auth::user()->id }}">

                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="reset" class="btn btn-secondary"
                                                                data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary">Réserver</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end::Modal -->

                                        <!--end::Actions-->

                                    </div>
                                </div>
                                <!--end: Card Body-->
                            </div>
                        @endforeach


                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end: List Widget 9-->
            </div>

            <div class="col-md-4 col-lg-3" style="height: fit-content">
                <!--begin::List Widget 9-->
                <div class="card card-custom card-stretch gutter-b"
                    style="background-color: #dee2e6; border-radius: 8px !important;">
                    <!--begin::Header-->
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="font-weight-bolder text-dark">Après-demain</span>
                        </h3>
                        <div class="card-toolbar">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <!--end::Navigation-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body" style="padding: 0 15px !important;">

                        <?php $materiaux_reserv = []; ?>
                        @foreach ($materiaux as $materiel)
                            @foreach ($materiel->reservations as $reservation)
                                @if (date('Y-m-d', strtotime($reservation->date_debut)) == date('Y-m-d', strtotime(now() . '+2 day')))
                                    <?php $materiaux_reserv[] = $materiel; ?>
                                @endif
                            @endforeach
                        @endforeach

                        @foreach (array_unique($materiaux_reserv) as $materiel)
                            <div class="card card-custom mb-5" style="box-shadow: 0px 0px 0px 0px !important;">
                                <!--begin::Header-->
                                <div class="border-0 px-5 pt-5">
                                    <h6 class="">
                                        <span class="font-weight-bolder text-dark">{{ $materiel->nom }}</span>
                                    </h6>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body px-5 py-1">
                                    <!--begin: Item-->
                                    <div class="d-flex flex-lg-fill">
                                        <div class="symbol-group symbol-hover">
                                            @foreach ($materiel->reservations as $reservation)
                                                @if (date('Y-m-d', strtotime($reservation->date_debut)) == date('Y-m-d', strtotime(now() . '+2 day')))
                                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                                        title="{{ $reservation->user->name }}">
                                                        <img alt="Pic"
                                                            src="{{ asset($reservation->user->image->chemin) }}" />
                                                    </div>

                                                    {{-- <div class="symbol symbol-30 symbol-circle symbol-light"
                                                    data-toggle="tooltip" title="More users">
                                                    <span class="symbol-label font-weight-bold">5+</span>
                                                    </div> --}}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                    <div class="card-meta d-flex justify-content-between my-3">
                                        <div class="d-flex align-items-center">
                                            <i class="flaticon-network icon-2x text-muted font-weight-bold"></i>
                                        </div>

                                        <!--begin::Actions-->

                                        <button type="submit" data-toggle="modal"
                                            data-target="#modalReserv{{ $materiel->id }}"
                                            class="btn btn-sm btn-clean font-weight-bold font-size-base mr-1">Réserver
                                            ></button>

                                        <!-- begin::Modal -->
                                        <div class="modal fade" id="modalReserv{{ $materiel->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalReservTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content" style="min-width: 600px">
                                                    <form method="POST" class="form"
                                                        action="{{ Route('reservations.store') }}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                Réservation</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <i aria-hidden="true" class="ki ki-close"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">


                                                            @csrf
                                                            <div class="form-reserv-body">
                                                                <div class="form-group">
                                                                    <label>Nom de la réservation *</label>
                                                                    <?php
                                                                    $name_reserv = Auth::user()->name . '-reserv';
                                                                    ?>
                                                                    <input type="text" name="nom"
                                                                        value="{{ $name_reserv }}"
                                                                        class="form-control form-control-solid"
                                                                        placeholder="Entrez un nom pour votre réservation" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea name="description" class="form-control form-control-solid" rows="3"
                                                                        placeholder="Réservation de vidéo-projecteur pour soutenance Année-académique 2021-2022 (Informatique de gestion)"></textarea>
                                                                    <span class="form-text text-muted">Une description
                                                                        textuelle de l'utilité de la
                                                                        réservation (Facultatif)</span>
                                                                </div>

                                                                <div class="form-group">
                                                                    <?php $compte_materiel_select++; ?>
                                                                    <label>Matériel à réserver *</label><select
                                                                        id="materiaux_select{{ $compte_materiel_select }}"
                                                                        name="materiel_id" class="materiaux_select"
                                                                        placeholder="Choisissez le matériel...">
                                                                        <option value="">Select a materiel...</option>
                                                                        @foreach ($materiaux as $materiel_in_option)
                                                                            <option <?php echo $materiel->id == $materiel_in_option->id ? 'selected' : ''; ?>
                                                                                value="{{ $materiel_in_option->id }}">
                                                                                {{ $materiel_in_option->nom }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <label>Date de réservation *</label>
                                                                <div class="form-group row">
                                                                    <div class="col">
                                                                        <div class="date_reserv_1 input-group date"
                                                                            id="datetimepicker_reserv_1{{ $materiel->reservations->first->get()->id }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_debut"
                                                                                value="{{ date('m/d/Y', strtotime(now() . '+2 days')) . ' 7:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de début"
                                                                                data-target="#datetimepicker_reserv_1{{ $materiel->reservations->first->get()->id }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_1{{ $materiel->reservations->first->get()->id }}"
                                                                                data-toggle="datetimepicker">
                                                                                <span class="input-group-text">
                                                                                    <i class="ki ki-calendar"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="date_reserv_2 input-group date"
                                                                            id="datetimepicker_reserv_2{{ $materiel->reservations->first->get()->id }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_fin"
                                                                                value="{{ date('m/d/Y', strtotime(now() . '+2 days')) . ' 10:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de fin"
                                                                                data-target="#datetimepicker_reserv_2{{ $materiel->reservations->first->get()->id }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_2{{ $materiel->reservations->first->get()->id }}"
                                                                                data-toggle="datetimepicker">
                                                                                <span class="input-group-text">
                                                                                    <i class="ki ki-calendar"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="user_id"
                                                                    value="{{ Auth::user()->id }}">

                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="reset" class="btn btn-secondary"
                                                                data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary">Réserver</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end::Modal -->

                                        <!--end::Actions-->

                                    </div>
                                </div>
                                <!--end: Card Body-->
                            </div>
                        @endforeach


                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end: List Widget 9-->
            </div>

            <div class="col-md-4 col-lg-3" style="height: fit-content">
                <!--begin::List Widget 9-->
                <div class="card card-custom card-stretch gutter-b"
                    style="background-color: #dee2e6; border-radius: 8px !important;">
                    <!--begin::Header-->
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span
                                class="font-weight-bolder text-dark">{{ date('M d', strtotime(now() . ' +3 day')) }}</span>
                        </h3>
                        <div class="card-toolbar">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <!--end::Navigation-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body" style="padding: 0 15px !important;">

                        <?php $materiaux_reserv = []; ?>
                        @foreach ($materiaux as $materiel)
                            @foreach ($materiel->reservations as $reservation)
                                @if (date('Y-m-d', strtotime($reservation->date_debut)) == date('Y-m-d', strtotime(now() . ' +3 day')))
                                    <?php $materiaux_reserv[] = $materiel; ?>
                                @endif
                            @endforeach
                        @endforeach

                        @foreach (array_unique($materiaux_reserv) as $materiel)
                            <div class="card card-custom mb-5" style="box-shadow: 0px 0px 0px 0px !important;">
                                <!--begin::Header-->
                                <div class="border-0 px-5 pt-5">
                                    <h6 class="">
                                        <span class="font-weight-bolder text-dark">{{ $materiel->nom }}</span>
                                    </h6>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body px-5 py-1">
                                    <!--begin: Item-->
                                    <div class="d-flex flex-lg-fill">
                                        <div class="symbol-group symbol-hover">
                                            @foreach ($materiel->reservations as $reservation)
                                                @if (date('Y-m-d', strtotime($reservation->date_debut)) == date('Y-m-d', strtotime(now() . ' +3 day')))
                                                    <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip"
                                                        title="{{ $reservation->user->name }}">
                                                        <img alt="Pic"
                                                            src="{{ asset($reservation->user->image->chemin) }}" />
                                                    </div>

                                                    {{-- <div class="symbol symbol-30 symbol-circle symbol-light"
                                                    data-toggle="tooltip" title="More users">
                                                    <span class="symbol-label font-weight-bold">5+</span>
                                                    </div> --}}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                    <div class="card-meta d-flex justify-content-between my-3">
                                        <div class="d-flex align-items-center">
                                            <i class="flaticon-network icon-2x text-muted font-weight-bold"></i>
                                        </div>

                                        <!--begin::Actions-->

                                        <button type="submit" data-toggle="modal"
                                            data-target="#modalReserv{{ $materiel->id }}"
                                            class="btn btn-sm btn-clean font-weight-bold font-size-base mr-1">Réserver
                                            ></button>

                                        <!-- begin::Modal -->
                                        <div class="modal fade" id="modalReserv{{ $materiel->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalReservTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content" style="min-width: 600px">
                                                    <form method="POST" class="form"
                                                        action="{{ Route('reservations.store') }}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                Réservation</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <i aria-hidden="true" class="ki ki-close"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" class="form"
                                                                action="{{ Route('reservations.store') }}">

                                                                @csrf
                                                                <div class="form-reserv-body">
                                                                    <div class="form-group">
                                                                        <label>Nom de la réservation *</label>
                                                                        <?php
                                                                        $name_reserv = Auth::user()->name . '-reserv';
                                                                        ?>
                                                                        <input type="text" name="nom"
                                                                            value="{{ $name_reserv }}"
                                                                            class="form-control form-control-solid"
                                                                            placeholder="Entrez un nom pour votre réservation" />
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <textarea name="description" class="form-control form-control-solid" rows="3"
                                                                            placeholder="Réservation de vidéo-projecteur pour soutenance Année-académique 2021-2022 (Informatique de gestion)"></textarea>
                                                                        <span class="form-text text-muted">Une description
                                                                            textuelle de l'utilité de la
                                                                            réservation (Facultatif)</span>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <?php $compte_materiel_select++; ?>
                                                                        <label>Matériel à réserver *</label><select
                                                                            id="materiaux_select{{ $compte_materiel_select }}"
                                                                            name="materiel_id" class="materiaux_select"
                                                                            placeholder="Choisissez le matériel...">
                                                                            <option value="">Select a materiel...</option>
                                                                            @foreach ($materiaux as $materiel_in_option)
                                                                                <option <?php echo $materiel->id == $materiel_in_option->id ? 'selected' : ''; ?>
                                                                                    value="{{ $materiel_in_option->id }}">
                                                                                    {{ $materiel_in_option->nom }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <label>Date de réservation *</label>
                                                                    <div class="form-group row">
                                                                        <div class="col">
                                                                            <div class="date_reserv_1 input-group date"
                                                                                id="datetimepicker_reserv_1{{ $materiel->reservations->first->get()->id }}"
                                                                                data-target-input="nearest">
                                                                                <input name="date_debut"
                                                                                    value="{{ date('m/d/Y', strtotime(now() . '+3 days')) . ' 7:00 AM' }}"
                                                                                    type="text"
                                                                                    class="form-control datetimepicker-input"
                                                                                    placeholder="Date de début"
                                                                                    data-target="#datetimepicker_reserv_1{{ $materiel->reservations->first->get()->id }}" />
                                                                                <div class="input-group-append"
                                                                                    data-target="#datetimepicker_reserv_1{{ $materiel->reservations->first->get()->id }}"
                                                                                    data-toggle="datetimepicker">
                                                                                    <span class="input-group-text">
                                                                                        <i class="ki ki-calendar"></i>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="date_reserv_2 input-group date"
                                                                                id="datetimepicker_reserv_2{{ $materiel->reservations->first->get()->id }}"
                                                                                data-target-input="nearest">
                                                                                <input name="date_fin"
                                                                                    value="{{ date('m/d/Y', strtotime(now() . '+3 days')) . ' 10:00 AM' }}"
                                                                                    type="text"
                                                                                    class="form-control datetimepicker-input"
                                                                                    placeholder="Date de fin"
                                                                                    data-target="#datetimepicker_reserv_2{{ $materiel->reservations->first->get()->id }}" />
                                                                                <div class="input-group-append"
                                                                                    data-target="#datetimepicker_reserv_2{{ $materiel->reservations->first->get()->id }}"
                                                                                    data-toggle="datetimepicker">
                                                                                    <span class="input-group-text">
                                                                                        <i class="ki ki-calendar"></i>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <input type="hidden" name="user_id"
                                                                        value="{{ Auth::user()->id }}">

                                                                </div>

                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="reset" class="btn btn-secondary"
                                                                data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary">Réserver</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end::Modal -->

                                        <!--end::Actions-->

                                    </div>
                                </div>
                                <!--end: Card Body-->
                            </div>
                        @endforeach


                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end: List Widget 9-->
            </div>

        </div>


        <!--begin::Pagination-->
        {{-- <div class="card card-custom">
            <div class="card-body py-7">
                <!--begin::Pagination-->
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex flex-wrap mr-3">
                        <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                            <i class="ki ki-bold-double-arrow-back icon-xs"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                            <i class="ki ki-bold-arrow-back icon-xs"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
                        <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">23</a>
                        <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">24</a>
                        <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">25</a>
                        <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">26</a>
                        <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">27</a>
                        <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">28</a>
                        <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
                        <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                            <i class="ki ki-bold-arrow-next icon-xs"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                            <i class="ki ki-bold-double-arrow-next icon-xs"></i>
                        </a>
                    </div>
                </div>
                <!--end:: Pagination-->
            </div>
        </div> --}}
        <!--end::Pagination-->
    </div>
@endsection

</div>

@section('footer')
@endsection

@section('tools')
    @parent
@endsection

@section('footer-modules')
    {{-- DateTimepicker --}}
    <script>
        // Class definition

        var KTBootstrapDatetimepicker = function() {
            // Private functions
            var baseDemos = function() {

                var date_reserv_1 = document.getElementsByClassName('date_reserv_1');
                var date_reserv_2 = document.getElementsByClassName('date_reserv_2');

                for (let i = 0; i < date_reserv_1.length; i++) {

                    var id_1 = '#' + date_reserv_1[i].getAttribute('id');
                    var id_2 = '#' + date_reserv_2[i].getAttribute('id');

                    // Demo 7
                    $(id_1).datetimepicker();
                    $(id_2).datetimepicker({
                        useCurrent: false
                    });

                    $(id_1).on('change.datetimepicker', function(e) {
                        $(id_2).datetimepicker('minDate', e.date);
                    });
                    $(id_2).on('change.datetimepicker', function(e) {
                        $(id_1).datetimepicker('maxDate', e.date);
                    });

                }

            }



            return {
                // Public functions
                init: function() {
                    baseDemos();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTBootstrapDatetimepicker.init();
        });
    </script>
    {{-- <script
        src="{{ asset('template/assets/theme/html/demo1/dist/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker5883.js?v=7.2.9') }}">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    {{-- Tom select --}}
    <script>
        window.onload = function selectFunction() {
            var materiaux_select = document.getElementsByClassName('materiaux_select');

            for (let i = 0; i < materiaux_select.length; i++) {

                if (materiaux_select[i].hasAttribute('id')) {

                    var id = '#' + materiaux_select[i].getAttribute('id');

                    new TomSelect(id, {
                        create: false,
                        sortField: {
                            field: "text",
                            direction: "asc"
                        }
                    });
                }

            }
        }
    </script>

    {{-- Toast view --}}
    <script>
        var statut_insert_reserv_success = document.getElementById('statut_insert_reserv_success');
        var statut_insert_reserv_failled = document.getElementById('statut_insert_reserv_failled');

        if (statut_insert_reserv_success != null) {


            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            toastr.success("Votre réservation à été éffectué !");

        }else if(statut_insert_reserv_failled != null) {

            
            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            };

            toastr.error("Erreur lors de la réservation !");

        }
    </script>
@endsection
