@extends('admin.layouts.app')

@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">

            <!-- Quick Menu -->
            <div class="pt-4 px-4 bg-body-dark rounded push">
                <div class="row items-push">
                    <div class="col-6 col-md-4 col-xl-2">
                        <a class="block block-rounded block-link-pop text-center d-flex align-items-center h-100 mb-0" href="{{ route('admin.foods.index') }}">
                            <div class="block-content">
                                <p class="mb-2 d-none d-sm-block text-primary">
                                    <i class="fa fa-users opacity-50 fa-2x"></i>
                                </p>
                                <p class="fw-semibold fs-sm">کاربران</p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
            <!-- END Quick Menu -->

        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection
