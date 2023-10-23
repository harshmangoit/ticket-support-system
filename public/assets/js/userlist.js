$(document).ready(function () {
    $(function () {
        var url = $(location).attr('href');
        var table = $("#user-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: url,
                data: function (d) {
                    (d.status = $("#status").val()),
                        (d.role = $("#role").val()),
                        (d.search = $('input[type="search"]').val());
                },
            },
            columns: [
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "email",
                    name: "email",
                },
                {
                    data: "role",
                    name: "role",
                },
                {
                    data: "status",
                    name: "status",
                },
                {
                    data: "action",
                    name: "action",
                },
            ],
        });

        $("#search").click(function () {
            table.draw();
        });
    });
});
