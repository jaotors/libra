$(document).ready(function() {
    if ( $.fn.dataTable.isDataTable( '.logs-table' ) ) {
        $('table.data-table').DataTable({
            "info": false,
            "language": {
                    "search": ""
            },
            "pagingType": "simple_numbers"
        });
    } else {
        $('table.data-table').DataTable({
            "info": false,
            "language": {
                    "search": ""
            },
            "pagingType": "simple_numbers",
            "autoWidth": false
        });
    }

    var dept = $('#department option:not(:last-child)');
    $('#role').change(function() {
        $('#role option:selected').each(function() {
            if($(this).text() != 'Student') {
                $('#department option:not(:last-child)').remove();
            } else {
                $('#department').prepend(dept);
            }
        });
    }).trigger("change");
});
