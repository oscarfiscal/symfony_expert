$('.favorite').on('click', function() {
 e.preventDefault();
    var $this = $(this);
    url = $this.data('url');
    idMarker = $this.data('id');
    
    $this.addClass('disabled');
    $.post(url,{id:isMarker})
    .done(function(respuesta) {
        
        $this.removeClass('disabled');
        $this.addClass('active');
    })
    .fail(function() {
        $this.removeClass('disabled');
    }
}