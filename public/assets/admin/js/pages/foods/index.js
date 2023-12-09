$(document).on("click", ".delete-food", function () {
    let deleteBtn = $(this);

    Swal.fire({
        title: "آیا مطمئن هستید؟",
        text: "میخواهید این غذا را حذف کنید؟",
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
                url: deleteBtn.data("url"),
                type: "post",
                data: {
                    _method: "DELETE"
                },
                success: function (data) {
                    Swal.fire({
                        title: "حذف شد",
                        text: "غذا با موفقیت حذف شد",
                        icon: "success",
                        confirmButtonText: "باشه",
                        html: !1
                    }).then(function () {
                        window.location.reload();
                    });
                },
                beforeSend: function (xhr) {
                    block("#delete-user.block");
                    xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr("content"));
                },
                complete: function () {
                    unblock("#delete-user.block");
                }
            });
        }
    });
});
