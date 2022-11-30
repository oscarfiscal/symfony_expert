$('.favorite').on('click', function() {
 e.preventDefault();
    var $this = $(this);
    url = $this.data('url');
    idMarker = $this.data('id');
    
    $this.addClass('disabled');
    $.post(url,{id:isMarker})
    .done(function(respuesta) {
        if (Response.update) {
            $this.addClass('active');
        }
        $this.addClass('disabled');
       
    })
    .fail(function() {
        $this.removeClass('disabled');
    });
});
