@extends('admin.layouts.app')

@section('content')
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">

            <form class="ajax-form" action="{{ route('admin.foods.update', ['food' => $food]) }}" data-redirect="{{ route('admin.foods.index') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <!-- Info -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">اطلاعات غذا</h3>
                    </div>
                    <div class="block-content">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-8">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label" for="title">عنوان</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ $food->title }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label" for="title_two">عنوان دوم</label>
                                            <input type="text" class="form-control" id="title_two" name="title_two" value="{{ $food->title_two }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label" for="category_id">دسته بندی</label>
                                            <select name="category_id" id="category_id" class="form-select" required>
                                                <option value="">انتخاب کنید</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $food->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label" for="price">قیمت</label>
                                            <input type="number" class="form-control ltr amount-input" id="price" name="price" value="{{ $food->price }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label" for="image">تصویر</label>
                                            <input class="form-control" type="file" id="image" name="image">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="content">توضیحات</label>
                                    <textarea class="form-control" id="content" name="content" rows="3">{{ $food->content }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-4">
                                            <label class="form-label">انتشار؟</label>
                                            <div class="form-check form-switch d-flex">
                                                <input class="form-check-input" type="checkbox" id="published" name="published" {{ $food->published ? 'checked' : '' }}>
                                                <label class="form-check-label" for="published"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-4">
                                            <label class="form-label">موجود؟</label>
                                            <div class="form-check form-switch d-flex">
                                                <input class="form-check-input" type="checkbox" id="instock" name="instock" {{ $food->instock ? 'checked' : '' }}>
                                                <label class="form-check-label" for="instock"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="my-4">
                                    <button type="submit" class="btn btn-alt-primary">ذخیره</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Info -->

            </form>
        </div>
        <!-- END Page Content -->
    </main>
@endsection
