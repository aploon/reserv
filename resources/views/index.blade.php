@extends('layouts.layout', ['categories' => $categories])

@section('title')
    Reserv
@endsection

@section('head-modules')
    <link
        href="{{ asset('template/assets/theme/html/demo1/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle5883.css?v=7.2.9') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Path-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-3">Accueil</h5>

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

@section('preloader')
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
@endsection

@section('main-content')
    <div class="container">

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

        <div class="row">

            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Toutes les réservations</h3>
                    </div>
                    <div class="card-toolbar">
                        <form method="POST" action="{{ Route('reservations.create') }}" class="m-0">
                        @csrf
                        <input type="text" name="materiel" hidden value="">
                        <button type="submit"
                            class="btn btn-light-primary font-weight-bold font-size-base mr-1"><i class="ki ki-plus icon-md mr-2"></i>Réserver</button>
                    </form>
                    </div>
                </div>
                <div class="card-body">
                    <div id="kt_calendar"></div>
                </div>
            </div>
            <!--end::Card-->
            <!--begin::Code example-->

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
    <!--begin::Page Vendors(used by this page)-->
    <script
        src="{{ asset('template/assets/theme/html/demo1/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle5883.js?v=7.2.9') }}">
    </script>
    <!--end::Page Vendors-->
    {{-- <script src="{{ asset('template/assets/theme/html/demo1/dist/assets/js/pages/features/calendar/basic5883.js') }}"></script> --}}

    <script>
        jQuery(document).ready(function() {

            $("#splash").addClass("hidden");

            $.ajax({
                url: "reservations/fullcalendar",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    var events = [data.length];
                    for (let i = 0; i < data.length; i++) {

                        var todayDate = moment().startOf('day');
                        var TODAY = todayDate.format('YYYY-MM-DD');
                        var className = '';

                        if (data[i].date_debut > TODAY) {
                            className = "fc-event-danger fc-event-solid-warning"
                            if (data[i].date_debut > TODAY + '+02 days') {
                                className = "fc-event-danger fc-event-solid-primary"
                            }
                        } else if (data[i].date_fin > TODAY) {
                            className = "fc-event-danger fc-event-solid-light"
                        } else {
                            className = "fc-event-success"
                        }

                        events[i] = {

                            title: data[i].nom,
                            start: data[i].date_debut,
                            description: (data[i].description == null) ? data[i].nom : data[i]
                                .description,
                            end: data[i].date_fin,
                            className: className

                        }

                    }
                    console.log(events);

                    "use strict";

                    var KTCalendarBasic = function() {

                        return {
                            //main function to initiate the module
                            init: function() {
                                var todayDate = moment().startOf('day');
                                var YM = todayDate.format('YYYY-MM');
                                var YESTERDAY = todayDate.clone().subtract(1, 'day').format(
                                    'YYYY-MM-DD');
                                var TODAY = todayDate.format('YYYY-MM-DD');
                                var TOMORROW = todayDate.clone().add(1, 'day').format(
                                    'YYYY-MM-DD');

                                var calendarEl = document.getElementById('kt_calendar');
                                var calendar = new FullCalendar.Calendar(calendarEl, {
                                    plugins: ['bootstrap', 'interaction', 'dayGrid',
                                        'timeGrid', 'list'
                                    ],
                                    themeSystem: 'bootstrap',

                                    isRTL: KTUtil.isRTL(),

                                    header: {
                                        left: 'prev,next today',
                                        center: 'title',
                                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                                    },

                                    height: 800,
                                    contentHeight: 780,
                                    aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

                                    nowIndicator: true,
                                    now: TODAY + 'T09:25:00', // just for demo

                                    views: {
                                        dayGridMonth: {
                                            buttonText: 'month'
                                        },
                                        timeGridWeek: {
                                            buttonText: 'week'
                                        },
                                        timeGridDay: {
                                            buttonText: 'day'
                                        }
                                    },

                                    defaultView: 'dayGridMonth',
                                    defaultDate: TODAY,

                                    editable: true,
                                    eventLimit: true, // allow "more" link when too many events
                                    navLinks: true,
                                    events: events,
                                    // [{
                                    //         title: 'All Day',
                                    //         start: YM + '-01',
                                    //         description: 'Toto lorem ipsum dolor sit incid idunt ut',
                                    //         className: "fc-event-danger fc-event-solid-warning"
                                    //     }
                                    //     {
                                    //         title: 'All Day',
                                    //         start: YM + '-01',
                                    //         description: 'Toto lorem ipsum dolor sit incid idunt ut',
                                    //         end: YM + '-02',
                                    //         className: "fc-event-danger fc-event-solid-warning"
                                    //     },
                                    //     {
                                    //         title: 'All Day',
                                    //         start: YM + '-01',
                                    //         description: 'Toto lorem ipsum dolor sit incid idunt ut',
                                    //         end: YM + '-02',
                                    //         className: "fc-event-danger fc-event-solid-primary"
                                    //     },
                                    //     {
                                    //         title: 'All Day',
                                    //         start: YM + '-01',
                                    //         description: 'Toto lorem ipsum dolor sit incid idunt ut',
                                    //         end: YM + '-02',
                                    //         className: "fc-event-danger fc-event-solid-light"
                                    //     },
                                    //     {
                                    //         title: 'Reporting',
                                    //         start: YM + '-14T13:30:00',
                                    //         description: 'Lorem ipsum dolor incid idunt ut labore',
                                    //         end: YM + '-14',
                                    //         className: "fc-event-success"
                                    //     },
                                    //     {
                                    //         title: 'Company Trip',
                                    //         start: YM + '-02',
                                    //         description: 'Lorem ipsum dolor sit tempor incid',
                                    //         end: YM + '-03',
                                    //         className: "fc-event-primary"
                                    //     },
                                    //     {
                                    //         title: 'ICT Expo 2017 - Product Release',
                                    //         start: YM + '-03',
                                    //         description: 'Lorem ipsum dolor sit tempor inci',
                                    //         end: YM + '-05',
                                    //         className: "fc-event-light fc-event-solid-primary"
                                    //     },
                                    //     {
                                    //         title: 'Dinner',
                                    //         start: YM + '-12',
                                    //         description: 'Lorem ipsum dolor sit amet, conse ctetur',
                                    //         end: YM + '-10'
                                    //     },
                                    //     {
                                    //         id: 999,
                                    //         title: 'Repeating Event',
                                    //         start: YM + '-09T16:00:00',
                                    //         description: 'Lorem ipsum dolor sit ncididunt ut labore',
                                    //         className: "fc-event-danger"
                                    //     },
                                    //     {
                                    //         id: 1000,
                                    //         title: 'Repeating Event',
                                    //         description: 'Lorem ipsum dolor sit amet, labore',
                                    //         start: YM + '-16T16:00:00'
                                    //     },
                                    //     {
                                    //         title: 'Conference',
                                    //         start: YESTERDAY,
                                    //         end: TOMORROW,
                                    //         description: 'Lorem ipsum dolor eius mod tempor labore',
                                    //         className: "fc-event-primary"
                                    //     },
                                    //     {
                                    //         title: 'Meeting',
                                    //         start: TODAY + 'T10:30:00',
                                    //         end: TODAY + 'T12:30:00',
                                    //         description: 'Lorem ipsum dolor eiu idunt ut labore'
                                    //     },
                                    //     {
                                    //         title: 'Lunch',
                                    //         start: TODAY + 'T12:00:00',
                                    //         className: "fc-event-info",
                                    //         description: 'Lorem ipsum dolor sit amet, ut labore'
                                    //     },
                                    //     {
                                    //         title: 'Meeting',
                                    //         start: TODAY + 'T14:30:00',
                                    //         className: "fc-event-warning",
                                    //         description: 'Lorem ipsum conse ctetur adipi scing'
                                    //     },
                                    //     {
                                    //         title: 'Happy Hour',
                                    //         start: TODAY + 'T17:30:00',
                                    //         className: "fc-event-info",
                                    //         description: 'Lorem ipsum dolor sit amet, conse ctetur'
                                    //     },
                                    //     {
                                    //         title: 'Dinner',
                                    //         start: TOMORROW + 'T05:00:00',
                                    //         className: "fc-event-solid-danger fc-event-light",
                                    //         description: 'Lorem ipsum dolor sit ctetur adipi scing'
                                    //     },
                                    //     {
                                    //         title: 'Birthday Party',
                                    //         start: TOMORROW + 'T07:00:00',
                                    //         className: "fc-event-primary",
                                    //         description: 'Lorem ipsum dolor sit amet, scing'
                                    //     },
                                    //     {
                                    //         title: 'Click for Google',
                                    //         url: 'http://google.com/',
                                    //         start: YM + '-28',
                                    //         className: "fc-event-solid-info fc-event-light",
                                    //         description: 'Lorem ipsum dolor sit amet, labore'
                                    //     }
                                    // ],

                                    eventRender: function(info) {
                                        var element = $(info.el);

                                        if (info.event.extendedProps && info.event
                                            .extendedProps.description) {
                                            if (element.hasClass(
                                                    'fc-day-grid-event')) {
                                                element.data('content', info.event
                                                    .extendedProps.description);
                                                element.data('placement', 'top');
                                                KTApp.initPopover(element);
                                            } else if (element.hasClass(
                                                    'fc-time-grid-event')) {
                                                element.find('.fc-title').append(
                                                    '<div class="fc-description">' +
                                                    info.event.extendedProps
                                                    .description + '</div>');
                                            } else if (element.find(
                                                    '.fc-list-item-title')
                                                .lenght !== 0) {
                                                element.find('.fc-list-item-title')
                                                    .append(
                                                        '<div class="fc-description">' +
                                                        info.event.extendedProps
                                                        .description + '</div>');
                                            }
                                        }
                                    }
                                });

                                calendar.render();
                            }
                        };
                    }();

                    KTCalendarBasic.init();

                }
            })

        });
    </script>
@endsection
