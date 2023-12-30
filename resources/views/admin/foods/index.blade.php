@extends('admin.layouts.app')

@section('content')
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <!-- Quick Overview -->
            <div class="row items-push">
                <div class="col-6 col-lg-3">
                    <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="{{ route('admin.foods.create') }}">
                        <div class="block-content py-5">
                            <div class="fs-3 fw-semibold text-success mb-1">
                                <i class="fa fa-plus"></i>
                            </div>
                            <p class="fw-semibold fs-sm text-success text-uppercase mb-0">
                                افزودن غذای جدید
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="block block-rounded text-center h-100 mb-0">
                        <div class="block-content py-5">
                            <div class="fs-3 fw-semibold text-success mb-1">{{ number_format($published_foods) }}</div>
                            <p class="fw-semibold fs-sm text-success text-uppercase mb-0">
                                موجود
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="block block-rounded block-link-shadow text-center h-100 mb-0">
                        <div class="block-content py-5">
                            <div class="fs-3 fw-semibold text-danger mb-1">{{ number_format($draft_foods) }}</div>
                            <p class="fw-semibold fs-sm text-danger text-uppercase mb-0">
                                ناموجود
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="block block-rounded block-link-shadow text-center h-100 mb-0">
                        <div class="block-content py-5">
                            <div class="fs-3 fw-semibold text-dark mb-1">{{ number_format($all_foods) }}</div>
                            <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                                همه
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Quick Overview -->

            <div id="filter-block" class="block block-rounded {{ request()->except('page') ? '' : 'block-mode-hidden-js' }} mb-2">
                <div class="block-header block-header-default">
                    <h3 class="block-title" onclick="Dashmix.block('content_toggle', '#filter-block');">فیلتر کردن</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="block-content">
                    <!-- Search Form -->
                    <form action="" method="GET">
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="title">عنوان</label>
                                <input type="text" class="form-control" name="title" value="{{ request()->title }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="category_id">دسته بندی</label>
                                <select name="category_id" id="category_id" class="form-select">
                                    <option value="">همه</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="instock">وضعیت موجودی</label>
                                <select name="instock" id="instock" class="form-select">
                                    <option value="">همه</option>
                                    <option value="1" {{ request()->instock === '1' ? 'selected' : '' }}>موجود</option>
                                    <option value="0" {{ request()->instock === '0' ? 'selected' : '' }}>ناموجود</option>

                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-alt-success">جستجو</button>
                            </div>
                        </div>
                    </form>
                    <!-- END Search Form -->
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">لیست غذا ها</h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>تصویر</th>
                                    <th>عنوان</th>
                                    <th>دسته بندی</th>
                                    <th>وضعیت</th>
                                    <th>موجودی</th>
                                    <th class="text-center">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($foods as $food)
                                    <tr>
                                        <td class="text-center fs-sm">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="fs-sm">
                                            <img src="{{ $food->imageUrl() }}" alt="image" style="width: 100px">
                                        </td>
                                        <td class="fs-sm">
                                            <strong>
                                                {{ $food->title }}
                                                @if ($food->title_two)
                                                    <small>({{ $food->title_two }})</small>
                                                @endif
                                            </strong>
                                        </td>
                                        <td class="fs-sm">
                                            <strong>{{ $food->category->title }}</strong>
                                        </td>

                                        <td>
                                            @if ($food->published)
                                                <span class="badge bg-success">منتشر شده</span>
                                            @else
                                                <span class="badge bg-danger">پیش نویس</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($food->instock)
                                                <span class="badge bg-success">موجود</span>
                                            @else
                                                <span class="badge bg-danger">ناموجود</span>
                                            @endif
                                        </td>
                                        <td class="text-center fs-sm">
                                            <a class="btn btn-sm btn-alt-secondary" href="{{ route('admin.foods.edit', ['food' => $food]) }}">
                                                <i class="fa fa-fw fa-pencil"></i>
                                            </a>
                                            <a class="btn btn-sm btn-alt-secondary delete-food" data-url="{{ route('admin.foods.destroy', ['food' => $food]) }}" href="javascript:void(0)">
                                                <i class="fa fa-fw fa-times text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted py-4">چیزی برای نمایش وجود ندارد!</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{ $foods->links() }}
                    <!-- END Pagination -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('assets/admin/js/pages/foods/index.js') }}"></script>
@endpush
