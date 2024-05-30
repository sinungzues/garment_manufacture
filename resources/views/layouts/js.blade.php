<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.canvaswrapper.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.colorhelpers.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.saturated.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.browser.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.drawSeries.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.uiConstants.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.time.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.crosshair.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.navigate.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.touchNavigate.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.hover.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.touch.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.selection.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.symbol.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/source/jquery.flot.legend.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jvectormap-next/jquery-jvectormap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jvectormap-content/world-mill.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/js/demo/dashboard.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net/js/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/demo/table-manage-buttons.demo.js') }}"></script>
<script src="{{ asset('assets/plugins/@highlightjs/cdn-assets/highlight.min.js') }}"></script>
<script src="{{ asset('assets/js/demo/render.highlight.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/demo/table-manage-default.demo.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/@fullcalendar/core/index.global.js') }}"></script>
<script src="{{ asset('assets/plugins/@fullcalendar/daygrid/index.global.js') }}"></script>
<script src="{{ asset('assets/plugins/@fullcalendar/timegrid/index.global.js') }}"></script>
<script src="{{ asset('assets/plugins/@fullcalendar/interaction/index.global.js') }}"></script>
<script src="{{ asset('assets/plugins/@fullcalendar/list/index.global.js') }}"></script>
<script src="{{ asset('assets/plugins/@fullcalendar/bootstrap/index.global.js') }}"></script>
<script src="{{ asset('assets/js/demo/calendar.demo.js') }}"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y3Q0VGQKY3"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y3Q0VGQKY3"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-Y3Q0VGQKY3');
</script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
    data-cf-settings="b802bbfe03fa8d4f1b2b4d88-|49" defer></script>
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':

                toastr.options.timeOut = 5000;
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':

                toastr.options.timeOut = 5000;
                toastr.success("{{ Session::get('message') }}");

                break;
            case 'warning':

                toastr.options.timeOut = 5000;
                toastr.warning("{{ Session::get('message') }}");

                break;
            case 'error':

                toastr.options.timeOut = 5000;
                toastr.error("{{ Session::get('message') }}");

                break;
        }
    @endif
</script>
