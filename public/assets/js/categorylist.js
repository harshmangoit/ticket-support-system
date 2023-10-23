$(document).ready(function () {
    $(function() {
        var url = $(location).attr('href');
        var table = $('#category-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: url,
                data: function(d) {
                    d.status = $('#status').val()
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });

        $('#search').click(function() {
            table.draw();
        });
    });
});
