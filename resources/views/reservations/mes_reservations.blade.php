@extends('layouts.layout', ['categories' => $categories])

@section('head-modules')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #reservations-table_wrapper{
            overflow: auto;
        }
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

        div.dataTables_wrapper div.dataTables_processing {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 200px;
            margin-left: -100px;
            margin-top: -26px;
            text-align: center;
            padding: 1em 0;
        }

        input[type="search"] {

            margin-left: 0.5em;
            display: inline-block !important;
            height: calc(1.5em + 1.3rem + 2px);
            padding: 0.65rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #3F4254;
            background-color: #ffffff;
            background-clip: padding-box;
            border: 1px solid #E4E6EF;
            border-radius: 0.42rem;
            -webkit-box-shadow: none;
            box-shadow: none;
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;

        }

        table.dataTable>thead>tr>th:not(.sorting_disabled),
        table.dataTable>thead>tr>td:not(.sorting_disabled) {
            padding-right: 30px;
        }

        table.dataTable>thead .sorting,
        table.dataTable>thead .sorting_asc,
        table.dataTable>thead .sorting_desc,
        table.dataTable>thead .sorting_asc_disabled,
        table.dataTable>thead .sorting_desc_disabled {
            cursor: pointer;
            position: relative;
        }

        table.dataTable>thead .sorting:before,
        table.dataTable>thead .sorting:after,
        table.dataTable>thead .sorting_asc:before,
        table.dataTable>thead .sorting_asc:after,
        table.dataTable>thead .sorting_desc:before,
        table.dataTable>thead .sorting_desc:after,
        table.dataTable>thead .sorting_asc_disabled:before,
        table.dataTable>thead .sorting_asc_disabled:after,
        table.dataTable>thead .sorting_desc_disabled:before,
        table.dataTable>thead .sorting_desc_disabled:after {
            position: absolute;
            bottom: 0.9em;
            display: block;
            opacity: 0.3;
        }

        table.dataTable>thead .sorting:before,
        table.dataTable>thead .sorting_asc:before,
        table.dataTable>thead .sorting_desc:before,
        table.dataTable>thead .sorting_asc_disabled:before,
        table.dataTable>thead .sorting_desc_disabled:before {
            right: 1em;
            content: "↑";
        }

        table.dataTable>thead .sorting:after,
        table.dataTable>thead .sorting_asc:after,
        table.dataTable>thead .sorting_desc:after,
        table.dataTable>thead .sorting_asc_disabled:after,
        table.dataTable>thead .sorting_desc_disabled:after {
            right: 0.5em;
            content: "↓";
        }

        table.dataTable>thead .sorting_asc:before,
        table.dataTable>thead .sorting_desc:after {
            opacity: 1;
        }

        table.dataTable>thead .sorting_asc_disabled:before,
        table.dataTable>thead .sorting_desc_disabled:after {
            opacity: 0;
        }

        .dataTables_wrapper .dataTables_paginate {
            float: right;
            text-align: right;
            padding-top: .25em
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: .5em 1em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            *cursor: hand;
            color: #333 !important;
            border: 1px solid transparent;
            border-radius: 2px
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #333 !important;
            border: 1px solid #979797;
            background-color: white;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, white), color-stop(100%, #dcdcdc));
            background: -webkit-linear-gradient(top, white 0%, #dcdcdc 100%);
            background: -moz-linear-gradient(top, white 0%, #dcdcdc 100%);
            background: -ms-linear-gradient(top, white 0%, #dcdcdc 100%);
            background: -o-linear-gradient(top, white 0%, #dcdcdc 100%);
            background: linear-gradient(to bottom, white 0%, #dcdcdc 100%)
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            cursor: default;
            color: #666 !important;
            border: 1px solid transparent;
            background: transparent;
            box-shadow: none
        }

        .dataTables_wrapper .dataTables_info {
            clear: both;
            float: left;
            padding-top: 0.755em;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: white !important;
            border: 1px solid #111;
            background-color: #585858;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111));
            background: -webkit-linear-gradient(top, #585858 0%, #111 100%);
            background: -moz-linear-gradient(top, #585858 0%, #111 100%);
            background: -ms-linear-gradient(top, #585858 0%, #111 100%);
            background: -o-linear-gradient(top, #585858 0%, #111 100%);
            background: linear-gradient(to bottom, #585858 0%, #111 100%)
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:active {
            outline: none;
            background-color: #2b2b2b;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #0c0c0c));
            background: -webkit-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
            background: -moz-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
            background: -ms-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
            background: -o-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
            background: linear-gradient(to bottom, #2b2b2b 0%, #0c0c0c 100%);
            box-shadow: inset 0 0 3px #111
        }

        .dataTables_wrapper .dataTables_paginate .ellipsis {
            padding: 0 1em
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
                <a href="{{ Route('reservations.index') }}" style="color: #3F4254;">
                    <div class="text-grey font-weight-bold mt-2 mb-2 mr-3">Réservations</div>
                </a>

                <!-- Barre verticale -->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-3 bg-gray-200"></div>

                <div class="text-grey font-weight-bold mt-2 mb-2 mr-3">Mes réservations</div>

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
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
@endsection

@section('main-content')
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Remote Datasource
                            <span class="d-block text-muted pt-2 font-size-sm">Sorting &amp; pagination remote
                                datasource</span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>Export</button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi flex-column navi-hover py-2">
                                    <li
                                        class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                        Choose
                                        an option:</li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-print"></i>
                                            </span>
                                            <span class="navi-text">Print</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-copy"></i>
                                            </span>
                                            <span class="navi-text">Copy</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-excel-o"></i>
                                            </span>
                                            <span class="navi-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-text-o"></i>
                                            </span>
                                            <span class="navi-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-pdf-o"></i>
                                            </span>
                                            <span class="navi-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                        <!--end::Dropdown-->
                        <!--begin::Button-->
                        <a href="{{ Route('reservations.index') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path
                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>Réservation</a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Search Form-->
                    <!--begin::Search Form-->
                    {{-- <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                    <select class="form-control" id="kt_datatable_search_status">
                                        <option value="">All</option>
                                        <option value="1">Pending</option>
                                        <option value="2">Delivered</option>
                                        <option value="3">Canceled</option>
                                        <option value="4">Success</option>
                                        <option value="5">Info</option>
                                        <option value="6">Danger</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                    <select class="form-control" id="kt_datatable_search_type">
                                        <option value="">All</option>
                                        <option value="1">Online</option>
                                        <option value="2">Retail</option>
                                        <option value="3">Direct</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                        <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                    </div>
                </div>
            </div> --}}
                    <!--end::Search Form-->
                    <!--end: Search Form-->
                    <!--begin: Datatable-->
                    {{-- <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div> --}}
                    {{ $dataTable->table() }}
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->

            <!-- begin::Modal -->
            <div id="reserv_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalReservTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div id="form_update_reserv" data-id="" class="modal-content" >
                        <form id="id_form_reserv_update" class="form" action="">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                    Réservation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-reserv-body">
                                    <div class="form-group">
                                        <label>Nom de la réservation *</label>
                                        <input id="nom_reserv" type="text" name="nom" required value=""
                                            class="form-control form-control-solid"
                                            placeholder="Entrez un nom pour votre réservation" />
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea id="description_reserv" name="description" class="form-control form-control-solid" rows="3" value=""
                                            placeholder="Réservation de vidéo-projecteur pour soutenance Année-académique 2021-2022 (Informatique de gestion)"></textarea>
                                        <span class="form-text text-muted">Une description
                                            textuelle de l'utilité de la
                                            réservation (Facultatif)</span>
                                    </div>

                                    <div class="form-group">

                                        <label>Matériel à réserver *</label>
                                        <input id="materiel_nom_reserv" type="text" class="form-control materiaux_select"
                                            disabled="disabled" style="cursor: not-allowed;">
                                        <input id="materiel_id_reserv" type="hidden" name="materiel_id" value="">
                                    </div>

                                    <label>Date de réservation *</label>
                                    <div class="form-group row">
                                        <div class="col-lg-6 mb-3">
                                            <div class="date_reserv_1 input-group date" id="datetimepicker_reserv_1"
                                                data-target-input="nearest">
                                                <input id="date_debut_reserv" name="date_debut" required value=""
                                                    type="text" class="form-control datetimepicker-input"
                                                    placeholder="Date de début" data-target="#datetimepicker_reserv_1" />
                                                <div class="input-group-append" data-target="#datetimepicker_reserv_1"
                                                    data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="date_reserv_2 input-group date" id="datetimepicker_reserv_2"
                                                data-target-input="nearest">
                                                <input id="date_fin_reserv" name="date_fin" required value="" type="text"
                                                    class="form-control datetimepicker-input" placeholder="Date de fin"
                                                    data-target="#datetimepicker_reserv_2" />
                                                <div class="input-group-append" data-target="#datetimepicker_reserv_2"
                                                    data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input id="user_id_reserv" type="hidden" name="user_id"
                                        value="{{ Auth::user()->id }}">

                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button id="update_reserv_btn" data-id="" type="submit"
                                    class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end::Modal -->
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

                // Demo 7
                $('#datetimepicker_reserv_1').datetimepicker();
                $('#datetimepicker_reserv_2').datetimepicker({
                    useCurrent: false
                });

                $('#datetimepicker_reserv_1').on('change.datetimepicker', function(e) {
                    $('#datetimepicker_reserv_2').datetimepicker('minDate', e.date);
                });
                $('#datetimepicker_reserv_2').on('change.datetimepicker', function(e) {
                    $('#datetimepicker_reserv_1').datetimepicker('maxDate', e.date);
                });

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

    <script src="{{ asset('js/custom/jquery.dataTables.min.js') }}"></script>
    {{ $dataTable->scripts() }}

    <script>
        $(document).on('click', '.delete_reserv', function() {
            var id_reservation = $(this).data("id");


            Swal.fire({
                title: 'Annulation de réservation !',
                text: "Souhaitez-vous vraiment annuler cette réservation ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Annuler la réservation',
                cancelButtonText: 'Retour'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })

                    $.ajax({
                        url: id_reservation,
                        method: "DELETE",
                        dataType: "json",

                        success: function(data) {
                            console.log(data);
                            if (data == 'Réservation annulée !') {
                                swal.fire('Effectué', 'Réservation annulée avec succès',
                                    'success');
                            }
                            $('#reservations-table').DataTable().ajax.reload();
                        }
                    });
                }
            });

        });

        $(document).on('click', '.update_reserv', function() {
            
            var id_reservation = $(this).data("id");
            $('#id_form_reserv_update').attr('data-id', id_reservation);

            $('#nom_reserv').val('');
            $('#description_reserv').val('');
            $('#materiel_nom_reserv').val('');
            $('#date_debut_reserv').val('');
            $('#date_fin_reserv').val('');

            $.ajax({
                url: id_reservation + "/edit",
                method: "GET",
                dataType: "json",
                success: function(data) {

                    $('#nom_reserv').val(data[0]);
                    $('#description_reserv').val(data[1]);
                    $('#materiel_id_reserv').val(data[2]);
                    $('#materiel_nom_reserv').val(data[3]);
                    $('#date_debut_reserv').val(data[4]);
                    $('#date_fin_reserv').val(data[5]);

                }
            })

        });

        $(document).on('submit', '#id_form_reserv_update', function(event) {
            event.preventDefault();
            var id_reservation = $(this).data("id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: id_reservation,
                method: "PUT",
                data: {
                    nom: $('#nom_reserv').val(),
                    description: $('#description_reserv').val(),
                    date_debut: $('#date_debut_reserv').val(),
                    date_fin: $('#date_fin_reserv').val(),
                    materiel_id: $('#materiel_id_reserv').val(),
                    user_id: $('#user_id_reserv').val()
                },
                dataType: "json",

                success: function(data) {
                    console.log(data);
                    if (data == 'Modification effectuée !') {

                        $('#reserv_modal').modal('hide');
                        $('#id_form_reserv_update')[0].reset();
                        Swal.fire("Modification effectuée faux !", "Réservation modifier avec succès",
                            "success");
                    } else if (data == 'Modification non éffectuée !') {

                        $('#reserv_modal').modal('hide');
                        $('#id_form_reserv_update')[0].reset();
                        Swal.fire("Modification non effectuée !",
                            "Une erreur s'est produite lors de la modification", "success");
                    } else if (data == 'date error') {

                        $('#reserv_modal').modal('hide');
                        $('#id_form_reserv_update')[0].reset();

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

                    } else if (data == 'materiel no found') {

                        $('#reserv_modal').modal('hide');
                        $('#id_form_reserv_update')[0].reset();

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

                    $('#reservations-table').DataTable().ajax.reload();

                }
            })


        });
    </script>
@endsection
