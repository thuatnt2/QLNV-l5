(function ($) {

	$('#modal-message').modal({
		backdrop: 'static',
	});
	$('#modal-message').modal('show');
	$('#confirmModal').on('show.bs.modal', function (event) {
 		var button = $(event.relatedTarget) // Button that triggered the modal
  		var action = button.data('url') // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
  		modal.find('.modal-footer form').attr('action', action)
	});
	$('.fa-edit').on('click', function() {
		$.ajax({
			url: $(this).attr('data-url'),
			type: 'GET',
            success: function (data, textStatus, jqXHR) {
            	$('.row-form').empty();
            	$('.row-form').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('ajax thong ke co loi');
            }
		});
	});
})(jQuery);