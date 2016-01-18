(function ($) {
	// Select 2 input
	$(".select2").each(function() {
        options = {
            
        };
        $(this).select2(options);
    });
  // Daterangepicker
  $('.daterange').each(function() {
    var options = {
      locale: {"format": "DD/MM/YYYY"},
      "autoApply": true,
      "linkedCalendars": false,
      "endDate": moment().add(7, 'days'),
    };
    if($(this).attr('name') == 'created_at') {
      options.singleDatePicker = true;
    };
    $(this).daterangepicker(options);  
  });
  
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
            	$('#form-create').hide();
            	$('#form-edit').remove();
            	$('.row-form').append(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('ajax fa-edit co loi');
            }
		});
	});
  $('.add_phone').on('click', function() {
      var fieldHTML = '<div class="col-lg-8 col-sm-8 pull-right">' +
      '<div class="input-group">' +
      '<input class="form-control input-sm phone" required="true" id="order_phone_number[]" type="text" name="order_phone_number[]">' +
      '<span class="input-group-addon"><i class="fa fa-close"></i></span>' +
      '</div>' +
      '</div>';

      $(fieldHTML).appendTo('.phone_order');
      $('.phone').inputmask('(999[9]) 999 999[9]');
  });
  $('.phone_order').on('click', '.fa-close', function(e) {
    $(this).parent().parent('div').remove();
  });
  $('.phone').on('click', function() {
    $(this).inputmask('(999[9]) 999 999[9]');
  })
})(jQuery);


