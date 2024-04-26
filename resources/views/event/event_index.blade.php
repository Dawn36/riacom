<x-app-layout>
    <!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('layout.Event') }}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                {{-- <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">{{ Auth::user()->roles->first()->display_name }}</a>
                    </li>
                </ul> --}}
                <!--end::Breadcrumb-->
            </div>
           
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Calendar-->
                    <div id="kt_calendar_app"></div>
                    <!--end::Calendar-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->


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