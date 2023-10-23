$(document).ready(function () {
        $("#commentForm").validate({
        rules: {
            message: {
                required: true,
            }
        },
        messages: {
            message: {
                required: "Please type a message",
            }
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function(element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function(element) {
            $(element).removeClass("is-invalid");
        },
    });
});
