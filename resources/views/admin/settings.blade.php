@extends('admin.layouts.app')

@section('content')
    <!-- Main Container -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="content content-full content-boxed">
            <div class="block block-rounded">
                <div class="block-content">
                    <form id="settings-form" action="{{ route('admin.settings') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <h2 class="content-heading pt-0">
                            <i class="fa fa-fw fa-comments text-muted me-1"></i> تنظیمات
                        </h2>
                        <div class="row push">

                            <div class="col-lg-4">
                                <p class="text-muted">
                                    اطلاعات پنل پیامکی نیاز پرداز را در این قسمت وارد کنید.
                                </p>
                            </div>
                            <div class="col-lg-8 col-xl-5">
                                <div class="mb-4">
                                    <label class="form-label" for="smspanel_username">نام کاربری</label>
                                    <input type="text" class="form-control ltr" id="smspanel_username" name="smspanel_username" value="{{ option('smspanel_username') }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="smspanel_password">رمز</label>
                                    <input type="text" class="form-control ltr" id="smspanel_password" name="smspanel_password" value="{{ option('smspanel_password') }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="smspanel_fromnumber">شماره ارسالی</label>
                                    <input type="text" class="form-control ltr" id="smspanel_fromnumber" name="smspanel_fromnumber" value="{{ option('smspanel_fromnumber', '10009611') }}">
                                </div>
                            </div>
                        </div>


                        <!-- Submit -->
                        <div class="row push">
                            <div class="col-lg-8 col-xl-5 offset-lg-4">
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-alt-primary">
                                        ذخیره تنظیمات
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- END Submit -->
                    </form>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection

@push('scripts')
    <script src="{{ asset('assets/admin/js/pages/settings.js') }}"></script>
@endpush
