<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10 ">
            <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                            {{ __('dashboard.Dashboard') }}
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a class="text-muted">{{ __('dashboard.Home') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button type="button" class="btn btn-light-primary me-3 d-flex" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="ki-outline ki-filter fs-2"></i>{{ __('dashboard.Filter') }}</button>
                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bold">{{ __('dashboard.Filter Options') }}</div>
                        </div>
                        <div class="separator border-gray-200"></div>
                        <form method="GET" action="{{ route('dashboard') }}">
                            <div class="px-7 py-5" data-kt-user-table-filter="form">
                                <div class="mb-10">
                                    <div class="row gap-3">
                                        <div class="col-12">
                                            <label class="fs-6 fw-bold mb-2">{{ __('dashboard.Start Date') }}</label>
                                            <input class="form-control form-control-solid kt_datepicker_2"
                                                value="{{ request()->start_date }}"
                                                placeholder="{{ __('dashboard.Enter Start Date') }}" name="start_date" />
                                        </div>
                                        <div class="col-12">
                                            <label class="fs-6 fw-bold mb-2">{{ __('dashboard.End Date') }}</label>
                                            <input class="form-control form-control-solid kt_datepicker_2"
                                                value="{{ request()->end_date }}"
                                                placeholder="{{ __('dashboard.Enter End Date') }}" name="end_date" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('dashboard') }}"
                                        class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                        data-kt-menu-dismiss="true"
                                        data-kt-user-table-filter="reset">{{ __('dashboard.Reset') }}</a>
                                    <button type="submit" class="btn btn-primary fw-semibold px-6"
                                        data-kt-menu-dismiss="true"
                                        data-kt-user-table-filter="filter">{{ __('dashboard.Apply') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="donations.php" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-outline ki-document text-primary fs-2x ms-n1"></i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">{{ number_format($contractCount) }}</div>
                                <div class="fw-semibold text-gray-600">{{ __('dashboard.Number of contracts') }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="events.php" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-outline ki-user-tick text-primary fs-2x ms-n1"></i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">{{ number_format($clientCount) }}</div>
                                <div class="fw-semibold text-gray-600">{{ __('dashboard.Number of clients') }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="campaigns.php" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-outline ki-questionnaire-tablet text-primary fs-2x ms-n1"></i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">€{{ number_format($totalMonthlyFee) }}</div>
                                <div class="fw-semibold text-gray-600">{{ __('dashboard.Active Contracts monthly fee (EUR €)') }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="partnered_organizations.php" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-outline ki-data text-primary fs-2x ms-n1"></i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">{{ number_format($leadCount) }}</div>
                                <div class="fw-semibold text-gray-600">{{ __('dashboard.Number of leads') }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-12 col-xl-12">
                        <div id="kt_calendar_app"></div>
                    </div>
                </div>
                <!--end::Row-->
            </div>  
            <!--end::Content container-->
        </div>

   
        <!--end::Content-->
    </div>
</x-app-layout>

<script src="{{ asset('theme/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
{{-- <script src="{{ asset('theme/assets/js/custom/apps/calendar/calendar.js') }}"></script> --}}
    <script>
        //   document.addEventListener('DOMContentLoaded', function () {
        //     var calendarEl = document.getElementById('calendar');
            
        //     var calendar = new FullCalendar.Calendar(calendarEl, {
        //         initialView: 'dayGridMonth',
        //         events: 
        //         [
        //                 {
        //                     id: 1,
        //                     title: "All Day Event",
        //                     start:  "2023-09-05",
        //                     end:  "2023-09-05",
        //                     description: "Toto lorem ipsum dolor sit incid idunt ut",
        //                     className: "fc-event-danger fc-event-solid-warning",
        //                     location: "Federation Square",
        //                 },], // This URL will be used to fetch events via AJAX
        //     });
            
        //     calendar.render();
        // });
        var event = '';
        var O = '';
        var I  = '';
        var R = '';
        var V = '';
        var F = '';
        var P = '';
         O = moment().startOf("day");
         I = O.format("YYYY-MM");
         R = O.clone().subtract(1, "day").format("YYYY-MM-DD");
         V = O.format("YYYY-MM-DD");
         F = document.getElementById("kt_calendar_app");
         P = O.clone().add(1, "day").format("YYYY-MM-DD");
        event = new FullCalendar.Calendar(F, {
                    locale: 'pt',
                    headerToolbar: {
                        left: "prev,next today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,timeGridDay",
                    },
                    initialDate: V,
                    navLinks: !0,
                    selectable: !0,
                    selectMirror: !0,
                    select: function (e) {
                        N(e), x();
                    },
                    eventClick: function (e) {
                        N({
                            id: e.event.id,
                            // title: e.event.title,
                            // description: e.event.extendedProps.description,
                            // location: e.event.extendedProps.location,
                            // startStr: e.event.startStr,
                            // endStr: e.event.endStr,
                            // allDay: e.event.allDay,
                        }),
                            B();
                    },
                    editable: !0,
                    dayMaxEvents: !0,
                    events: [],
                    datesSet: function (info) {
                        // This event is triggered when the calendar's view changes,
                        // including when the "next" or "previous" buttons are clicked.
                        // var start = info.view.activeStart; // Start date of the currently displayed view
                        // var end = info.view.activeEnd;     // End date of the currently displayed view
                        // console.log('aaaaaaaaaaaaaa', info.view.getCurrentData().viewTitle)
                        // console.log('View Start Date:', start);
                        // console.log('View End Date:', end);
                        var monthName = moment(info.view.getCurrentData().dateProfile.currentRange.start).format('MMMM');
        // console.log('Current Month:', monthName);
                        getAndAddEvent(monthName)
                        // // Check if the view's start date is in the past or future
                        // var today = new Date();
                        // if (start < today) {
                        //     console.log('View start date is in the past.');
                        //     // You can perform actions for past dates here
                        // } else if (start > today) {
                        //     console.log('View start date is in the future.');
                        //     // You can perform actions for future dates here
                        // } else {
                        //     console.log('View start date is today.');
                        //     // You can perform actions for today's date here
                        // }
                    }
                });

                function N(obj)
                {
                    var url = "{{ route('event.show', ':id') }}";
                    url = url.replace(':id', obj.id);
                    openModalBoxCalendar('kt_modal_view_event',url,'calendar_index');
                }
                function B()
                {

                }
                function getAndAddEvent(val) {
                    $.ajax({
                        url: "{{route('event.index')}}",
                        method: 'Get',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        data: {
                            month: val,
                        },
                        success: function(result) {
                            //remove event
                            event.getEvents().forEach(function(event) {
                                event.remove();
                            });
                            for (let index = 0; index < result.length; index++) {
                               
                                    var newEvent = {
                                        id  : result[index].id,
                                        title: result[index].name,
                                        start: convertDate(result[index].renews_in_date), 
                                        end:    convertDate(result[index].renews_in_date),   
                                    };
                                
                                 event.addEvent(newEvent);
                            }
                            
                            
                        },
                    });
                    
                }
                
                event.render();

                function convertDate(dateString)
                {
                    // Create a new Date object by parsing the date string
                    var date = new Date(dateString);

                    // Extract year, month, and day from the Date object
                    var year = date.getFullYear();
                    // Months are zero-based, so we add 1 to get the correct month
                    var month = ("0" + (date.getMonth() + 1)).slice(-2);
                    var day = ("0" + date.getDate()).slice(-2);

                    // Concatenate the year, month, and day with hyphens to get the desired format
                    return year + "-" + month + "-" + day;
                }
    
        </script>