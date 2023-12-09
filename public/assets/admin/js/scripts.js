function notify(type, message) {
    Dashmix.helpers("jq-notify", {
        type: type,
        from: "bottom",
        message: message
    });
}

$(window).on("load", function () {
    jQuery.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        error: function (data, textStatus, errorThrown) {
            if (data.status == 403) {
                notify("danger", "اجازه دسترسی ندارید");
                return;
            } else if (data.status == 500 || data.status == 405) {
                var errorModal = new bootstrap.Modal(document.getElementById("errors-modal"), {
                    keyboard: false
                });

                if (data.responseJSON) {
                    $("#errors-modal .block-content").html(`<pre><code id="errors-code-tag" class="json">${data.responseText}</code></pre>`);

                    setTimeout(() => {
                        Dashmix.helpersOnLoad(["js-highlightjs"]);
                        var codeBlock = document.getElementById("errors-code-tag");
                        hljs.highlightBlock(codeBlock);
                    }, 300);
                } else {
                    $("#errors-modal .block-content").html(data.responseText);
                }

                errorModal.show();
                return;
            } else if (data.status == 429) {
                notify("danger", "تعداد درخواست ها بیش از حد مجاز است لطفا مجدد تلاش کنید");
                return;
            } else if (data.status == 419) {
                notify("danger", "لطفا صفحه را رفرش کنید!");
                return;
            } else if (data.status != 422) {
                notify("danger", data.responseText == "error" ? "خطایی رخ داده است!" : data.responseText);
                return;
            }

            for (var key in data.responseJSON.errors) {
                // skip loop if the property is from prototype
                if (!data.responseJSON.errors.hasOwnProperty(key)) continue;

                var obj = data.responseJSON.errors[key];
                for (var prop in obj) {
                    // skip loop if the property is from prototype
                    if (!obj.hasOwnProperty(prop)) continue;

                    notify("danger", obj[prop]);
                }
            }
        }
    });

    $("form.ajax-form").on("submit", function (e) {
        e.preventDefault();

        let form = $(this);

        if (!$(this).data("disabled")) {
            var formData = new FormData(this);

            form.data("disabled", true);

            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data == "success") {
                        window.location.href = form.data("redirect");
                    }
                },
                beforeSend: function (xhr) {
                    block(form);
                },
                complete: function () {
                    form.data("disabled", false);
                    unblock(form);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });

    $(".block-mode-hidden-js").addClass("block-mode-hidden");
});

function block(el) {
    $(el).closest(".block").addClass("block-mode-loading");
}

function unblock(el) {
    $(el).closest(".block").removeClass("block-mode-loading");
}

$("select.select2").select2({
    dir: "rtl",
    placeholder: "انتخاب کنید"
    // closeOnSelect: false
    // allowClear: true,
});

//---------------- header search input
if ($("#navbar-search").length) {
    jQuery("#navbar-search").autoComplete({
        minChars: 2,
        source: function (term, response) {
            $.ajax({
                url: $("#navbar-search").data("action"),
                type: "GET",
                data: {
                    q: term
                },
                success: function (data) {
                    $.each(data, function (index, user) {
                        user.text = user.name + " <p> " + user.mobile + " </p> ";
                    });
                    response(data);
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr("content"));
                },
                error: function (data) {
                    //
                },
                cache: false
            });
        },
        renderItem: function (item, search) {
            var text = item.text;
            search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&");
            var re = new RegExp("(" + search.split(" ").join("|") + ")", "gi");
            var val = text.substring(0, text.indexOf("("));
            return '<a href="' + item.link + '" class="custom-autocomplete-suggestion" data-val="' + val + '">' + text.replace(re, "<b>$1</b>") + "</a>";
        }
    });
}

function number_format(nStr) {
    nStr += "";
    x = nStr.split(".");
    x1 = x[0];
    x2 = x.length > 1 ? "." + x[1] : "";
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, "$1" + "," + "$2");
    }
    return x1 + x2;
}

//---------------- amount input

$(document).on("keyup", ".amount-input", function () {
    $(this).attr("autocomplete", "off");

    if (!$(this).val()) {
        $(this).next(".form-text").remove();
        return;
    }

    if (!$(this).next(".form-text").length) {
        $(this).after('<small class="number-helper form-text text-success"></small>');
    }

    var value = $(this).val();

    $(this)
        .next(".form-text")
        .text(number_format(value) + " تومان");
});

$(".amount-input").trigger("keyup");
