@extends('admin.layouts.app')

@section('content')
    <!-- Main Container -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="content content-full content-boxed">
            <div class="block block-rounded">
                <div class="block-content">
                    <form id="profile-form" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <h2 class="content-heading pt-0">
                            <i class="fa fa-fw fa-user-circle text-muted me-1"></i> ویرایش پروفایل
                        </h2>
                        <div class="row push">
                            <div class="col-lg-8 col-xl-5 m-auto">
                                <div class="mb-4">
                                    <label class="form-label" for="username">نام کاربری</label>
                                    <input type="text" name="username" class="form-control ltr" id="username" value="{{ $admin->username }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="password">رمز عبور فعلی</label>
                                    <input type="password" name="current_password" class="form-control" id="password">
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label class="form-label" for="password-new">رمز عبور جدید</label>
                                        <input type="password" name="password" class="form-control" id="password-new">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label class="form-label" for="password-new-confirm">تکرار رمز عبور جدید</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="password-new-confirm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="row push">
                            <div class="col-lg-8 col-xl-5 m-auto">
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-alt-primary">
                                        ویرایش پروفایل
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
    <script src="{{ asset('assets/admin/js/pages/profile.js') }}"></script>
@endpush
