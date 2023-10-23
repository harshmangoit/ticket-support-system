$(document).ready(function () {
    $("#ticketForm").validate({
        rules: {
            title: {
                required: true,
                maxlength: 255,
            },
            detail: {
                required: true,
            },
            category: {
                required: true,
            },
            agent: {
                required: true,
            }
        },
        messages: {
            title: {
                required: "Please enter a title for the ticket.",
                maxlength: "Title should not exceed 255 characters.",
            },
            detail: {
                required: "Please provide details for the ticket.",
            },
            category: {
                required: "Please select a category",
            },
            agent: {
                required: "Please select a agent",
            }
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
