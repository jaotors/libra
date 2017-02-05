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
    if($('.alert').length > 0) {
        if ($('.message-error').length > 0) {
            $('.message-error').modal();
        }
        if ($('.message-info').length > 0) {
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

    /* dropdown sidenav */
    $('.sidenav .dropdown.down').children('ul').show();
    $('.sidenav .dropdown > a').on('click', function(e) {
        e.preventDefault();
        $(this).siblings('ul').slideToggle().parent().toggleClass('down').siblings('li').removeClass('down').children('ul').slideUp();
    });


    /* dropdown topnav */
    $('.topnav .drop').hover(function() {
        $(this).children('ul').toggle();
    });

    /* ajax view book*/
    $('.view-book').on('click', function() {
        var link = $(this).data('link');

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
                console.log(data.status);
                if(data.status != 'Available') {
                    $('.for-avail').hide();
                } else {
                    $('.for-avail').show();
                }
                if($('.for-avail').length > 0) {
                    $('.for-avail').attr('href', "/opac/book/" + data.id + "/reserve")
                }
            }
        });
    });

    function strpad(id) {
        var str = "" + id,
            pad = "00000",
            id = pad.substring(0, pad.length - str.length) + str

        return id;
    }
});