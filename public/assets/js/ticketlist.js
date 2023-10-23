$(document).ready(function () {
    $(function () {
        var url = $(location).attr('href');
        if ($("#assigned").length) {
            var table = $("#ticket-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,
                    data: function (d) {
                        (d.status = $("#status").val()),
                            (d.priority = $("#priority").val()),
                            (d.category = $("#category").val()),
                            (d.assigned = $("#assigned").val()),
                            (d.search = $('input[type="search"]').val());
                    },
                },
                columns: [
                    {
                        data: "ticket_no",
                        name: "ticket_no",
                    },
                    {
                        data: "title",
                        name: "title",
                    },
                    {
                        data: "created_at",
                        name: "created_at",
                    },
                    {
                        data: "status",
                        name: "status",
                    },
                    {
                        data: "agent_id",
                        name: "agent_id",
                    },
                    {
                        data: "action",
                        name: "action",
                    },
                ],
            });
        } else {
            var table = $("#ticket-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,
                    data: function (d) {
                        (d.status = $("#status").val()),
                            (d.priority = $("#priority").val()),
                            (d.category = $("#category").val()),
                            (d.search = $('input[type="search"]').val());
                    },
                },
                columns: [
                    {
                        data: "ticket_no",
                        name: "ticket_no",
                    },
                    {
                        data: "title",
                        name: "title",
                    },
                    {
                        data: "created_at",
                        name: "created_at",
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
        }
        $("#search").click(function () {
            table.draw();
        });
    });
});
