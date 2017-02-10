(function ($) {
  // import ajax
  $('.import-file').on('click', 'button:button', function () {
     $('#import-order').click();
     $('#import-order').change(function () {
        var filename = $(this).val().replace(/.*(\/|\\)/, '');
        var extension = filename.split('.').pop();
        // if true submit
        if(extension == 'xls' || extension == 'xlsx') {
          $('.import-file').submit();
        }
        else {
          // view message error
          console.log(filename);
          alert('Chỉ nhập dữ liệu từ file excel');
        }
     });
  })
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
	$('#confirmModal, #statusModal').on('show.bs.modal', function (event) {
 		var button = $(event.relatedTarget); // Button that triggered the modal
  	var action = button.data('url'); // Extract info from data-* attributes
    var status = button.data('status');
    var number = button.data('number');

		var modal = $(this);
        modal.find('.modal-title').html('Số điện thoại yêu cầu: ' +number);
  		  modal.find('form').attr('action', action);
        modal.find('#'+ status).prop('checked', 'checked');
	});
  $('#statusModal').on('hide.bs.modal', function(event) {
    $(this).find('.modal-title').empty();    
  });
	$('.fa-edit').on('click', function() {
		$.ajax({
			url: $(this).attr('data-url'),
			type: 'GET',
            success: function (data, textStatus, jqXHR) {
              $('#title-form').text('Form sửa')
            	$('#form-create').hide();
            	$('#form-edit').remove();
            	$('.row-form').append(data);
              $('.fa-close').on('click', function() {
                $(this).parents().eq(3).remove(); // eq increase 0

              });
              $('.daterange').each(function() {
                var options = {
                  locale: {"format": "DD/MM/YYYY"},
                  "autoApply": true,
                  "autoUpdateInput": false,
                  "linkedCalendars": false,
                  "endDate": moment().add(7, 'days'),
                };
                if($(this).attr('name') == 'created_at') {
                  options.singleDatePicker = true;
                };
                $(this).daterangepicker(options);  
              });

              $('input[name=created_at]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY'));
              });

              $('input[name=date_request]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
              });

              $('#uploadFile').on('click', 'input:first', function() {
                $(':file').click();
                $(':file').change(function(){
                  var filename = $(this).val().replace(/.*(\/|\\)/, '');
                  $('#uploadFile input:first').val(filename);
                });
              });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('ajax fa-edit co loi');
            }
		});
	});
  $('.add_phone').on('click', function() {
      var fieldHTML = '<div class="form-group">' +
      '<label for="order_phone[]" class="control-label col-lg-4 col-sm-4">&nbsp;</label>' +
      '<div class="col-lg-8 col-sm-8">' +
      '<div class="input-group">' +
      '<input class="form-control input-sm phone" required="true" id="order_phone[]" type="text" name="order_phone[]">' +
      '<span class="input-group-addon"><i class="fa fa-close"></i></span>' +
      '</div>' +
      '</div>' +
      '</div>';

      $('.phone_order').after(fieldHTML);
      $('.fa-close').on('click', function() {
        $(this).parents().eq(3).remove(); // eq increase 0
      });
  });
  $('#perPage').on('change', 'select', function() {
    window.location.href = '?perPage=' + $(this).val() + '&page=1&condition=' + $('#condition select').val();
  });
  $('#condition').on('change', 'select', function() {
    window.location.href = '?perPage=' + $('#perPage select').val() + '&page=1&condition=' + $(this).val();
  });
  $('#uploadFile').on('click', 'input:first', function() {
    $(':file').click();
    $(':file').change(function(){
      var filename = $(this).val().replace(/.*(\/|\\)/, '');
      $('#uploadFile input:first').val(filename);
    });
    
  });
  $('#search').select2({
    multiple: true,
    ajax: {
      dataType: 'json',
      delay: 50,
      data: function (params) {
      return {
        query: params.term, // search term
        page: params.page
      };
    },
    processResults: function (data, params) {
      params.page = params.page || 1;
      return {
        results: data,
        pagination: {
          more: (params.page * 30) < data.total_count
        }
      };
    },
  },
  "language": {
       "noResults": function(){
           return "Không tìm thấy kết quả nào...";
       }
   },
  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
  minimumInputLength: 2,
  templateResult: templateResult,
  templateSelection: formatSelection,
  }).on('select2:select', function(e) {
    console.log(window.location);
   window.location.href = '/orders/' + e.params.data.id;
    $(this).val([]).trigger('change');
  });
  function templateResult(item) {

      var markup = "";
      var phones = ""
      for (var i in item.phones) {
            if(i > 0) {
              phones += "/";
            }
            phones += item.phones[i].number;
      }
      if (item.order_name !== undefined) {
          markup += "<table><tr><th>" + item.number_cv + "/" + item.unit.symbol + "</th></tr>" +
          "<tr><td>" + item.order_name + " &#9866; " + phones + "</td></tr>";
      }
      else {
        markup += "<option>" + item.text + "</option";
      }
      return markup;
  }
  function formatSelection(item) {
    return item.order_name;
  }

})(jQuery);


