$("#profile-form").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        success: function (data) {
            notify("success", "با موفقیت ذخیره شد");

            setTimeout(() => {
                window.location.reload();
            }, 1000);
        },
        beforeSend: function (xhr) {
            block(".block");
        },
        complete: function () {
            unblock(".block");
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
