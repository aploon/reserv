@extends('layouts.layout', ['categories' => $categories])

@section('head-modules')
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <style>
        .ts-control {
            border-radius: 5.04px !important;
            background-color: #F3F6F9 !important;
            border-color: #F3F6F9 !important;
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
                <a href="{{ Route('reservations.index') }}" style="color: #3F4254;">
                    <div class="text-grey font-weight-bold mt-2 mb-2 mr-3">Réservations</div>
                </a>

                <!-- Barre verticale -->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-3 bg-gray-200"></div>

                <div class="text-grey font-weight-bold mt-2 mb-2 mr-3">Création</div>

                <!--end::Page Path-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="{{ Route('reservations.mes_reservations') }}" class="btn btn-light btn-sm font-weight-bold font-size-base mr-2">Mes réservations</a>

                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
@endsection

@section('main-content')
    <div class="container">

        <div class="row d-flex justify-content-center">

            <div class="col-lg-8">

                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Réservation</h3>
                    </div>
                    <form method="POST" class="form" action="{{ Route('reservations.store') }}">

                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nom de la réservation *</label>
                                <?php
                                $name_reserv = Auth::user()->name . '-reserv-' . rand(100, 5000);
                                ?>
                                <input required type="text" name="nom" value="{{ $name_reserv }}" class="form-control form-control-solid"
                                    placeholder="Entrez un nom pour votre réservation" />
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control form-control-solid" rows="3"
                                    placeholder="Réservation de vidéo-projecteur pour soutenance Année-académique 2021-2022 (Informatique de gestion)"></textarea>
                                <span class="form-text text-muted">Une description textuelle de l'utilité de la
                                    réservation (Facultatif)</span>
                            </div>

                            <div class="form-group">
                                <select required name="materiel_id" class="" id="materiaux" placeholder="Choisissez le matériel...">
                                    <option value="">Select a materiel...</option>
                                    @foreach ($materiaux as $materiel)
                                        <option <?php echo ($request->materiel_id == $materiel->id)? 'selected' : '' ?> value="{{ $materiel->id }}">{{ $materiel->nom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label>Date de réservation *</label>
                            <div class="form-group row">
                                <div class="col">
                                    <div class="input-group date" id="kt_datetimepicker_7_1" data-target-input="nearest">
                                        <input required name="date_debut" type="text" class="form-control datetimepicker-input"
                                            placeholder="Date de début" data-target="#kt_datetimepicker_7_1" />
                                        <div class="input-group-append" data-target="#kt_datetimepicker_7_1"
                                            data-toggle="datetimepicker">
                                            <span class="input-group-text">
                                                <i class="ki ki-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group date" id="kt_datetimepicker_7_2" data-target-input="nearest">
                                        <input required name="date_fin" type="text" class="form-control datetimepicker-input" placeholder="Date de fin"
                                            data-target="#kt_datetimepicker_7_2" />
                                        <div class="input-group-append" data-target="#kt_datetimepicker_7_2"
                                            data-toggle="datetimepicker">
                                            <span class="input-group-text">
                                                <i class="ki ki-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary mr-2">Réserver</button>
                            <button type="reset" class="btn btn-secondary">Annuler</button>
                        </div>
                    </form>
                </div>

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
    <script src="{{ asset("template/assets/theme/html/demo1/dist/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker5883.js?v=7.2.9") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script>
        new TomSelect("#materiaux", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>
@endsection
