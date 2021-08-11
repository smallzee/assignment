{{-- <script src="{{ asset('dashboard/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('dashboard/js/jquery-ui.js') }}"></script>
<script src="{{ asset('dashboard/js/popper.min.js') }}"></script>
<script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dashboard/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('dashboard/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('dashboard/js/isotope-3.0.6.min.js') }}"></script>
<script src="{{ asset('dashboard/js/select2.min.js') }}"></script>
<script src="{{ asset('dashboard/js/chart.js') }}"></script>
<script src="{{ asset('dashboard/js/line-chart.js') }}"></script>
<script src="{{ asset('dashboard/js/doughutchart.js') }}"></script>
<script src="{{ asset('dashboard/js/moment.min.js') }}"></script>
<script src="{{ asset('dashboard/js/daterangepicker.js') }}"></script>
<script src="{{ asset('dashboard/js/purecounter.js') }}"></script>
<script src="{{ asset('dashboard/js/jquery.filer.min.js') }}"></script>
<script src="{{ asset('dashboard/js/jquery-nice-select.js') }}"></script>
<script src="{{ asset('dashboard/js/smooth-scrolling.js') }}"></script>
<script src="{{ asset('dashboard/js/progresscircle.js') }}"></script>
<script src="{{ asset('dashboard/js/main.js') }}"></script>
<script>
    (function ($) {
        "use strict"; //use of strict
        $(function () {
            $('select').niceSelect();
        });
    })(jQuery);

</script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
"scrollX": true
} );
    });
</script> --}}

<!-- External JavaScripts -->
<script src="{{ asset('dashboard/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('dashboard/assets/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script> --}}
<script src="{{ asset('dashboard/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/magnific-popup/magnific-popup.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/counter/waypoints-min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/counter/counterup.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/imagesloaded/imagesloaded.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/masonry/masonry.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/masonry/filter.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/scroll/scrollbar.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/functions.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/chart/chart.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/admin.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/calendar/moment.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/calendar/fullcalendar.js') }}"></script>
{{-- <script src="{{ asset('dashboard/assets/vendors/switcher/switcher.js') }}"></script> --}}
<script src="{{ asset('dashboard/assets/vendors/file-upload/imageuploadify.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/file-upload/imageuploadify.min.js') }}"></script>

<script>
  $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: '2019-03-12',
      navLinks: true, // can click day/week names to navigate views

      weekNumbers: true,
      weekNumbersWithinDays: true,
      weekNumberCalculation: 'ISO',

      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2019-03-01'
        },
        {
          title: 'Long Event',
          start: '2019-03-07',
          end: '2019-03-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2019-03-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2019-03-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2019-03-11',
          end: '2019-03-13'
        },
        {
          title: 'Meeting',
          start: '2019-03-12T10:30:00',
          end: '2019-03-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2019-03-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2019-03-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2019-03-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2019-03-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2019-03-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2019-03-28'
        }
      ]
    });

  });

</script>

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
"scrollX": true
} );
    });
</script>