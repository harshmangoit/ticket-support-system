$(document).ready(function () {
    $("#userForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 255,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 8,
            },
            confirmPassword: {
                required: true,
                equalTo: "#password",
            },
            status: {
                required: true,
            },
            role: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Your name must be at least 3 characters long",
                maxlength: "Your name is too long",
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter valid email",
            },
            password: {
                required: "Please enter your password",
                minlength: "The password must be at least 8 characters",
            },
            confirmPassword: {
                required: "Enter your confirm password",
                equalTo: "Password confirmation does not match",
            },
            role: {
                required: "Please assign a specific role",
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
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
    });

});