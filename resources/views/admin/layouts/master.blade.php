<!doctype html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>پنل مدیریت ezcafe</title>

    <meta name="description" content="">
    <meta name="author" content="vaseto">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/admin/media/favicons/android-chrome-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/admin/media/favicons/apple-touch-icon.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->

    <!-- Global JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/highlightjs/styles/atom-one-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/jquery-autoComplete/jquery.auto-complete.css') }}">

    <!-- Page JS Plugins CSS -->
    @stack('styles')

    <!-- Dashmix framework -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/admin/css/dashmix.css') }}?v=2">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/admin/css/styles.css') }}?v={{ time() }}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/xwork.min.css"> -->
    <!-- END Stylesheets -->
</head>

<body>

    @yield('body-content')

    <!--
      Dashmix JS

      Core libraries and functionality
      webpack is putting everything together at assets/_js/main/app.js
    -->
    <script src="{{ asset('assets/admin/js/dashmix.app.min.js') }}?v=2"></script>
    <script src="{{ asset('assets/admin/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/highlightjs/highlight.pack.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/jquery-autoComplete/jquery.auto-complete.min.js') }}"></script>

    <script>
        let BASE_URL = "{{ route('admin.dashboard') }}";
    </script>

    <script src="{{ asset('assets/admin/js/scripts.js') }}?v=6"></script>

    <!-- ERRORS Modal -->
    <div class="modal fade" id="errors-modal" tabindex="-1" role="dialog" aria-labelledby="errors-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideup modal-xl" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header bg-danger">
                        <h3 class="block-title">ERROR</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END ERRORS Modal -->

    @if (session('notify.message'))
        <script>
            notify("{{ session('notify.type') }}", "{{ session('notify.message') }}");
        </script>
    @endif

    @stack('scripts')
</body>

</html>
