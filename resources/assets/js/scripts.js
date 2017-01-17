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
});
