$('.favorite').on('click', function() {
    var id = $(this).attr('id');
    var type = $(this).attr('data-type');
    $.ajax({
        url: '/ajax/favorite',
        type: 'POST',
        data: {
            id: id,
            type: type
        },
        success: function(data) {
            if (data == 'added') {
                $('#favorite-' + id).addClass('active');
            } else if (data == 'removed') {
                $('#favorite-' + id).removeClass('active');
            }
        }
    });
}