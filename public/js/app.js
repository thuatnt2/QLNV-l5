/* 
 */
AppConfig = {
	defaultDatepickerOptions: {
		changeMonth: true,
		changeYear: true,
		showOtherMonths: true,
		dateFormat: 'dd/mm/yy',
		numberOfMonths: 1,
		yearRange: "-10:+16",
		dayNames: ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],
		dayNamesShort: ['Chủ Nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'],
		dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
		monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
		monthNamesShort: ["Th 1", "Th 2", "Th 3", "Th 4", "Th 5", "Th 6", "Th 7", "Th 8", "Th 9", "Th 10", "Th 11", "Th 12"],
		firstDay: 1
	},
};

(function ($) {
	// Select 2 input
	$(".select2").each(function() {
        options = {
            
        };
        $(this).select2(options);
    });

	/* Date picket input */
    $('.datepicker').each(function() {
        $_this = $(this);
        var options = {};
        if ($_this.data('min-date')) {
            options.minDate = new Date($_this.data('min-date'));
        }
        options = jQuery.extend(AppConfig.defaultDatepickerOptions, options);
        console.log(options);
        $('.datepicker').datepicker(options);
    });
    // Daterangepicker
    $('.daterangepicker').each(function() {
    	var options = {

    	};
    	$(this).daterangepicker();
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
})(jQuery);


