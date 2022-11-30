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
    var $form = $(this),
         $btnSubmit = $form.find('button[type="submit"]');
         $container = $form.closest('.modal-body');

});