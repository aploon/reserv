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

                <div class="text-grey font-weight-bold mt-2 mb-2 mr-3">{{ $categorie_name }}</div>
                <!--end::Page Path-->
            </div>
            <!--end::Info-->
            <?php
                                    
                $user = DB::table('users')
                    ->where('id', Auth::id())
                    ->first();
                
            ?>

            @if ($user->compte == 'Administrateur')
                <!--begin::Toolbar-->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#materiel_modal">
                    Ajouter un materiel
                </button>
                <!--end::Toolbar-->
            @else
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
            @endif
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
        <input id="categorie_id" type="hidden" value="{{ $materiaux->first()->categorie_id }}">
        <div class="row d-flex justify-content-center">

            <div class="col-lg-8">
                <div class="form-group">
                    <label>Recherchez un matériel</label>
                    <div class="input-icon input-icon-right">
                        <input id="search_id" type="text" class="form-control p-7" placeholder="Recherche..."
                            autocomplete="off" />
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
                    <div id="materiaux_html" class="card-body pt-8">

                        @foreach ($materiaux as $materiel)
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-10">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-100 mr-5">
                                    <img src="{{ asset($materiel->image->chemin) }}" alt="" srcset="">
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div class="div_materiel_hover d-flex flex-column font-weight-bold"
                                    style="position: relative">
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

                                    <?php
                                    
                                    $user = DB::table('users')
                                        ->where('id', Auth::id())
                                        ->first();
                                    
                                    ?>
                                    <!-- Update materiel Modal-->
                                    <div class="modal fade" id="materiel_modal_{{ $materiel->id }}"
                                        data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form
                                                    action="{{ Route('materiaux.update', ['materiaux' => $materiel->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="materiel_modal_label">Modification
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nom du materiel</label>
                                                            <input required type="text" name="nom"
                                                                value="{{ $materiel->nom }}"
                                                                class="form-control form-control-solid" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleTextarea">Description</label>
                                                            <textarea required name="description" class="form-control form-control-solid"
                                                                rows="3">{{ $materiel->description }}</textarea>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col">
                                                                <label>Quantité en stock</label>
                                                                <input required name="qte" type="number"
                                                                    value="{{ $materiel->qte }}"
                                                                    class="form-control form-control-solid" />
                                                            </div>
                                                            <div class="col">
                                                                <label>Numéro de série</label>
                                                                <input name="num_serie" type="text"
                                                                    value="{{ $materiel->num_serie }}"
                                                                    class="form-control form-control-solid" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Catégorie</label>
                                                            <select required name="categorie_id"
                                                                class="form-control form-control-solid">

                                                                @foreach ($categories as $categorie)
                                                                    @if ($categorie->nom == $materiel->categorie->nom)
                                                                        <option selected value="{{ $categorie->id }}">
                                                                            {{ $categorie->nom }}</option>
                                                                    @else
                                                                        <option value="{{ $categorie->id }}">
                                                                            {{ $categorie->nom }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                                            data-dismiss="modal">Annuler</button>
                                                        <button type="submit"
                                                            class="btn btn-primary font-weight-bold">Modifier</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($user->compte == 'Administrateur')
                                        <div class="div_btn_reserv row d-flex justify-content-end"
                                            style="position: absolute; bottom: 5px; right: 15px; display: none !important;">
                                            <button class="btn btn-light btn-text-primary btn-hover-text-primary"
                                                title="Disponible">{{ $materiel->qte }}</button>

                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#materiel_modal_{{ $materiel->id }}"
                                                style="margin-left: 10px">Modifier</button>
                                        </div>
                                    @else
                                        <div class="div_btn_reserv row d-flex justify-content-end"
                                            style="position: absolute; bottom: 5px; right: 15px; display: none !important;">
                                            <button class="btn btn-light btn-text-primary btn-hover-text-primary"
                                                title="Disponible actuellement">{{ $materiel_dispo }}</button>
                                            <form method="POST" action="{{ Route('reservations.create') }}"
                                                class="m-0">
                                                @csrf
                                                <input type="text" name="materiel_id" hidden value="{{ $materiel->id }}">
                                                <button type="submit" class="btn btn-primary"
                                                    style="margin-left: 10px">Réserver</button>
                                            </form>
                                        </div>
                                    @endif

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

    <script>
        $('#search_id').on('keyup', function() {
            var value = $(this).val();
            var categorie_id = $('#categorie_id').val();

            $.ajax({
                url: "search",
                method: "GET",
                data: {
                    search_value: value,
                    categorie_id: categorie_id
                },
                dataType: "json",
                success: function(data) {

                    if (data != 'material no found') {
                        $('#materiaux_html').html(data);
                    } else {
                        $('#materiaux_html').html(
                            '<div class="d-flex flex-center">Materiels indisponible !</div>');
                    }


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

                }
            })
        })
    </script>
@endsection
