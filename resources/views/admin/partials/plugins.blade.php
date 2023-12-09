@foreach ($plugins as $plugin)
    @switch($plugin)
        @case('ckeditor')
            @push('scripts')
                <script src="{{ asset('assets/admin/js/plugins/ckeditor/ckeditor.js') }}"></script>
            @endpush
        @break

        @case('dropzone')
            @push('scripts')
                <script src="{{ asset('assets/admin/js/plugins/dropzone/min/dropzone.min.js') }}"></script>
            @endpush

            @push('styles')
                <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/dropzone/min/dropzone.min.css') }}">
            @endpush
        @break

        @case('select2')
            @push('scripts')
                <script src="{{ asset('assets/admin/js/plugins/select2/js/select2.full.min.js') }}?v=2"></script>
                <script src="{{ asset('assets/admin/js/plugins/select2totree/select2totree.js') }}?v=2"></script>
            @endpush

            @push('styles')
                <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/select2/css/select2.min.css') }}">
                <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/select2totree/select2totree.css') }}">
            @endpush
        @break

        @case('jquery-ui')
            @push('scripts')
                <script src="{{ asset('assets/admin/js/plugins/jquery-ui/jquery-ui.js') }}"></script>
                <script src="{{ asset('assets/admin/js/plugins/jquery-ui-sortable/jquery-ui.min.js') }}"></script>
            @endpush

            @push('styles')
                <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/js/plugins/jquery-ui/jquery-ui.css') }}">
            @endpush
        @break

        @case('magnific-popup')
            @push('scripts')
                <script src="{{ asset('assets/admin/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
            @endpush

            @push('styles')
                <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/magnific-popup/magnific-popup.css') }}">
            @endpush
        @break
    @endswitch
@endforeach
