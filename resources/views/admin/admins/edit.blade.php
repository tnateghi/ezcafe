@extends('admin.layouts.app')

@section('content')
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">

            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8">
                    <form id="admin-edit-form" class="ajax-form" action="{{ route('admin.admins.update', ['admin' => $admin]) }}" data-redirect="{{ route('admin.admins.index') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">ویرایش مدیر</h3>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-8">

                                        <div class="mb-4">
                                            <label class="form-label" for="name">نام و نام خانوادگی</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="username">نام کاربری</label>
                                            <input type="text" class="form-control ltr" id="username" name="username" value="{{ $admin->username }}" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="mobile">شماره موبایل</label>
                                            <input type="text" class="form-control ltr" id="mobile" name="mobile" value="{{ $admin->mobile }}" required>
                                        </div>
                                        <div class="alert alert-info d-flex align-items-center" role="alert">
                                            <div class="flex-shrink-0">
                                                <i class="fa fa-fw fa-info-circle"></i>
                                            </div>
                                            <div class="flex-grow-1 me-3">
                                                <p class="mb-0">در صورتی که نمیخواهید رمز عبور را تغییر دهید لطفا فیلدهای مربوط به رمز عبور را خالی بگذارید.</p>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="password">رمز عبور</label>
                                            <input type="password" class="form-control ltr" id="password" name="password">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="password_confirmation">تکرار رمز عبور</label>
                                            <input type="password" class="form-control ltr" id="password_confirmation" name="password_confirmation">
                                        </div>



                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-alt-primary">ذخیره</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
@endsection
