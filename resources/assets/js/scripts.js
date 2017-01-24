$(document).ready(function() {
    /* data tables*/
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

    $('body.login').css('height', $(window).height());

    /* pop up messages*/
    if($('body.login').length > 0) {
        if($('.alert').length > 0) {
            $('.message-error').modal();
            $('.message-info').modal();
        }
    }

    /* opac tab */
    $('.title-tab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })


    /* roles select */
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

    /* dropdown top nav */
    $('.topnav .drop').hover(function() {
        $(this).children('ul').toggle();
    });

    /* ajax view book*/
    $('.view-book').on('click', function() {
        var link = $(this).data('link');

        $('.modal-view').on('show.bs.modal', function (e) {
            $.ajax({ 
                type: 'GET', 
                url: link, 
                data: { get_param: 'value' }, 
                dataType: 'json',
                success: function (data) { 
                    $('.book-title').text(data.name);
                    $('.author').text(data.author);
                    $('.desc').text(data.summary);
                    $('.access-num').text(strpad(data.id));
                    $('.isbn').text(data.isbn);
                    $('.category').text(data.category);
                    $('.status').text(data.status);
                    if(data.status != 'Available') {
                        $('.for-avail').hide();
                    }
                    if($('.for-avail').length > 0) {
                        $('.for-avail').attr('href', "/opac/book/" + data.id + "/reserve")
                    }
                }
            });
        })
    });

    function strpad(id) {
        var str = "" + id,
            pad = "00000",
            id = pad.substring(0, pad.length - str.length) + str

        return id;
    }
});