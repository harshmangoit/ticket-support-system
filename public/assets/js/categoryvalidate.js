$(document).ready(function () {
    $("#categoryForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 255,
            },
            status: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter a category name",
                minlength: "Category name must be at least 3 characters long",
                maxlength: "Category name is too long",
            },
            status: {
                required: "Please select a status",
            },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
    });
});