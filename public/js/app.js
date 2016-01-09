(function ($) {
	// Select 2 input
	$(".select2").each(function() {
        options = {
            
        };
        $(this).select2(options);
    });
    // Daterangepicker
    $('#single').each(function() {
    	var options = {
    		"opens": "left",
             locale: { 'format': 'DD/MM/YYYY'},
             "autoUpdateInput": false,
             "singleDatePicker": true,
    	};
    	$(this).daterangepicker(options, function(start) {
            $('.datesingle').val(start.format('DD/MM/YYYY'));
        })
    });
    $('#range').each(function() {
        var options = {
            "opens": "left",
             locale: { 'format': 'DD/MM/YYYY'},
             "autoUpdateInput": false,
             "singleDatePicker": false,
             "autoApply": true,
        };
        $(this).daterangepicker(options, function(start, end) {
            $('.daterange').val(start.format('DD/MM/YYYY') +' - '+ end.format('DD/MM/YYYY'));
        })
    })
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
})(jQuery);


