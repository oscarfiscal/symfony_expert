$('.favorite').on('click', function(e) {
 e.preventDefault();
    var $this = $(this);
    url = $this.data('url');
    idMarker = $this.data('id');
    
    $this.addClass('disabled');
    $.post(url,{id:isMarker})
    .done(function(r) {
        if (r.update) {
            $this.Class('active');
        }
        $this.addClass('disabled');
       
    })
    .fail(function() {
        $this.removeClass('disabled');
    });
});
