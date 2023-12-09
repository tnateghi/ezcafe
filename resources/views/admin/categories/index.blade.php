@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/js/plugins/nestable2/jquery.nestable.min.css') }}">
@endpush

@section('content')
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">

            <div class="row">
                <div class="col-lg-4">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                افزودن دسته بندی
                            </h3>

                        </div>
                        <div class="block-content">
                            <form id="create-category" action="{{ route('admin.categories.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <input id="title" type="text" class="form-control" name="title" placeholder="نام دسته بندی..." required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <button class="btn btn-success w-100">ذخیره</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">

                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">لیست دسته بندی ها</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- List categories -->
                            <div class="dd">
                                <ol class="dd-list">
                                    @foreach ($categories as $category)
                                        @include('admin.categories.partials.child_category', ['child_category' => $category])
                                    @endforeach
                                </ol>
                            </div>
                            <!-- END List categories -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>

    <!-- Edit Modal -->
    <div class="modal fade" id="category-edit-modal" tabindex="-1" role="dialog" aria-labelledby="category-edit-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">ویرایش دسته بندی</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form id="category-edit-form" action="#">
                        @method('put')

                        <div id="category-form-content" class="block-content">
                        </div>
                    </form>
                    <div class="block-content block-content-full text-start bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">انصراف</button>
                        <button form="category-edit-form" type="submit" class="btn btn-sm btn-primary">ذخیره</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Edit Modal -->
@endsection

@push('scripts')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/admin/js/plugins/nestable2/jquery.nestable.min.js') }}"></script>

    <script>
        var maxDepth = 1;
    </script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets/admin/js/pages/categories/index.js') }}"></script>
@endpush
