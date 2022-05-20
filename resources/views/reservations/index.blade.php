@extends('layouts.layout', ['categories' => $categories])

@section('head-modules')
    <?php use Illuminate\Support\Facades\DB; ?>
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
        <div id="div_page_path" class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div id="page_path" class="d-flex align-items-center flex-wrap mr-2">
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
                <a href="{{ Route('reservations.mes_reservations') }}" class="btn btn-light btn-sm font-weight-bold font-size-base mr-2">Mes réservations</a>

                <form method="POST" action="{{ Route('reservations.create') }}" class="m-0">
                    @csrf
                    <input type="text" name="materiel" hidden value="">
                    <button type="submit"
                        class="btn btn-sm btn-primary font-weight-bold font-size-base mr-1">Réserver</button>
                </form>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
@endsection

@section('main-content')

    <!-- Add materiel Modal-->
    <div class="modal fade" id="materiel_modal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ Route('materiaux.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="materiel_modal_label">Ajout de materiel
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nom du materiel</label>
                            <input required type="text" name="nom" placeholder="Nom du matériel"
                                class="form-control form-control-solid" />
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea">Description</label>
                            <textarea required name="description" class="form-control form-control-solid" rows="3"
                                placeholder="Petite description du matériel que vous souhaitez ajouter"></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Quantité en stock</label>
                                <input required name="qte" type="number" class="form-control form-control-solid" />
                            </div>
                            <div class="col">
                                <label>Numéro de série</label>
                                <input name="num_serie" type="text" class="form-control form-control-solid" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Catégorie</label>
                            <select required name="categorie_id" class="form-control form-control-solid">

                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">
                                        {{ $categorie->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                            data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">

        @if (isset($statut_insert_reserv))
            @if ($statut_insert_reserv == 'date error')
                <input type="text" hidden id="statut_insert_reserv_date_error">
            @endif

            @if ($statut_insert_reserv == 'insérer')
                <input type="text" hidden id="statut_insert_reserv_success">
            @endif

            @if ($statut_insert_reserv == 'non insérer')
                <input type="text" hidden id="statut_insert_reserv_failled">
            @endif

            @if ($statut_insert_reserv == 'materiel no found')
                <input type="text" hidden id="statut_insert_reserv_materiel_no_found">
            @endif
        @endif

        <div class="row">

            <?php $compte_materiel_select = 0; ?>
            <?php $compte_datetimepicker = 0; ?>

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
                            @foreach ($materiel->reservations->where('date_debut', '>=', now()) as $reservation)
                                @if (date('Y-m-d', strtotime($reservation->date_debut)) == date('Y-m-d', strtotime(now())))
                                    <?php $materiaux_reserv[] = $materiel; ?>
                                @endif
                            @endforeach
                        @endforeach

                        @foreach (array_unique($materiaux_reserv) as $materiel)
                            <?php $compte_materiel_select++; ?> <div class="card card-custom mb-5"
                                style="box-shadow: 0px 0px 0px 0px !important;">
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
                                            @foreach ($materiel->reservations->where('date_debut', '>=', now()) as $reservation)
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
                                            data-target="#modalReserv{{ $compte_materiel_select }}"
                                            class="btn btn-sm btn-clean font-weight-bold font-size-base mr-1">Réserver
                                            ></button>

                                        <!-- begin::Modal -->
                                        <div class="modal fade" id="modalReserv{{ $compte_materiel_select }}"
                                            tabindex="-1" role="dialog" aria-labelledby="modalReservTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content" >
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
                                                                    $name_reserv = Auth::user()->name . '-reserv-' . rand(100, 5000);
                                                                    ?>
                                                                    <input type="text" name="nom" required
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

                                                                    <label>Matériel à réserver *</label><select required
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

                                                                <?php $compte_datetimepicker++; ?>
                                                                <label>Date de réservation *</label>
                                                                <div class="form-group row">
                                                                    <div class="col-lg-6 mb-3">
                                                                        <div class="date_reserv_1 input-group date"
                                                                            id="datetimepicker_reserv_1{{ $compte_datetimepicker }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_debut" required
                                                                                value="{{ date('m/d/Y', strtotime(now())) . ' 7:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de début"
                                                                                data-target="#datetimepicker_reserv_1{{ $compte_datetimepicker }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_1{{ $compte_datetimepicker }}"
                                                                                data-toggle="datetimepicker">
                                                                                <span class="input-group-text">
                                                                                    <i class="ki ki-calendar"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-3">
                                                                        <div class="date_reserv_2 input-group date"
                                                                            id="datetimepicker_reserv_2{{ $compte_datetimepicker }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_fin" required
                                                                                value="{{ date('m/d/Y', strtotime(now())) . ' 10:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de fin"
                                                                                data-target="#datetimepicker_reserv_2{{ $compte_datetimepicker }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_2{{ $compte_datetimepicker }}"
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
                            @foreach ($materiel->reservations->where('date_debut', '>=', now()) as $reservation)
                                @if (date('Y-m-d', strtotime($reservation->date_debut)) == date('Y-m-d', strtotime(now() . '+1 day')))
                                    <?php $materiaux_reserv[] = $materiel; ?>
                                @endif
                            @endforeach
                        @endforeach

                        @foreach (array_unique($materiaux_reserv) as $materiel)
                            <?php $compte_materiel_select++; ?> <div class="card card-custom mb-5"
                                style="box-shadow: 0px 0px 0px 0px !important;">
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
                                            @foreach ($materiel->reservations->where('date_debut', '>=', now()) as $reservation)
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
                                            data-target="#modalReserv{{ $compte_materiel_select }}"
                                            class="btn btn-sm btn-clean font-weight-bold font-size-base mr-1">Réserver
                                            ></button>

                                        <!-- begin::Modal -->
                                        <div class="modal fade" id="modalReserv{{ $compte_materiel_select }}"
                                            tabindex="-1" role="dialog" aria-labelledby="modalReservTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content" >
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
                                                                    $name_reserv = Auth::user()->name . '-reserv-' . rand(100, 5000);
                                                                    ?>
                                                                    <input type="text" name="nom" required
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

                                                                    <label>Matériel à réserver *</label><select required
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

                                                                <?php $compte_datetimepicker++; ?>
                                                                <label>Date de réservation *</label>
                                                                <div class="form-group row">
                                                                    <div class="col-lg-6 mb-3">
                                                                        <div class="date_reserv_1 input-group date"
                                                                            id="datetimepicker_reserv_1{{ $compte_datetimepicker }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_debut" required
                                                                                value="{{ date('m/d/Y', strtotime(now() . '+1 days')) . ' 7:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de début"
                                                                                data-target="#datetimepicker_reserv_1{{ $compte_datetimepicker }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_1{{ $compte_datetimepicker }}"
                                                                                data-toggle="datetimepicker">
                                                                                <span class="input-group-text">
                                                                                    <i class="ki ki-calendar"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-3">
                                                                        <div class="date_reserv_2 input-group date"
                                                                            id="datetimepicker_reserv_2{{ $compte_datetimepicker }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_fin" required
                                                                                value="{{ date('m/d/Y', strtotime(now() . '+1 days')) . ' 10:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de fin"
                                                                                data-target="#datetimepicker_reserv_2{{ $compte_datetimepicker }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_2{{ $compte_datetimepicker }}"
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
                            @foreach ($materiel->reservations->where('date_debut', '>=', now()) as $reservation)
                                @if (date('Y-m-d', strtotime($reservation->date_debut)) == date('Y-m-d', strtotime(now() . '+2 day')))
                                    <?php $materiaux_reserv[] = $materiel; ?>
                                @endif
                            @endforeach
                        @endforeach

                        @foreach (array_unique($materiaux_reserv) as $materiel)
                            <?php $compte_materiel_select++; ?> <div class="card card-custom mb-5"
                                style="box-shadow: 0px 0px 0px 0px !important;">
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
                                            @foreach ($materiel->reservations->where('date_debut', '>=', now()) as $reservation)
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
                                            data-target="#modalReserv{{ $compte_materiel_select }}"
                                            class="btn btn-sm btn-clean font-weight-bold font-size-base mr-1">Réserver
                                            ></button>

                                        <!-- begin::Modal -->
                                        <div class="modal fade" id="modalReserv{{ $compte_materiel_select }}"
                                            tabindex="-1" role="dialog" aria-labelledby="modalReservTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content" >
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
                                                                    $name_reserv = Auth::user()->name . '-reserv-' . rand(100, 5000);
                                                                    ?>
                                                                    <input type="text" name="nom" required
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

                                                                    <label>Matériel à réserver *</label><select required
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

                                                                <?php $compte_datetimepicker++; ?>
                                                                <label>Date de réservation *</label>
                                                                <div class="form-group row">
                                                                    <div class="col-lg-6 mb-3">
                                                                        <div class="date_reserv_1 input-group date"
                                                                            id="datetimepicker_reserv_1{{ $compte_datetimepicker }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_debut" required
                                                                                value="{{ date('m/d/Y', strtotime(now() . '+2 days')) . ' 7:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de début"
                                                                                data-target="#datetimepicker_reserv_1{{ $compte_datetimepicker }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_1{{ $compte_datetimepicker }}"
                                                                                data-toggle="datetimepicker">
                                                                                <span class="input-group-text">
                                                                                    <i class="ki ki-calendar"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-3">
                                                                        <div class="date_reserv_2 input-group date"
                                                                            id="datetimepicker_reserv_2{{ $compte_datetimepicker }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_fin" required
                                                                                value="{{ date('m/d/Y', strtotime(now() . '+2 days')) . ' 10:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de fin"
                                                                                data-target="#datetimepicker_reserv_2{{ $compte_datetimepicker }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_2{{ $compte_datetimepicker }}"
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
                            @foreach ($materiel->reservations->where('date_debut', '>=', now()) as $reservation)
                                @if (date('Y-m-d', strtotime($reservation->date_debut)) == date('Y-m-d', strtotime(now() . ' +3 day')))
                                    <?php $materiaux_reserv[] = $materiel; ?>
                                @endif
                            @endforeach
                        @endforeach

                        @foreach (array_unique($materiaux_reserv) as $materiel)
                            <?php $compte_materiel_select++; ?> <div class="card card-custom mb-5"
                                style="box-shadow: 0px 0px 0px 0px !important;">
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
                                            @foreach ($materiel->reservations->where('date_debut', '>=', now()) as $reservation)
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
                                            data-target="#modalReserv{{ $compte_materiel_select }}"
                                            class="btn btn-sm btn-clean font-weight-bold font-size-base mr-1">Réserver
                                            ></button>

                                        <!-- begin::Modal -->
                                        <div class="modal fade" id="modalReserv{{ $compte_materiel_select }}"
                                            tabindex="-1" role="dialog" aria-labelledby="modalReservTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content" >
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
                                                                    $name_reserv = Auth::user()->name . '-reserv-' . rand(100, 5000);
                                                                    ?>
                                                                    <input type="text" name="nom" required
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

                                                                    <label>Matériel à réserver *</label><select required
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

                                                                <?php $compte_datetimepicker++; ?>
                                                                <label>Date de réservation *</label>
                                                                <div class="form-group row">
                                                                    <div class="col-lg-6 mb-3">
                                                                        <div class="date_reserv_1 input-group date"
                                                                            id="datetimepicker_reserv_1{{ $compte_datetimepicker }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_debut" required
                                                                                value="{{ date('m/d/Y', strtotime(now() . '+3 days')) . ' 7:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de début"
                                                                                data-target="#datetimepicker_reserv_1{{ $compte_datetimepicker }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_1{{ $compte_datetimepicker }}"
                                                                                data-toggle="datetimepicker">
                                                                                <span class="input-group-text">
                                                                                    <i class="ki ki-calendar"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-3">
                                                                        <div class="date_reserv_2 input-group date"
                                                                            id="datetimepicker_reserv_2{{ $compte_datetimepicker }}"
                                                                            data-target-input="nearest">
                                                                            <input name="date_fin" required
                                                                                value="{{ date('m/d/Y', strtotime(now() . '+3 days')) . ' 10:00 AM' }}"
                                                                                type="text"
                                                                                class="form-control datetimepicker-input"
                                                                                placeholder="Date de fin"
                                                                                data-target="#datetimepicker_reserv_2{{ $compte_datetimepicker }}" />
                                                                            <div class="input-group-append"
                                                                                data-target="#datetimepicker_reserv_2{{ $compte_datetimepicker }}"
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
                                                            <div class="modal-footer">
                                                                <button type="reset" class="btn btn-secondary"
                                                                    data-dismiss="modal">Annuler</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Réserver</button>
                                                            </div>
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

                    console.log(id_1);

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
        var statut_insert_reserv_date_error = document.getElementById('statut_insert_reserv_date_error');
        var statut_insert_reserv_materiel_no_found = document.getElementById('statut_insert_reserv_materiel_no_found');

        if (statut_insert_reserv_success != null) {


            toastr.options = {
                "closeButton": true,
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

        } else if (statut_insert_reserv_failled != null) {


            toastr.options = {
                "closeButton": true,
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

        } else if (statut_insert_reserv_date_error != null) {


            toastr.options = {
                "closeButton": true,
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

            toastr.error("Date de réservation incorrect !");

        } else if (statut_insert_reserv_materiel_no_found != null) {


            toastr.options = {
                "closeButton": true,
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

            toastr.error("Le materiel n'est pas disponible dans le délai imparti !");

        }
    </script>
@endsection
