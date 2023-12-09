<li class="dd-item" data-id="{{ $child_category->id }}">
    <div class="dd-handle"><span class="category-title">{{ $child_category->title }}</span>
        <a data-category="{{ $child_category->slug }}" class="float-start delete-category dd-nodrag text-danger me-2" href="javascript:void(0)">حذف</a>
        <a data-category="{{ $child_category->slug }}" class="float-start edit-category dd-nodrag text-warning" href="javascript:void(0)">ویرایش</a>
    </div>
</li>
