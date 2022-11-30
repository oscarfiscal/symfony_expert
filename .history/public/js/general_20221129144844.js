$('.favorite').on('click', function(e) {
 e.preventDefault();
    var $this = $(this),
    url = $this.data('url'),
    idMarker = $this.data('id');
    
    $this.addClass('disabled');
    $.post(url,{id:idMarker})
    .done(function(r) {
        if (r.update) {
            $this.toggleClass('active');
        }
        $this.removeClass('disabled');
       
    })
    .fail(function() {
        $this.removeClass('disabled');
    });
});


$('body').on('submit', 'form[name="tag"][data-ajax="true"]', function(event) {
    event.preventDefault();
    var $form = $(this);
    var $button = $form.find('button[type="submit"]');
    $button.addClass('disabled');
    $.post($form.attr('action'), $form.serialize())
    .done(function(r) {
        if (r.update) {
            $form.find('input[name="tag"]').val('');
            $form.find('input[name="tag"]').focus();
            $form.find('.tags').append(r.update);
        }
        $button.removeClass('disabled');
    })
    .fail(function() {
        $button.removeClass('disabled');
    });
});
