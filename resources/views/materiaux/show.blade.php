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

    <div class="container">
        <input id="categorie_id" type="hidden" value="{{ $materiaux->first()->categorie_id}}">
        <div class="row d-flex justify-content-center">

            <div class="col-lg-8">
                <div class="form-group">
                    <label>Recherchez un matériel</label>
                    <div class="input-icon input-icon-right">
                        <input id="search_id" type="text" class="form-control p-7" placeholder="Recherche..." autocomplete="off"/>
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

                if(data != 'material no found'){
                    $('#materiaux_html').html(data);
                }else{
                    $('#materiaux_html').html('<div class="d-flex flex-center">Materiels indisponible !</div>');
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
