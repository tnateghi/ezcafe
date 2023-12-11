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
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="home_text">متن صفحه اصلی</label>
                                    <textarea class="form-control" name="home_text" id="home_text" rows="3">{{ option('home_text') }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="about_text">متن درباره ما</label>
                                    <textarea class="form-control" name="about_text" id="about_text" rows="3">{{ option('about_text') }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="site_title">عنوان سایت</label>
                                    <input class="form-control" name="site_title" id="site_title" value="{{ option('site_title') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="contact_link">لینک تماس</label>
                                    <input class="form-control" name="contact_link" id="contact_link" value="{{ option('contact_link') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label" for="logo_image">تصویر لوگو</label>
                                    <input type="file" accept="image/*" class="form-control" name="logo_image" id="logo_image">
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="row push">
                            <div class="col-lg-8 col-xl-5">
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
