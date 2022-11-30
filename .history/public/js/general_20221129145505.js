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
         $btnSubmit = $form.find('button[type="submit"]'),
         $container = $form.closest('.modal-body'),
         $tagSelect = $('#marker_tag'),
         url = $form.attr('action');

         $btnSubmit.addClass('disabled');

         var data = {};

            $.each($form.serializeArray(), function() {
                data[this.name] = this.value;
            });

            $.post(url, data)
            .done(function(r) {
                $container.html();

});
