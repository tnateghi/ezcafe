<div class="row">

    <div class="col-md-12">
        <div class="mb-4">
            <label class="form-label">نام دسته بندی </label>
            <input type="text" name="title" class="form-control" value="{{ $category->title }}">
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-4">
            <label class="form-label" for="example-file-input">تصویر <small>(1280X800)</small></label>
            <input class="form-control" type="file" accept="image/*" name="image">

            @if ($category->image)
                <div class="mt-2">
                    <img class="w-25" src="{{ $category->imageUrl() }}" alt="{{ $category->title }}">
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-12 mb-4">
        <div class="space-y-2">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" value="" id="published" name="published" {{ $category->published ? 'checked' : '' }}>
                <label class="form-check-label" for="published">انتشار دسته بندی</label>
            </div>
        </div>
    </div>

</div>
