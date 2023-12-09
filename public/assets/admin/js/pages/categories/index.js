$(".dd").nestable({
    maxDepth: typeof maxDepth !== "undefined" ? maxDepth : 10,
    callback: function () {
        if (JSON.stringify($(".dd").nestable("serialize")) != JSON.stringify(categories)) {
            $("#save-changes").prop("disabled", false);
            saveChanges();
        }
    }
});

var categories = $(".dd").nestable("serialize");
let isLoading = false;

$("#create-category").on("submit", function (e) {
    e.preventDefault();

    var form = $(this);
    var formData = new FormData(this);

    $.ajax({
        url: form.attr("action"),
        type: "post",
        data: formData,
        success: function (data) {
            $(".dd-empty").remove();
            $(".dd").nestable("add", {
                id: data.id,
                content: '<span class="category-title">' + data.title + '</span><a data-category="' + data.slug + '" class="float-start delete-category dd-nodrag text-danger me-2" href="javascript:void(0)">حذف</a><a data-category="' + data.slug + '"  class="float-start edit-category dd-nodrag text-warning" href="javascript:void(0)">ویرایش</a>'
            });
            $("#create-category").trigger("reset");

            categories = $(".dd").nestable("serialize");
        },
        beforeSend: function (xhr) {
            block(form);
        },
        complete: function () {
            unblock(form);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

$(document).on("click", ".delete-category", function () {
    var category = $(this).data("category");

    Swal.fire({
        title: "آیا مطمئن هستید؟",
        text: "با حذف دسته بندی غذاهای این دسته بندی در منو نمایش داده نمیشوند!",
        icon: "warning",
        showCancelButton: !0,
        customClass: {
            confirmButton: "btn btn-danger m-1",
            cancelButton: "btn btn-secondary m-1"
        },
        confirmButtonText: "بله حذف شود",
        cancelButtonText: "خیر",
        html: !1
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: BASE_URL + "/categories/" + category,
                type: "post",
                data: {
                    _method: "DELETE"
                },
                success: function (data) {
                    $(".dd").nestable("remove", data.id);

                    Swal.fire({
                        title: "حذف شد",
                        text: "دسته بندی با موفقیت حذف شد",
                        icon: "success",
                        confirmButtonText: "باشه",
                        html: !1
                    });

                    categories = $(".dd").nestable("serialize");
                },
                beforeSend: function (xhr) {
                    block("#main-block");
                    xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr("content"));
                },
                complete: function () {
                    unblock("#main-block");
                }
            });
        }
    });
});

$(document).on("click", ".edit-category", function () {
    var category = $(this).data("category");
    let btn = $(this);

    $.ajax({
        url: BASE_URL + "/categories/" + category + "/edit",
        type: "get",
        data: {},
        success: function (data) {
            $("#category-edit-form").attr("action", BASE_URL + "/categories/" + category);
            $("#category-edit-form").data("category", category);

            $("#category-edit-modal #category-form-content").html(data);

            jQuery("#category-edit-modal").modal("show");
        },
        beforeSend: function (xhr) {
            block(btn);
        },
        complete: function () {
            unblock(btn);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

$("#category-edit-modal").on("shown.bs.modal", function () {
    $("#edit-title").focus();
});

$("#category-edit-form").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    var form = $(this);
    var category = form.data("category");

    $.ajax({
        url: form.attr("action"),
        type: "post",
        data: formData,
        success: function (data) {
            $("a[data-category=" + category + "]")
                .closest(".dd-handle")
                .find(".category-title")
                .text(data.title);
            $("[data-category=" + category + "]").data("category", data.slug);
            $("[data-category=" + category + "]").attr("data-category", data.slug);
            jQuery("#category-edit-modal").modal("hide");
        },
        beforeSend: function (xhr) {
            block(form);
            xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr("content"));
        },
        complete: function () {
            unblock(form);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

function saveChanges() {
    if (!categories.length) {
        return;
    }

    $.ajax({
        url: BASE_URL + "/categories/sort",
        type: "post",
        data: {
            categories: $(".dd").nestable("serialize"),
            type: $('input[name="type"]').first().val()
        },
        success: function () {
            categories = $(".dd").nestable("serialize");
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr("content"));
            isLoading = true;
        },
        complete: function () {
            isLoading = false;
        }
    });
}

window.onbeforeunload = function () {
    if (isLoading) {
        return "Are you sure?";
    }
};
