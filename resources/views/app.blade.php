<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title>Management Info</title>

        <!-- Global stylesheets -->
        <link href="{{asset('global_assets/fonts/inter/inter.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('global_assets/icons/phosphor/styles.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/ltr/all.min.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script src="{{asset('global_assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('global_assets/js/jquery/jquery.min.js')}}"></script>
        <!-- /core JS files -->

        <!-- Datatable JS -->
        {{-- <script src="{{asset('global_assets/js/vendor/tables/datatables/datatables.min.js')}}"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script> --}}

        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

        <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

        <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

        {{-- <script src="{{asset('global_assets/js/vendor/ui/moment/moment.min.js')}}"></script>
        <script src="{{asset('global_assets/js/vendor/pickers/daterangepicker.js')}}"></script>
        <script src="{{asset('global_assets/js/vendor/pickers/datepicker.min.js')}}"></script> --}}


        <!-- Toaster files -->
        <script src="{{asset('global_assets/js/toastr/toastr.min.js')}}"></script>
        <link href="{{asset('global_assets/js/toastr/toastr.css')}}" rel="stylesheet">

        {{-- <script src="{{asset('global_assets/js/vendor/pickers/picker_date.js')}}"></script> --}}

        <!-- Theme JS files -->
        <script src="{{asset('assets/js/app.js')}}"></script>
        <!-- /theme JS files -->

        <!-- App JS -->
        @vite('resources/js/app.js')
    </head>

    <body id="app">

    </body>

</html>
