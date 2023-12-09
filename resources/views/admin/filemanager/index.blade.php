@extends('admin.layouts.app')

@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <div class="row">
                <div class="col-12">
                    <iframe class="rounded mb-3" src="{{ route('admin.filemanager.iframe') }}" height="700px" width="100%" title="Iframe Example"></iframe>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection